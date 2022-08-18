<?php

namespace App\Http\Controllers;

use DOMDocument;
use Goutte\Client;
use Illuminate\Http\Request;
use Rct567\DomQuery\DomQuery;
use voku\helper\HtmlDomParser;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Gate;
use Rap2hpoutre\FastExcel\FastExcel;
// use Rap2hpoutre\FastExcel\Facades\FastExcel;
use App\Models\ProductRequirement_Model;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;


class ProductRequirement_Controller extends Controller
{
  // show all requirements
  public function index( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    $search_by = $request->search_by ?? null;
    $status   = $request->status ?? null;

    $searchColumns = ['name', 'username', 'email', 'phone_personal', 'phone_official'];

    // query condition as array
    // $whereColumns = [ ['name', 'like', "%{$search_by}%"], ['email', 'like', "%{$search_by}%"], ];

    
    $paginate = 20;
    
    // $requirement_all = User::get()->all();
    // $requirement_all = User::orderBy('created_at', 'desc')->limit(3)->get();
    // $requirement_all = User::orderByDesc('created_at')->limit(3)->get()->all();

    // Paginate
    // $requirement_all = User::latest()->where('status', $status)->paginate($paginate);


    /* $requirement_all = ProductRequirement_Model::latest();
    
    if( $status == 'active' ){
      $requirement_all = $requirement_all->where('active', '=', 1);
    }
    
    if( $status == 'not-active' ){
      $requirement_all = $requirement_all->where('active', '=', 0);
    }
    
    if( ! empty($search_by) ){
      $requirement_all = $requirement_all->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      });
    }
    
    $requirement_all = $requirement_all->paginate($paginate); */



    $location = "C:\Users\Start\Downloads\Programs\\";
    $file_name = "CWNDC-Email-Scrape-from-Outlook.xlsx";
    $file_url = $location . $file_name;

    // $file_name = "CWNDC-Delivery Status - AUG-22.xlsx";
    // $sheets = (new FastExcel)->importSheets( $file_url . $file_name );
    
    $import_sheet = (new FastExcel)->sheet(2)->import( $file_url );

    $excel_data = [];
    /* foreach( $import_sheet as $row_index => $excel_row ){
      if( $row_index == 0 ){
        foreach( $excel_row as $column => $excel_cell ){
          if( $column == 'Html-Body' ){

            $html_body = $excel_cell;

          }
        }
      }
    } */


    // $collection = fastexcel()->import('file.xlsx');
    // fastexcel($collection)->export('file.xlsx');


    $client = new Client();
    // use own HTTP settings, create and pass an HttpClient instance to Goutte. add a 60 second request timeout:
    // $client = new Client(HttpClient::create(['timeout' => 60]));
    
    
    // Get all pagination
    $tab = 'newest';
    $tag = 'laravel';
    $current_page = 1;
    $per_page = 50;
    $total_page = 0;

    if( $total_page == 0 ){
      // $startUrl = 'https://stackoverflow.com/questions/tagged/laravel';
      $startUrl = "https://stackoverflow.com/questions/tagged/$tag?tab=$tab&page=$current_page&pagesize=$per_page";
      $paginationCrawler = $client->request( 'GET', $startUrl );

      // $paginationSelector = '#mainbar .s-pagination.pager';
      $paginationSelector = '#mainbar .s-pagination.pager .s-pagination--item';
      $paginationNodeAll = $paginationCrawler->filter( $paginationSelector );

      // $index = count($paginationNodeAll) - 1;
      // $total_page = $paginationNodeAll->children()->last()->previousAll()->text();
      // $total_page = $paginationNodeAll->eq( $index )->previousAll()->text();
      $total_page = (int)$paginationNodeAll->last()->previousAll()->text();
    }


    $page_all_url = [];
    for( $x = 1; $x <= $total_page; $x++ ){
      $crawlUrl = "https://stackoverflow.com/questions/tagged/$tag?tab=$tab&page=$x&pagesize=$per_page";
      $page_all_url[] = $crawlUrl;
    }
    
    dd( $page_all_url );



    $crawlUrl = "https://stackoverflow.com/questions/tagged/$tag?tab=$tab&page=$current_page&pagesize=$per_page";
    $crawler = $client->request( 'GET', $crawlUrl );

    // $itemSelector = '#questions .s-post-summary';
    $titleSelector = '#questions .s-post-summary h3 > a';
    $titleNodeAll = $crawler->filter( $titleSelector );
    $title_all = $titleNodeAll->each( function( $node ){
      return [
        'title' => $node->text(),
        'url'   => $node->link()->getUri(),
      ];
    });
    

    $tagSelector = '#questions .s-post-summary .s-post-summary--meta-tags';
    $tagNodeAll = $crawler->filter( $tagSelector );
    $tag_all = $tagNodeAll->each( function( $node ){
      return $node->text();
    });
    

    $userMetaSelector = '#questions .s-post-summary .s-user-card .s-user-card--link > a';
    $userMetaNodeAll = $crawler->filter( $userMetaSelector );
    $user_meta_all = $userMetaNodeAll->each( function( $node ){
      return [
        'user'    => $node->text(),
        'profile' => $node->link()->getUri(),
      ];
    });

    
    $reputationMetaSelector = '#questions .s-post-summary .s-user-card .s-user-card--awards li > span';
    $reputationMetaNodeAll = $crawler->filter( $reputationMetaSelector );
    $reputation_meta_all = $reputationMetaNodeAll->each( function( $node ){
      return $node->text();
    });

    
    $timeMetaSelector = '#questions .s-post-summary .s-user-card .s-user-card--time > span';
    $timeMetaNodeAll = $crawler->filter( $timeMetaSelector );
    $time_meta_all = $timeMetaNodeAll->each( function( $node ){
      return [
        'timetext' => $node->text(),
        'datetime' => $node->attr('title'),
      ];
    });

    
    $voteMetaSelector = '#questions .s-post-summary .s-post-summary--stats > .s-post-summary--stats-item:nth-child(1) .s-post-summary--stats-item-number';
    $voteMetaNodeAll = $crawler->filter( $voteMetaSelector );
    $vote_meta_all = $voteMetaNodeAll->each( function( $node ){
      return $node->text();
    });

    
    $answerMetaSelector = '#questions .s-post-summary .s-post-summary--stats > .s-post-summary--stats-item:nth-child(2)';
    $answerMetaNodeAll = $crawler->filter( $answerMetaSelector );
    $answer_meta_all = $answerMetaNodeAll->each( function( $node ){
      // $class_name = 's-post-summary--stats-item has-answers has-accepted-answer';
      $accepted = '';
      $answers = $node->children('.s-post-summary--stats-item-number')->text();

      // if( $node->attr('class') == $class_name ){
      // if( $node->children()->first()->attr('class') == $class_name ){
      if( $node->children()->first()->nodeName() == 'svg' ){
        $accepted = 'YES';
      } else{
        $accepted = 'NO';
      }
      
      return [
        'accepted'  => $accepted,
        'answers'   => $answers,
      ];
    });

    
    $viewMetaSelector = '#questions .s-post-summary .s-post-summary--stats > .s-post-summary--stats-item:nth-child(3) .s-post-summary--stats-item-number';
    $viewMetaNodeAll = $crawler->filter( $viewMetaSelector );
    $view_meta_all = $viewMetaNodeAll->each( function( $node ){
      return $node->text();
    });
    
    
    dd( $answer_meta_all );



    return view('modules.distribution.requirement.index')->with([
      'search_by' => $search_by,
      'excel_data' => $excel_data,
      /* 'status'   => $status,
      'paginate' => $paginate,
      'requirement_all' => $requirement_all, */
    ]);
  }



}
