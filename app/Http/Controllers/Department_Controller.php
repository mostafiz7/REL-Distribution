<?php

namespace App\Http\Controllers;

use App\Models\Department_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class Department_Controller extends Controller
{
  // Show New-Department-Form
  function DepartmentNew_Form( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', RouteNotAuthorized());
    }

    $department_all = Department_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.department.new')->with([
      'department_all' => $department_all,
    ]);
  }


  // Store New-Department
  function DepartmentNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', RouteNotAuthorized());
    }

    $validator = Validator::make( $request->all(), [
      'name'       => [ 'required', 'string', 'max:50', 'unique:departments,name' ],
      'short_name' => [ 'required', 'string', 'max:20' ],
    ], [
      'name.required'        => 'The department-name is required.',
      'name.max'             => 'The department-name must be less than 50 characters.',
      'name.unique'          => 'The department-name must be unique.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $newDepartmentData = [
      'uid'         => Str::uuid(),
      'name'        => $request->name,
      'slug'        => Str::slug( $request->name ),
      'short_name'  => $request->short_name,
    ];

    $newDepartmentAdded = Department_Model::create( $newDepartmentData );

    return back()->with('success', 'New Department added successfully!');
  }

  
  // Edit Single Department
  function DepartmentSingle_Edit( Department_Model $department, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', RouteNotAuthorized());
    }

    if( ! $department ) return back()->with('error', 'The department not found in system!');
    
    return view('modules.department.edit')->with([
      'department' => $department,
    ]);
  }


  // Update Department
  function DepartmentSingle_Update( Department_Model $department, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', RouteNotAuthorized());
    }

    if( ! $department ) return back()->with('error', 'The department not found in system!');

    $validator = Validator::make( $request->all(), [
      'name'        => [ 'required', 'string', 'max:50', "unique:departments,name, $department->id" ],
      'short_name'  => [ 'required', 'string', 'max:20', "unique:departments,short_name, $department->id" ],
    ], [
      'name.required'        => 'The department-name is required.',
      'name.max'             => 'The department-name must be less than 50 characters.',
      'name.unique'          => 'The department-name must be unique.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $updateDepartmentData = [
      'name'        => $request->name,
      'slug'        => Str::slug( $request->name ),
      'short_name'  => $request->short_name,
    ];

    $departmentUpdated = $department->update( $updateDepartmentData );

    return redirect()->route('department.add.new')->with('success', "The department ($department->name) updated successfully!");
  }



}
