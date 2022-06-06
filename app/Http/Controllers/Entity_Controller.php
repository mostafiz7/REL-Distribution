<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Entity_Model;
use Illuminate\Http\Request;
use App\Models\Employee_Model;
use App\Models\Territory_Model;
use Illuminate\Validation\Rule;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class Entity_Controller extends Controller
{
  // Entity All Index
  public function EntityIndex( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }


    $search_by    = $request->search_by ?? null;
    $territory_id = $request->territory_id ?? null;
    $zone_id      = $request->zone_id ?? null;
    $entity_type  = $request->entity_type ?? null;
    $category     = $request->category ?? null;
    $ownership    = $request->ownership ?? null;
    $status       = $request->status ?? null;

    $territory_id = $territory_id == 'all' || empty($territory_id) ? null : $territory_id;
    $zone_id      = $zone_id == 'all' || empty($zone_id) ? null : $zone_id;
    $entity_type  = $entity_type == 'all' || empty($entity_type) ? null : $entity_type;
    $category     = $category == 'all' || empty($category) ? null : $category;
    $ownership    = $ownership == 'all' || empty($ownership) ? null : $ownership;

    $searchColumns = ['name', 'email', 'phone_primary', 'phone_secondary', 'location', 'address', 'city', 'ps', 'postcode', 'district', 'type', 'category', 'ownership', 'owner_name', 'owner_contact', 'owner_email', 'owner_address'];


    // query condition as array
    // $whereColumns = [ ['name', 'like', "%{$search_by}%"], ['email', 'like', "%{$search_by}%"], ];

    
    // $entity_all = Entity_Model::orderBy('created_at', 'desc')->limit(3)->get();
    // $entity_all = Entity_Model::orderByDesc('created_at')->limit(3)->get()->all();

    // Paginate
    // $entity_all = Entity_Model::latest()->where('status', $status)->paginate($paginate);


    $entity_types = '';
    $category_all = '';
    $ownership_all = '';

    
    $paginate = 20;

    $entity_all     = Entity_Model::latest();

    $territory_all  = Territory_Model::orderBy('name', 'asc')->get();

    // $entity_cloned = clone $entity_all; // PHP own clone method
    // custom clone method from AppServiceProvider
    $entity_cloned = $entity_all->clone();

    $zone_all = $entity_cloned->where('type', 'zone')
                  ->orderBy('name', 'asc')->get(['id', 'name']);
    

    if( $status == 'active' ){
      $entity_all = $entity_all->where('active', '=', 1)->with('children');
    }
    
    if( $status == 'not-active' ){
      $entity_all = $entity_all->where('active', '=', 0)->with('children');
    }
    
    if( ! empty($territory_id) ){
      $entity_all = $entity_all->where('territory_id', $territory_id)->with('children');
    }
    
    if( ! empty($zone_id) ){
      // $entity_all = $entity_all->where('type', 'zone')->with('children')->with('parent');
      $entity_all = $entity_all->where('parent_id', $zone_id)->with('children');
    }
    
    if( ! empty($entity_type) ){
      $entity_all = $entity_all->where('type', $entity_type)->with('children');
    }
    
    if( ! empty($category) ){
      $entity_all = $entity_all->where('category', $category)->with('children');
    }
    
    if( ! empty($ownership) ){
      $entity_all = $entity_all->where('ownership', $ownership)->with('children');
    }
    
    if( ! empty($search_by) ){
      $entity_all = $entity_all->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      });
    }

    $entity_all = $entity_all->whereNotNull('parent_id');

    // $entity_all = $entity_all->without('children');

    $entity_all = $entity_all->paginate($paginate);

    //$entity_all = Entity_Model::where('type', 'zone')->with('children')->get();

    //$entity_all = Entity_Model::whereNull('parent_id')->with('children')->get();

    // $entity_all = Entity_Model::where('type', 'zone')->with('children')->with('parent')->get();


    return view('modules.entity.index')->with([
      'search_by'       => $search_by,
      'territory_id'    => $territory_id,
      'territory_all'   => $territory_all,
      'zone_id'         => $zone_id,
      'zone_all'        => $zone_all,
      'entity_type'     => $entity_type,
      'entity_types'    => $entity_types,
      'category'        => $category,
      'category_all'    => $category_all,
      'ownership'       => $ownership,
      'ownership_all'   => $ownership_all,
      'status'          => $status,
      'paginate'        => $paginate,
      'entity_all'      => $entity_all,
    ]);

  }

  
  // Entity-New-Form
  public function CreateEntity( Request $request )
  {
    //$entity_all = Entity_Model::where('type', 'zone')->with('children')->get();

    //$entity_all = Entity_Model::whereNull('parent_id')->with('children')->get();

    $entity_all = Entity_Model::where('type', 'zone')->with('children')->get();
    
    //dd( $entity_all );

    return view('modules.entity.index')->with([
      'entity_all'  => $entity_all,
    ]);

  }

  
  // Store New-Entity
  function StoreEntity( Request $request )
  {

  }


  // Single Entity Show
  function ShowEntity( $uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryView') || Gate::denies('routeHasAccess') ){
      return back()->with('error', RouteNotAuthorized());
    }


    $entity = Entity_Model::where('uid', $uid)
                ->with('children')->with('parent')->get()->first();

    if( ! $entity ) return back()->with('error', 'The entity not found in system!');

    
    dd( $entity );

  }


  // Entity Edit Form
  function EditEntity( $uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', RouteNotAuthorized());
    }


    $entity = Entity_Model::where('uid', $uid)
                ->with('children')->with('parent')->get()->first();

    if( ! $entity ) return back()->with('error', 'The entity not found in system!');

    
    dd( $entity );

  }


  // Update Entity
  function UpdateEntity( $uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', RouteNotAuthorized());
    }


    $entity = Entity_Model::where('uid', $uid)
                ->with('children')->with('parent')->get()->first();

    if( ! $entity ) return back()->with('error', 'The entity not found in system!');

    
    dd( $entity );

  }
  


}
