<?php

namespace App\Http\Controllers;

use App\Models\Parts_Model;
use Illuminate\Http\Request;
use App\Models\Vehicle_Model;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class Home_Controller extends Controller
{
  /**
   * Create a new controller instance.
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth');
  }


  /**
   * Show the application dashboard.
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function Homepage()
  {
    /* $parts_all   = Parts_Model::orderBy( 'name', 'asc' )->get()->all();
    $vehicle_all = Vehicle_Model::orderBy( 'vehicle_no', 'asc' )->get()->all(); */

    /* return view('pages.homepage')->with([
      'welcome'     => 'Welcome',
    ]); */
    
    return redirect()->route('login');
  }


  // Create-Symbolic-Link
  public function CreateSymbolicLink()
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryArtisanCommand') ){
      Flasher::addError( routeNotAuthorized() );
      return back();
    }


    $target_folder = '/home/rangsapp/public_html/public/assets';
    $link_folder   = '/home/rangsapp/public_html/assets';

    symlink( $target_folder, $link_folder );

    Flasher::addSuccess("Symbolic-Link created successfully!");
    return back();
  }
  
  
  // Create-Laravel-Storage-Link
  public function CreateStorageLink()
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryArtisanCommand') ){
      Flasher::addError( routeNotAuthorized() );
      return back();
    }
    
    
    Artisan::call('storage:link', []);

    Flasher::addSuccess("Storage-Link created successfully!");
    return back();
  }


  // route, view & config clear only
  public function RouteViewClearOnly()
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryArtisanCommand') ){
      Flasher::addError( routeNotAuthorized() );
      return back();
    }
    
    Artisan::call('cache:clear', []);
    Artisan::call('config:clear', []);
    Artisan::call('route:clear', []);
    Artisan::call('view:clear', []);

    Flasher::addSuccess("Cache, Route, Config & View cleared sucessfully!");
    return back();
  }


  // route, view, config - cache & clear
  public function RouteViewClearCache()
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryArtisanCommand') ){
      Flasher::addError( routeNotAuthorized() );
      return back();
    }

    Artisan::call('cache:clear', []);
    Artisan::call('config:cache', []);
    Artisan::call('route:cache', []);
    Artisan::call('view:cache', []);

    Flasher::addSuccess("Cache, Route, Config & View cleared and cached sucessfully!");
    return back();
  }


  // config cache
  public function ConfigCache()
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryArtisanCommand') ){
      Flasher::addError( routeNotAuthorized() );
      return back();
    }

    Artisan::call('config:cache', []);

    Flasher::addSuccess("Config cached sucessfully!");
    return back();
  }


  // session files remove
  public function SessionClear()
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryArtisanCommand') ){
      Flasher::addError( routeNotAuthorized() );
      return back();
    }

    $files = File::allFiles( storage_path( 'framework/sessions/' ) );
    foreach( $files as $file ){
      File::delete( storage_path( 'framework/sessions/' . $file->getFilename() ) );
    }

    Flasher::addSuccess("Session cleared sucessfully!");
    return back();
  }


  // Database/Migration Table Update by Artisan Command
  public function DatabaseTableUpdate()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate', []);

    return redirect()->route('homepage')->with('success', 'Migration updated successfully!');
  }
  
  
  // Database/Migration Table Fresh by Artisan Command
  public function DatabaseTableFresh()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:fresh', []);

    return redirect()->route('homepage')->with('success', 'Migration successfully!');
  }
  
  
  // Database/Migration Table Fresh by Artisan Command
  public function DatabaseTableFreshSeed()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:fresh --seed', []);

    return redirect()->route('homepage')->with('success', 'Migration with dummy data successfully done!');
  }

  
  // Database/Migration Table Rollback by Artisan Command
  public function DatabaseTableRollback()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:rollback', []);

    return redirect()->route('homepage')->with('success', 'Migration rollbacked successfully!');
  }
  

  // DB/Seed by Artisan Command
  public function DatabaseSeed()
  {
    // Call Artisan Command in Controller
    Artisan::call('db:seed', []);

    return redirect()->route('homepage')->with('success', 'Dummy data inserted successfully!');
  }



}
