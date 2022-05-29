<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home_Controller;
use App\Http\Controllers\Brand_Controller;
use App\Http\Controllers\Parts_Controller;
use App\Http\Controllers\Vehicle_Controller;
use App\Http\Controllers\Employee_Controller;
use App\Http\Controllers\Purchase_Controller;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\Department_Controller;
use App\Http\Controllers\Designation_Controller;
use App\Http\Controllers\PartsCategory_Controller;
use App\Http\Controllers\VehicleCategory_Controller;



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [Home_Controller::class, 'Homepage'])->name('homepage');


// Symbolic-Link & Laravel-Storage-Link
Route::get('/symlink', [Home_Controller::class, 'CreateSymbolicLink']);
Route::get('/storage-link', [Home_Controller::class, 'CreateStorageLink']);

// Database/Migration Table programmatically by using Artisan::call()
Route::get('/migration-update', [Home_Controller::class, 'DatabaseTableUpdate'])->name('database.migration.update');
Route::get('/migration-fresh', [Home_Controller::class, 'DatabaseTableFresh'])->name('database.migration.fresh');
Route::get('/migration-fresh-seed', [Home_Controller::class, 'DatabaseTableFreshSeed'])->name('database.migration.fresh.seed');
Route::get('/migration-rollback', [Home_Controller::class, 'DatabaseTableRollback'])->name('database.migration.rollback');
Route::get('/db-seed', [Home_Controller::class, 'DatabaseSeed'])->name('database.seed');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'namespace' => 'admin'], function(){

  // Admin-Dashboard Routes
  Route::get('/dashboard', [Dashboard_Controller::class, 'AdminDashboard'])->name('admin.dashboard');

  
  // Employees Routes
  Route::get('/module/employees/employee-index', [Employee_Controller::class, 'EmployeeAll_Index'])->name('employee.all.show');
  Route::get('/module/employees/employee-new', [Employee_Controller::class, 'EmployeeNew_Form'])->name('employee.add.new');
  Route::post('/module/employees/employee-new', [Employee_Controller::class, 'EmployeeNew_Store'])->name('employee.add.new');
  Route::get('/module/employees/single/{employee_uid}/edit', [Employee_Controller::class, 'EmployeeSingle_Edit'])->name('employee.single.edit');
  Route::post('/module/employees/single/{employee_uid}/edit', [Employee_Controller::class, 'EmployeeSingle_Update'])->name('employee.single.edit');


  // Departments Routes
  Route::get('/module/employees/departments', [Department_Controller::class, 'DepartmentNew_Form'])->name('department.add.new');
  Route::post('/module/employees/departments', [Department_Controller::class, 'DepartmentNew_Store'])->name('department.add.new');
  Route::get('/module/employees/department/{department}/edit', [Department_Controller::class, 'DepartmentSingle_Edit'])->name('department.single.edit');
  Route::post('/module/employees/department/{department}/edit', [Department_Controller::class, 'DepartmentSingle_Update'])->name('department.single.edit');


  // Designations Routes
  Route::get('/module/employees/designations', [Designation_Controller::class, 'DesignationNew_Form'])->name('designation.add.new');
  Route::post('/module/employees/designations', [Designation_Controller::class, 'DesignationNew_Store'])->name('designation.add.new');
  Route::get('/module/employees/designation/{designation}/edit', [Designation_Controller::class, 'DesignationSingle_Edit'])->name('designation.single.edit');
  Route::post('/module/employees/designation/{designation}/edit', [Designation_Controller::class, 'DesignationSingle_Update'])->name('designation.single.edit');


  // Vehicles Routes
  /* Route::get('/module/vehicles/vehicle-index', [Vehicle_Controller::class, 'Vehicle_Index'])->name('vehicle.all.show');
  Route::get('/module/vehicles/vehicle-new', [Vehicle_Controller::class, 'Show_VehicleAddForm'])->name('vehicle.add.new');
  Route::post('/module/vehicles/vehicle-new', [Vehicle_Controller::class, 'VehicleNew_Store'])->name('vehicle.add.new');
  Route::get('/module/vehicles/vehicle-single/{vehicle_uid}/edit', [Vehicle_Controller::class, 'SingleVehicleEditForm'])->name('vehicle.single.edit');
  Route::post('/module/vehicles/vehicle-single/{vehicle_uid}/edit', [Vehicle_Controller::class, 'SingleVehicleUpdate'])->name('vehicle.single.edit'); */
  
  // Vehicle-Brands Routes
  /* Route::get('/module/vehicles/vehicle-brands', [Brand_Controller::class, 'BrandAddForm'])->name('vehicle.brands');
  Route::post('/module/vehicles/vehicle-brands', [Brand_Controller::class, 'Store_NewBrand'])->name('vehicle.brands');
  Route::get('/module/vehicles/vehicle-brands/{brand}/edit', [Brand_Controller::class, 'BrandEditForm'])->name('vehicle.brand.edit');
  Route::post('/module/vehicles/vehicle-brands/{brand}/edit', [Brand_Controller::class, 'BrandUpdate'])->name('vehicle.brand.edit'); */

  // Vehicle-Category Routes
  /* Route::get('/module/vehicles/vehicle-categories', [VehicleCategory_Controller::class, 'VehicleCategoryAddForm'])->name('vehicle.categories');
  Route::post('/module/vehicles/vehicle-categories', [VehicleCategory_Controller::class, 'Store_NewVehicleCategory'])->name('vehicle.categories');
  Route::get('/module/vehicles/vehicle-category/{category}/edit', [VehicleCategory_Controller::class, 'VehicleCategoryEditForm'])->name('vehicle.category.edit');
  Route::post('/module/vehicles/vehicle-category/{category}/edit', [VehicleCategory_Controller::class, 'VehicleCategoryUpdate'])->name('vehicle.category.edit'); */


  // Parts Routes
  /* Route::get('/module/vehicles/parts-index', [Parts_Controller::class, 'Parts_Index'])->name('vehicle.parts.all');
  Route::get('/module/vehicles/parts-new', [Parts_Controller::class, 'Show_PartsAddForm'])->name('vehicle.parts.add.new');
  Route::post('/module/vehicles/parts-new', [Parts_Controller::class, 'PartsNew_Store'])->name('vehicle.parts.add.new');
  Route::get('/module/vehicles/parts-single/{parts_uid}/edit', [Parts_Controller::class, 'SinglePartsEditForm'])->name('vehicle.parts.single.edit');
  Route::post('/module/vehicles/parts-single/{parts_uid}/edit', [Parts_Controller::class, 'SinglePartsUpdate'])->name('vehicle.parts.single.edit'); */

  // Parts-Category Routes
  /* Route::get('/module/vehicles/parts-categories', [PartsCategory_Controller::class, 'PartsCategoryAddForm'])->name('vehicle.parts.categories');
  Route::post('/module/vehicles/parts-categories', [PartsCategory_Controller::class, 'Store_NewPartsCategory'])->name('vehicle.parts.categories');
  Route::get('/module/vehicles/parts-category/{category}/edit', [PartsCategory_Controller::class, 'PartsCategoryEditForm'])->name('vehicle.parts.category.edit');
  Route::post('/module/vehicles/parts-category/{category}/edit', [PartsCategory_Controller::class, 'PartsCategoryUpdate'])->name('vehicle.parts.category.edit'); */


  // Parts-Purchase Routes
  /* Route::get('/module/vehicles/parts/purchase-index', [Purchase_Controller::class, 'VehiclePartsPurchase_Index'])->name('vehicle.parts.purchase.all');
  Route::get('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehiclePartsPurchase_Form'])->name('vehicle.parts.purchase.new');
  Route::post('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehiclePartsPurchase_Store'])->name('vehicle.parts.purchase.new');
  Route::get('/module/vehicles/parts/purchase/{purchase}/edit', [Purchase_Controller::class, 'VehiclePartsPurchase_EditForm'])->name('vehicle.parts.purchase.edit');
  Route::post('/module/vehicles/parts/purchase/{purchase}/edit', [Purchase_Controller::class, 'VehiclePartsPurchase_Update'])->name('vehicle.parts.purchase.edit'); */

  /* Route::get('/module/vehicles/parts/purchase-search', [Purchase_Controller::class, 'SearchForm_VehiclePartsPurchase'])->name('vehicle.parts.purchase.search'); */

  /* Route::get('/module/vehicles/parts/purchase-search', [Purchase_Controller::class, 'Search_VehiclePartsPurchase'])->name('vehicle.parts.purchase.search');
  
  Route::get('/module/vehicles/parts/purchase/{purchase_uid}/delete', [Purchase_Controller::class, 'VehiclePartsPurchaseDelete'])->name('vehicle.parts.purchase.delete');
  Route::get('/module/vehicles/parts/purchase/{purchase_uid}/item/{item_uid}/delete', [Purchase_Controller::class, 'VehiclePartsPurchaseItem_Delete'])->name('vehicle.parts.purchase.item.delete'); */



});
