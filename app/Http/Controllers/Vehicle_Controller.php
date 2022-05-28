<?php

namespace App\Http\Controllers;

use App\Models\Brand_Model;
use App\Models\Vehicle_Model;
use App\Models\Department_Model;
use App\Models\Designation_Model;
use App\Models\VehicleCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DateTime;


class Vehicle_Controller extends Controller
{
  // Show All-Vehicles
  function Vehicle_Index( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $search_by      = $request->search_by ?? null;
    $status         = $request->status ?? null;
    $brand_id       = $request->brand_id ?? null;
    $category_id    = $request->category_id ?? null;
    $department_id  = $request->department_id ?? null;
    $driver_id      = $request->driver_id ?? null;
    $helper_id      = $request->helper_id ?? null;
    
    $brand_id       = $brand_id == 'all' || empty($brand_id) ? null : $brand_id;
    $category_id    = $category_id == 'all' || empty($category_id) ? null : $category_id;
    $department_id  = $department_id == 'all' || empty($department_id) ? null : $department_id;
    $driver_id      = $driver_id == 'all' || empty($driver_id) ? null : $driver_id;
    $helper_id      = $helper_id == 'all' || empty($helper_id) ? null : $helper_id;
    
    $searchColumns  = [ 'vehicle_no', 'slug', 'helper_name', 'engine_cc', 'origin' ];

    // Filter or Search using relation
    /*
    $vehicle_all = Vehicle_Model::orderBy('vehicle_no', 'asc')
      //->with('details')->has('details')
      //->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
      ->whereHas('details', function($query) use($vehicle_id){
        $query->where('vehicle_id', '=', $vehicle_id);
      })
      ->get()->all();
      */

    $vehicle_all = null;

    if( $search_by && ! $status && ! $category_id ){
      $vehicle_all = Vehicle_Model::where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( $search_by && $status == 'enabled' && ! $category_id ){
      $vehicle_all = Vehicle_Model::where('enabled', 1)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( $search_by && $status == 'disabled' && ! $category_id ){
      $vehicle_all = Vehicle_Model::where('enabled', 0)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( ! $search_by && $category_id && ! $status ){
      $vehicle_all = Vehicle_Model::where('category_id', $category_id)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( ! $search_by && $category_id && $status == 'enabled' ){
      $vehicle_all = Vehicle_Model::where('enabled', 1)
      ->where('category_id', $category_id)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( ! $search_by && $category_id && $status == 'disabled' ){
      $vehicle_all = Vehicle_Model::where('enabled', 0)
      ->where('category_id', $category_id)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( $search_by && $category_id && ! $status ){
      $vehicle_all = Vehicle_Model::where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->where('category_id', $category_id)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( $search_by && $category_id && $status == 'enabled' ){
      $vehicle_all = Vehicle_Model::where('enabled', 1)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->where('category_id', $category_id)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( $search_by && $category_id && $status == 'disabled' ){
      $vehicle_all = Vehicle_Model::where('enabled', 0)
      ->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->where('category_id', $category_id)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( ! $search_by && ! $category_id && $status == 'enabled' ){
      $vehicle_all = Vehicle_Model::where('enabled', 1)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } elseif( ! $search_by && ! $category_id && $status == 'disabled' ){
      $vehicle_all = Vehicle_Model::where('enabled', 0)
      ->orderBy('vehicle_no', 'asc')->get()->all();

    } else{
      $vehicle_all = Vehicle_Model::orderBy('vehicle_no', 'asc')->get()->all();
    }

    // Filtered by Relationship
    if( $brand_id ){
      $vehicle_all = Vehicle_Model::orderBy('vehicle_no', 'asc')
      ->whereRelation('brand', 'id', '=', $brand_id)->get()->all();

    } elseif( $department_id ){
      $vehicle_all = Vehicle_Model::orderBy('vehicle_no', 'asc')
      ->whereRelation('department', 'id', '=', $department_id)->get()->all();

    } elseif( $driver_id ){
      $vehicle_all = Vehicle_Model::whereRelation('driver', 'id', '=', $driver_id)->get();

    } elseif( $helper_id ){
      $vehicle_all = Vehicle_Model::whereRelation('helper', 'id', '=', $helper_id)->get();
    }

    $brand_all       = Brand_Model::orderBy('name', 'asc')->get()->all();
    $category_all    = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();
    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();

    $driver_all      = Designation_Model::where('slug', 'driver')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();
    $helper_all      = Designation_Model::where('slug', 'helper')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();
      
    return view('modules.vehicle-module.vehicles.index')->with([
      'search_by'        => $search_by,
      'status'           => $status,
      'brand_id'         => $brand_id,
      'brand_all'        => $brand_all,
      'category_id'      => $category_id,
      'category_all'     => $category_all,
      'department_id'    => $department_id,
      'department_all'   => $department_all,
      'driver_id'        => $driver_id,
      'driver_all'       => $driver_all,
      'helper_id'        => $helper_id,
      'helper_all'       => $helper_all,
      'vehicle_all'      => $vehicle_all,
    ]);
  }

  
  // Show Vehicle-Add-New-Form
  function Show_VehicleAddForm( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/
    
    $brand_all       = Brand_Model::orderBy('name', 'asc')->get()->all();
    $category_all    = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();
    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();

    $driver_all      = Designation_Model::where('slug', 'driver')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();
    $helper_all      = Designation_Model::where('slug', 'helper')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.vehicles.new')->with([
      'brand_all'       => $brand_all,
      'category_all'    => $category_all,
      'department_all'  => $department_all,
      'driver_all'      => $driver_all,
      'helper_all'      => $helper_all,
      'countries'       => Countries(),
    ]);
  }


  // Store New-Vehicle
  function VehicleNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/
    
    $countries = [];
    foreach( Countries() as $country ){ $countries[] = $country['slug']; }
    $countries = implode(',', $countries);

    $validator = Validator::make( $request->all(), [
      'vehicle_no'     => [ 'required', 'string', 'max:50', 'unique:vehicles,vehicle_no' ],
      'brand_id'       => [ 'required', 'integer', 'exists:brands,id' ],
      'category_id'    => [ 'required', 'integer', 'exists:vehicle_category,id' ],
      'origin'         => [ 'required', 'string', "in:$countries", 'max:20' ],

      'purchase_date'  => [ 'nullable', 'date_format:d-m-Y' ],
      'department_id'  => [ 'nullable', 'integer', 'exists:departments,id' ],
      'driver_id'      => [ 'nullable', 'integer', 'exists:employees,id' ],
      'helper_id'      => [ 'nullable', 'integer', 'exists:employees,id' ],
      'helper_name'    => [ 'nullable', 'string', 'max:50' ],
      'wheels'         => [ 'nullable', 'integer', 'max:10' ],
      'engine_cc'      => [ 'nullable', 'integer', 'max:2000' ],
    ], [
      'vehicle_no.required'   => 'The Vehicle-number is required.',
      'vehicle_no.max'        => 'The Vehicle-number must be less than 50 characters.',
      'vehicle_no.unique'     => 'The Vehicle-number must be unique.',
      'purchase_date.date_format' => 'The date does not match the correct format (Day-Month-FullYear).',
      'brand_id.required'      => 'The brand is required.',
      'brand_id.exists'        => 'The brand does not exists.',
      'category_id.required'   => 'The category is required.',
      'category_id.exists'     => 'The category does not exists.',
      'origin.required'        => 'The origin-country is required.',
      'origin.in'              => 'The origin-country must be within given list.',
      'department_id.required' => 'The department is required.',
      'department_id.exists'   => 'The department does not exists.',
      'driver_id.exists'       => 'The driver does not exists.',
      'helper_id.exists'       => 'The helper does not exists.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $purchase_date  = $request->purchase_date ? DateTime::createFromFormat('d-m-Y', $request->purchase_date)->format('Y-m-d') : null;

    $newVehicleData = [
      'uid'           => Str::uuid(),
      'vehicle_no'    => $request->vehicle_no,
      'slug'          => Str::slug( $request->vehicle_no ),
      'enabled'       => true,
      'brand_id'      => $request->brand_id,
      'category_id'   => $request->category_id,
      'department_id' => $request->department_id ?? null,
      'driver_id'     => $request->driver_id ?? null,
      'helper_id'     => $request->helper_id ?? null,
      'helper_name'   => $request->helper_id ? null : ($request->helper_name ?? null),
      'is_running'    => true,
      'wheels'        => $request->wheels ?? null,
      'engine_cc'     => $request->engine_cc ?? null,
      'origin'        => $request->origin,
      'purchase_date' => $purchase_date,
      'sold_date'     => null,
    ];

    $newVehicleAdded = Vehicle_Model::create( $newVehicleData );

    return back()->with('success', 'New Vehicle added successfully!');
  }

  
  // Show Vehicle-Edit-Form
  function SingleVehicleEditForm( $vehicle_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $vehicle = Vehicle_Model::where('uid', $vehicle_uid)->first();

    if( ! $vehicle ) return back()->with('error', 'The vehicle not found in system!');

    $brand_all       = Brand_Model::orderBy('name', 'asc')->get()->all();
    $category_all    = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();
    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();

    $driver_all      = Designation_Model::where('slug', 'driver')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();
    $helper_all      = Designation_Model::where('slug', 'helper')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();

    $date_format = 'd-m-Y';

    return view('modules.vehicle-module.vehicles.edit')->with([
      'vehicle'         => $vehicle,
      'date_format'     => $date_format,
      'brand_all'       => $brand_all,
      'category_all'    => $category_all,
      'department_all'  => $department_all,
      'driver_all'      => $driver_all,
      'helper_all'      => $helper_all,
      'countries'       => Countries(),
    ]);
  }


  // Vehicle-Update
  function SingleVehicleUpdate( $vehicle_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $vehicle = Vehicle_Model::where('uid', $vehicle_uid)->first();

    if( ! $vehicle ) return back()->with('error', 'The vehicle not found in system!');
    
    $countries = [];
    foreach( Countries() as $country ){ $countries[] = $country['slug']; }
    $countries = implode(',', $countries);

    $validator = Validator::make( $request->all(), [
      'vehicle_no'        => [ 'required', 'string', 'max:50', "unique:vehicles,vehicle_no,$vehicle->id" ],
      'status'            => [ 'required', 'in:active,not-active' ],
      'present_condition' => [ 'required', 'in:running,stopped' ],
      'brand_id'          => [ 'required', 'integer', 'exists:brands,id' ],
      'category_id'       => [ 'required', 'integer', 'exists:vehicle_category,id' ],
      'origin'            => [ 'required', 'string', "in:$countries", 'max:20' ],

      'purchase_date'     => [ 'nullable', 'date_format:d-m-Y' ],
      'department_id'     => [ 'nullable', 'integer', 'exists:departments,id' ],
      'driver_id'         => [ 'nullable', 'integer', 'exists:employees,id' ],
      'helper_id'         => [ 'nullable', 'integer', 'exists:employees,id' ],
      'helper_name'       => [ 'nullable', 'string', 'max:50' ],
      'wheels'            => [ 'nullable', 'integer', 'max:10' ],
      'engine_cc'         => [ 'nullable', 'integer', 'max:2000' ],
    ], [
      'vehicle_no.required'   => 'The vehicle-number is required.',
      'vehicle_no.max'        => 'The vehicle-number must be less than 50 characters.',
      'vehicle_no.unique'     => 'The vehicle-number must be unique.',
      'status.required'       => 'The vehicle-status is required.',
      'purchase_date.date_format' => 'The date does not match the correct format (Day-Month-FullYear).',
      'brand_id.required'      => 'The brand is required.',
      'brand_id.exists'        => 'The brand does not exists.',
      'category_id.required'   => 'The category is required.',
      'category_id.exists'     => 'The category does not exists.',
      'origin.required'        => 'The origin-country is required.',
      'origin.in'              => 'The origin-country must be within given list.',
      'department_id.required' => 'The department is required.',
      'department_id.exists'   => 'The department does not exists.',
      'driver_id.exists'       => 'The driver does not exists.',
      'helper_id.exists'       => 'The helper does not exists.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $purchase_date = $request->purchase_date ? DateTime::createFromFormat('d-m-Y', $request->purchase_date)->format('Y-m-d') : $vehicle->purchase_date;

    $updateVehicleData = [
      'vehicle_no'    => $request->vehicle_no,
      'slug'          => Str::slug( $request->vehicle_no ),
      'enabled'       => $request->status === 'active',
      'brand_id'      => $request->brand_id,
      'category_id'   => $request->category_id,
      'department_id' => $request->department_id ?? null,
      'driver_id'     => $request->driver_id ?? null,
      'helper_id'     => $request->helper_id ?? null,
      'helper_name'   => $request->helper_id ? null : ($request->helper_name ?? null),
      'is_running'    => $request->present_condition === 'running',
      'wheels'        => $request->wheels ?? null,
      'engine_cc'     => $request->engine_cc ?? null,
      'origin'        => $request->origin,
      'purchase_date' => $purchase_date,
      // 'sold_date'     => null,
    ];

    $vehicleUpdated = $vehicle->update( $updateVehicleData );

    return redirect()->route('vehicle.all.show')->with('success', "The vehicle ($vehicle->vehicle_no) updated successfully!");
  }



}
