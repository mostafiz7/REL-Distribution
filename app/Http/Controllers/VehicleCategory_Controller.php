<?php

namespace App\Http\Controllers;

use App\Models\VehicleCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VehicleCategory_Controller extends Controller
{
  // Show Vehicle-Category-Add-Form
  function VehicleCategoryAddForm( Request $request )
  {
    $category_all    = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.vehicles.categories')->with([
      'category_all' => $category_all,
    ]);
  }


  // Store New-Vehicle-Category
  function Store_NewVehicleCategory( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'name'        => [ 'required', 'string', 'max:50', 'unique:vehicle_category,name' ],
      'description' => [ 'nullable', 'string', 'max:191' ],
    ], [
      'name.required'        => 'The category-name is required.',
      'name.max'             => 'The category-name must be less than 50 characters.',
      'name.unique'          => 'The category-name must be unique.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $newVehicleCategoryData = [
      'uid'          => Str::uuid(),
      'name'         => $request->name,
      'slug'         => Str::slug( $request->name ),
      'description'  => $request->description ?? null,
    ];

    $newVehicleCategoryAdded = VehicleCategory_Model::create( $newVehicleCategoryData );

    return back()->with('success', 'New Vehicle-Category added successfully!');
  }

  
  // Show Vehicle-Category-Edit-Form
  function VehicleCategoryEditForm( VehicleCategory_Model $category, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $category ) return back()->with('error', 'The category not found in system!');

    return view('modules.vehicle-module.vehicles.category-edit')->with([
      'category' => $category,
    ]);
  }


  // Update Vehicle-Category
  function VehicleCategoryUpdate( VehicleCategory_Model $category, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $category ) return back()->with('error', 'The category not found in system!');

    $validator = Validator::make( $request->all(), [
      'name'        => [ 'required', 'string', 'max:50', "unique:vehicle_category,name, $category->id" ],
      'description' => [ 'nullable', 'string', 'max:191' ],
    ], [
      'name.required' => 'The category-name is required.',
      'name.max'      => 'The category-name must be less than 50 characters.',
      'name.unique'   => 'The category-name must be unique.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $updateCategoryData = [
      'name'         => $request->name,
      'slug'         => Str::slug( $request->name ),
      'description'  => $request->description ?? null,
    ];

    $categoryUpdated = $category->update( $updateCategoryData );

    return redirect()->route('vehicle.categories')->with('success', "The category ($category->name) updated successfully!");
  }



}
