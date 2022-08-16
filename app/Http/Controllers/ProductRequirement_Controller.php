<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Gate;
use App\Models\ProductRequirement_Model;
use DOMDocument;
use Rct567\DomQuery\DomQuery;
use voku\helper\HtmlDomParser;
use Rap2hpoutre\FastExcel\FastExcel;
// use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Goutte\Client;
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
    $startUrl = 'https://stackoverflow.com/questions/tagged/laravel';
    $itemSelector = '#questions .s-post-summary.js-post-summary';
    $linkSelector = 'h3.s-post-summary--content-title > a';
    $questionsAll = [];

    $crawler = $client->request('GET', $startUrl);

    // $itemsAll = $crawler->filter( $itemSelector );

    $crawler->filter( $itemSelector )->each( function($node) {
      $questionsAll[] = $node->text();
    });

    /* foreach( $itemsAll as $item ){
      $questionsAll[] = $item->children( $linkSelector )->text();
    } */
    

    dd( $questionsAll );


    return view('modules.distribution.requirement.index')->with([
      'search_by' => $search_by,
      'excel_data' => $excel_data,
      /* 'status'   => $status,
      'paginate' => $paginate,
      'requirement_all' => $requirement_all, */
    ]);
  }



}
