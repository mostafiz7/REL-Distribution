<?php

namespace App\Http\Controllers;

use App\Models\PartsCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PartsCategory_Controller extends Controller
{
  // Show Parts-Category-Add-Form
  function PartsCategoryAddForm( Request $request )
  {
    $category_all    = PartsCategory_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.parts.categories')->with([
      'category_all' => $category_all,
    ]);
  }


  // Store New-Parts-Category
  function Store_NewPartsCategory( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'name'        => [ 'required', 'string', 'max:50', 'unique:parts_category,name' ],
      'description' => [ 'nullable', 'string', 'max:191' ],
    ], [
      'name.required'        => 'The category-name is required.',
      'name.max'             => 'The category-name must be less than 50 characters.',
      'name.unique'          => 'The category-name must be unique.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $newPartsCategoryData = [
      'uid'          => Str::uuid(),
      'name'         => $request->name,
      'slug'         => Str::slug( $request->name ),
      'description'  => $request->description ?? null,
    ];

    $newPartsCategoryAdded = PartsCategory_Model::create( $newPartsCategoryData );

    return back()->with('success', 'New Parts-Category added successfully!');
  }

  
  // Show Parts-Category-Edit-Form
  function PartsCategoryEditForm( PartsCategory_Model $category, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $category ) return back()->with('error', 'The category not found in system!');

    return view('modules.vehicle-module.parts.category-edit')->with([
      'category' => $category,
    ]);
  }


  // Update Parts-Category
  function PartsCategoryUpdate( PartsCategory_Model $category, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $category ) return back()->with('error', 'The category not found in system!');

    $validator = Validator::make( $request->all(), [
      'name'        => [ 'required', 'string', 'max:50', "unique:parts_category,name, $category->id" ],
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

    return redirect()->route('vehicle.parts.categories')->with('success', "The category ($category->name) updated successfully!");
  }



}
