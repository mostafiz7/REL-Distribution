<?php

namespace App\Http\Controllers;

use App\Models\Parts_Model;
use App\Models\PartsCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Parts_Controller extends Controller
{
  // Show All-Parts
  function Parts_Index( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $search_by      = $request->search_by ?? null;
    $status         = $request->status ?? null;
    $parts_category = $request->parts_category ?? null;
    
    $parts_category = $parts_category == 'all' || empty($parts_category) ? null : $parts_category;
    
    $searchColumns  = [ 'name', 'description', 'sizes', 'metals', 'materials', 'unit', 'origin' ];

    // Filter or Search using relation
    /*
    $parts_all = Parts_Model::orderBy('name', 'asc')
      //->with('details')->has('details')
      //->whereRelation('details', 'parts_id', '=', $parts_id)
      ->whereHas('details', function($query) use($parts_id){
        $query->where('parts_id', '=', $parts_id);
      })
      ->get()->all();
      */

    $parts_all = null;

    if( $search_by && ! $status && ! $parts_category ){
      $parts_all = Parts_Model::where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->orderBy('name', 'asc')->get()->all();

    } elseif( $search_by && $status == 'enabled' && ! $parts_category ){
      $parts_all = Parts_Model::where('enabled', 1)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->orderBy('name', 'asc')->get()->all();

    } elseif( $search_by && $status == 'disabled' && ! $parts_category ){
      $parts_all = Parts_Model::where('enabled', 0)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->orderBy('name', 'asc')->get()->all();

    } elseif( ! $search_by && $parts_category && ! $status ){
      $parts_all = Parts_Model::where('category_id', $parts_category)
      ->orderBy('name', 'asc')->get()->all();

    } elseif( ! $search_by && $parts_category && $status == 'enabled' ){
      $parts_all = Parts_Model::where('enabled', 1)
      ->where('category_id', $parts_category)
      ->orderBy('name', 'asc')->get()->all();

    } elseif( ! $search_by && $parts_category && $status == 'disabled' ){
      $parts_all = Parts_Model::where('enabled', 0)
      ->where('category_id', $parts_category)
      ->orderBy('name', 'asc')->get()->all();

    } elseif( $search_by && $parts_category && ! $status ){
      $parts_all = Parts_Model::where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->where('category_id', $parts_category)
      ->orderBy('name', 'asc')->get()->all();

    } elseif( $search_by && $parts_category && $status == 'enabled' ){
      $parts_all = Parts_Model::where('enabled', 1)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->where('category_id', $parts_category)
      ->orderBy('name', 'asc')->get()->all();

    } elseif( $search_by && $parts_category && $status == 'disabled' ){
      $parts_all = Parts_Model::where('enabled', 0)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->where('category_id', $parts_category)
      ->orderBy('name', 'asc')->get()->all();

    } elseif( ! $search_by && ! $parts_category && $status == 'enabled' ){
      $parts_all = Parts_Model::where('enabled', 1)
      ->orderBy('name', 'asc')->get()->all();

    } elseif( ! $search_by && ! $parts_category && $status == 'disabled' ){
      $parts_all = Parts_Model::where('enabled', 0)
      ->orderBy('name', 'asc')->get()->all();

    } else{
      $parts_all = Parts_Model::orderBy('name', 'asc')->get()->all();
    }

    $category_all = PartsCategory_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.parts.index')->with([
      'search_by'      => $search_by,
      'status'         => $status,
      'parts_category' => $parts_category,
      'parts_all'      => $parts_all,
      'category_all'   => $category_all,
    ]);
  }

  
  // Show Parts-Add-Form
  function Show_PartsAddForm( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/
    
    $category_all    = PartsCategory_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.parts.new')->with([
      'units'           => Units(),
      'countries'       => Countries(),
      'category_all'    => $category_all,
    ]);
  }


  // Store New-Parts
  function PartsNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/
    
    $countries = [];
    foreach( Countries() as $country ){ $countries[] = $country['slug']; }
    $countries = implode(',', $countries);

    $validator = Validator::make( $request->all(), [
      'name'           => [ 'required', 'string', 'max:50', 'unique:parts,name' ],
      'category_id'    => [ 'required', 'integer', 'exists:parts_category,id' ],
      'unit'           => [ 'required', 'string', 'max:10' ],

      'description'    => [ 'nullable', 'string', 'max:191' ],
      'sizes'          => [ 'nullable', 'string', 'max:191' ],
      'metals'         => [ 'nullable', 'string', 'max:191' ],
      'materials'      => [ 'nullable', 'string', 'max:191' ],
      'origin'         => [ 'nullable', 'string', "in:$countries", 'max:20' ],
    ], [
      'name.required'        => 'The parts-name is required.',
      'name.max'             => 'The parts-name must be less than 50 characters.',
      'name.unique'          => 'The parts-name must be unique.',
      'category_id.required' => 'The category is required.',
      'category_id.exists'   => 'The category does not exists.',
      'origin.in'            => 'The origin-country must be within given list.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $newPartsData = [
      'uid'          => Str::uuid(),
      'name'         => $request->name,
      'slug'         => Str::slug( $request->name ),
      'enabled'      => true,
      'category_id'  => $request->category_id,
      'description'  => $request->description ?? null,
      'sizes'        => $request->sizes ?? null,
      'metals'       => $request->metals ?? null,
      'materials'    => $request->materials ?? null,
      'unit'         => $request->unit,
      'origin'       => $request->origin ?? null,
    ];

    $newPartsAdded = Parts_Model::create( $newPartsData );

    return back()->with('success', 'New Parts added successfully!');
  }

  
  // Show Parts-Edit-Form
  function SinglePartsEditForm( $parts_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $parts = Parts_Model::where('uid', $parts_uid)->first();

    if( ! $parts ) return back()->with('error', 'The parts not found in system!');

    $category_all = PartsCategory_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.parts.edit')->with([
      'units'           => Units(),
      'parts'           => $parts,
      'countries'       => Countries(),
      'category_all'    => $category_all,
    ]);
  }


  // Parts Update
  function SinglePartsUpdate( $parts_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $parts = Parts_Model::where('uid', $parts_uid)->first();

    if( ! $parts ) return back()->with('error', 'The parts not found in system!');
    
    $countries = [];
    foreach( Countries() as $country ){ $countries[] = $country['slug']; }
    $countries = implode(',', $countries);

    $validator = Validator::make( $request->all(), [
      'name'        => [ 'required', 'string', 'max:50', "unique:parts,name, $parts->id" ],
      'status'      => [ 'required', 'in:active,not-active' ],
      'category_id' => [ 'required', 'integer', 'exists:parts_category,id' ],
      'unit'        => [ 'required', 'string', 'max:10' ],

      'description' => [ 'nullable', 'string', 'max:191' ],
      'sizes'       => [ 'nullable', 'string', 'max:191' ],
      'metals'      => [ 'nullable', 'string', 'max:191' ],
      'materials'   => [ 'nullable', 'string', 'max:191' ],
      'origin'      => [ 'nullable', 'string', "in:$countries", 'max:20' ],
    ], [
      'name.required'        => 'The parts-name is required.',
      'name.max'             => 'The parts-name must be less than 50 characters.',
      'name.unique'          => 'The parts-name must be unique.',
      'status.required'      => 'The parts-status is required.',
      'category_id.required' => 'The category is required.',
      'category_id.exists'   => 'The category does not exists.',
      'origin.in'            => 'The origin-country must be within given list.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $updatePartsData = [
      'name'         => $request->name,
      'slug'         => Str::slug( $request->name ),
      'enabled'      => $request->status === 'active',
      'category_id'  => $request->category_id,
      'description'  => $request->description ?? null,
      'sizes'        => $request->sizes ?? null,
      'metals'       => $request->metals ?? null,
      'materials'    => $request->materials ?? null,
      'unit'         => $request->unit,
      'origin'       => $request->origin ?? null,
    ];

    $vehicleUpdated = $parts->update( $updatePartsData );

    return redirect()->route('vehicle.parts.all')->with('success', "The parts ($parts->name) updated successfully!");
  }



}
