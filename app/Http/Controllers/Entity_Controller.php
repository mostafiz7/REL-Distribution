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

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class Entity_Controller extends Controller
{
  // Entity categories
  protected $category_all = [
    'office', 'pos', 'zone', 'store', 'service', 'insource', 'customer'
  ];

  // Entity types
  protected $entity_types = [
    'office', 'sub-office', 'showroom', 'sales-center', 'corporate', 'dealer', 'sub-dealer', 'service-center', 'store', 'sub-store', 'other'
  ];

  // Entity owner
  protected $ownership_all = ['own', 'franchise', 'exclusive', 'other'];


  // get all Territory model
  protected function Territory_All(){
    return Territory_Model::orderBy('name', 'asc')->get();
  }


  // get all Employee model that play as an entity incharge
  protected function Employees(){
    return Employee_Model::whereNotNull('office_id')
      ->where('employment_status', 'permanent')
      ->where('active', 1)->where('is_resigned', 0)
      ->orderBy('name', 'asc')->get();
  }

  
  // get all Entity that would be a parent for new created Entity
  protected function Parents(){
    return Entity_Model::whereIn('category', ['office', 'pos', 'zone', 'store', 'service', 'insource'])
      ->whereIn('type', ['sub-office', 'corporate', 'dealer', 'store', 'sub-store'])
      ->where('ownership', 'own')->where('active', 1)
      ->orderBy('priority', 'asc')->get();
  }



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
    $category     = $request->category ?? null;
    $entity_type  = $request->entity_type ?? null;
    $ownership    = $request->ownership ?? null;
    $status       = $request->status ?? null;

    $territory_id = $territory_id == 'all' || empty($territory_id) ? null : $territory_id;
    $zone_id      = $zone_id == 'all' || empty($zone_id) ? null : $zone_id;
    $category     = $category == 'all' || empty($category) ? null : $category;
    $entity_type  = $entity_type == 'all' || empty($entity_type) ? null : $entity_type;
    $ownership    = $ownership == 'all' || empty($ownership) ? null : $ownership;

    $searchColumns = ['name', 'email', 'phone_primary', 'phone_secondary', 'location', 'address', 'city', 'ps', 'postcode', 'district', 'category', 'type', 'ownership', 'owner_name', 'owner_contact', 'owner_email', 'owner_address'];

    // query condition as array
    // $whereColumns = [ ['name', 'like', "%{$search_by}%"], ['email', 'like', "%{$search_by}%"], ];
    
    // $entity_all = Entity_Model::orderBy('created_at', 'desc')->limit(3)->get();
    // $entity_all = Entity_Model::orderByDesc('created_at')->limit(3)->get()->all();

    // Paginate
    // $entity_all = Entity_Model::latest()->where('status', $status)->paginate($paginate);

    
    $paginate = 20;

    $entity_all     = Entity_Model::latest();

    // $territory_all  = Territory_Model::orderBy('name', 'asc')->get();

    // $entity_cloned = clone $entity_all; // PHP own clone method
    // custom clone method from AppServiceProvider
    $clone_entity = $entity_all->clone();

    $zone_all = $clone_entity->where('category', 'zone')->where('type', 'sub-store')
                  ->orderBy('name', 'asc')->get(['id', 'name']);
    

    if( $status == 'active' ){
      $entity_all = $entity_all->where('active', '=', 1);
    }
    
    if( $status == 'not-active' ){
      $entity_all = $entity_all->where('active', '=', 0);
    }
    
    if( ! empty($territory_id) ){
      $entity_all = $entity_all->where('territory_id', $territory_id);
    }
    
    if( ! empty($zone_id) ){
      // $entity_all = $entity_all->where('category', 'zone')->with('children')->with('parent');
      $entity_all = $entity_all->where('parent_id', $zone_id);
    }
    
    if( ! empty($category) ){
      $entity_all = $entity_all->where('category', $category);
    }
    
    if( ! empty($entity_type) ){
      $entity_all = $entity_all->where('type', $entity_type);
    }
    
    if( ! empty($ownership) ){
      $entity_all = $entity_all->where('ownership', $ownership);
    }
    
    if( ! empty($search_by) ){
      $entity_all = $entity_all->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      });
    }

    // $entity_all = $entity_all->whereNotNull('parent_id');

    // $entity_all = $entity_all->without('children');

    $entity_all = $entity_all->orderBy('priority', 'asc')->with('children');
    $entity_all = $entity_all->paginate($paginate);
    
    //$entity_all = Entity_Model::where('category', 'zone')->with('children')->get();

    //$entity_all = Entity_Model::whereNull('parent_id')->with('children')->get();

    // $entity_all = Entity_Model::where('category', 'zone')->with('children')->with('parent')->get();
    
    /* $category_all = ['office', 'pos', 'zone', 'store', 'service', 'insource', 'customer'];
    $entity_types = ['office', 'sub-office', 'showroom', 'sales-center', 'corporate', 'dealer', 'sub-dealer', 'service-center', 'store', 'sub-store', 'other'];
    $ownership_all = ['own', 'franchise', 'exclusive', 'other']; */

    sort( $this->category_all );
    sort( $this->entity_types );
    sort( $this->ownership_all );


    return view('modules.entity.index')->with([
      'search_by'       => $search_by,
      'territory_id'    => $territory_id,
      'territory_all'   => $this->Territory_All(),
      'zone_id'         => $zone_id,
      'zone_all'        => $zone_all,
      'category'        => $category,
      'category_all'    => $this->category_all,
      'entity_type'     => $entity_type,
      'entity_types'    => $this->entity_types,
      'ownership'       => $ownership,
      'ownership_all'   => $this->ownership_all,
      'status'          => $status,
      'paginate'        => $paginate,
      'entity_all'      => $entity_all,
    ]);

  }

  
  // Entity-New-Form
  public function CreateEntity( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }


    sort( $this->category_all );
    sort( $this->entity_types );
    sort( $this->ownership_all );


    return view('modules.entity.new')->with([
      'category_all'    => $this->category_all,
      'entity_types'    => $this->entity_types,
      'ownership_all'   => $this->ownership_all,
      'territory_all'   => $this->Territory_All(),
      'parents_all'     => $this->Parents(),
      'employee_all'    => $this->Employees(),
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
