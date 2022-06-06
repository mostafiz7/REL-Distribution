<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home_Controller;
use App\Http\Controllers\Admin\Admin_Controller;
use App\Http\Controllers\User_Controller;
use App\Http\Controllers\Entity_Controller;
use App\Http\Controllers\Department_Controller;
use App\Http\Controllers\Designation_Controller;
use App\Http\Controllers\Employee_Controller;
use App\Http\Controllers\Brand_Controller;
use App\Http\Controllers\Parts_Controller;
use App\Http\Controllers\Vehicle_Controller;
use App\Http\Controllers\Purchase_Controller;
use App\Http\Controllers\PartsCategory_Controller;
use App\Http\Controllers\VehicleCategory_Controller;
use Flasher\Laravel\Facade\Flasher;



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [Home_Controller::class, 'Homepage'])->name('homepage');

Route::get('/cache-all', [Home_Controller::class, 'ClearCacheAll']);


/* Route::get('/register', function(){
  Flasher::addError("New user registeration from outside of admin panel is strictly prohibited!");
  return redirect()->route('login');
});

Route::post('/register', function(){
  Flasher::addError("New user registeration from outside of admin panel is strictly prohibited!");
  return redirect()->route('login');
}); */


// Symbolic-Link & Laravel-Storage-Link
Route::get('/symlink', [Home_Controller::class, 'CreateSymbolicLink']);
Route::get('/storage-link', [Home_Controller::class, 'CreateStorageLink']);

// Database/Migration Table programmatically by using Artisan::call()
Route::get('/migration-update', [Home_Controller::class, 'DatabaseTableUpdate'])->name('database.migration.update');
Route::get('/migration-fresh', [Home_Controller::class, 'DatabaseTableFresh'])->name('database.migration.fresh');
Route::get('/migration-fresh-seed', [Home_Controller::class, 'DatabaseTableFreshSeed'])->name('database.migration.fresh.seed');
Route::get('/migration-rollback', [Home_Controller::class, 'DatabaseTableRollback'])->name('database.migration.rollback');
Route::get('/db-seed', [Home_Controller::class, 'DatabaseSeed'])->name('database.seed');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'prevent-back-history'], 'namespace' => 'admin'], function(){

  // Admin-Dashboard Routes
  Route::get('/dashboard', [Admin_Controller::class, 'AdminDashboard'])->name('admin.dashboard');
  

  // User Routes
  Route::get('/user/all', [User_Controller::class, 'UserIndex'])->name('user.all.index');
  Route::get('/user/new', [User_Controller::class, 'CreateUser'])->name('user.new.create');
  Route::post('/user/new', [User_Controller::class, 'StoreUser'])->name('user.new.store');
  Route::get('/user/{uid}/show', [User_Controller::class, 'SingleUser'])->name('user.single.show');
  Route::get('/user/{uid}/edit', [User_Controller::class, 'EditUser'])->name('user.single.edit');
  Route::post('/user/{uid}/edit', [User_Controller::class, 'UpdateUser'])->name('user.single.update');
  Route::get('/my-account', [User_Controller::class, 'MyAccount'])->name('my-profile.edit');
  Route::post('/my-account', [User_Controller::class, 'UpdateMyAccount'])->name('my-profile.update');

  
  // Entity Routes
  Route::get('/entity/index', [Entity_Controller::class, 'EntityIndex'])->name('entity.all.index');
  Route::get('/entity/new', [Entity_Controller::class, 'CreateEntity'])->name('entity.new.create');
  Route::post('/entity/new', [Entity_Controller::class, 'StoreEntity'])->name('entity.new.store');
  Route::get('/entity/{uid}/show', [Entity_Controller::class, 'ShowEntity'])->name('entity.single.show');
  Route::get('/entity/{uid}/edit', [Entity_Controller::class, 'EditEntity'])->name('entity.single.edit');
  Route::post('/entity/{uid}/edit', [Entity_Controller::class, 'UpdateEntity'])->name('entity.single.update');


  // Departments Routes
  Route::get('/departments', [Department_Controller::class, 'DepartmentNew_Form'])->name('department.new.create');
  Route::post('/departments', [Department_Controller::class, 'DepartmentNew_Store'])->name('department.new.store');
  Route::get('/department/{department}/edit', [Department_Controller::class, 'DepartmentSingle_Edit'])->name('department.single.edit');
  Route::post('/department/{department}/edit', [Department_Controller::class, 'DepartmentSingle_Update'])->name('department.single.update');


  // Designations Routes
  Route::get('/designations', [Designation_Controller::class, 'DesignationNew_Form'])->name('designation.new.create');
  Route::post('/designations', [Designation_Controller::class, 'DesignationNew_Store'])->name('designation.new.store');
  Route::get('/designation/{designation}/edit', [Designation_Controller::class, 'DesignationSingle_Edit'])->name('designation.single.edit');
  Route::post('/designation/{designation}/edit', [Designation_Controller::class, 'DesignationSingle_Update'])->name('designation.single.update');
  
  
  // Employees Routes
  Route::get('/employee/index', [Employee_Controller::class, 'EmployeeIndex'])->name('employee.all.index');
  Route::get('/employee/new', [Employee_Controller::class, 'CreateEmployee'])->name('employee.new.create');
  Route::post('/employee/new', [Employee_Controller::class, 'StoreEmployee'])->name('employee.new.store');
  Route::get('/employee/{uid}/show', [Employee_Controller::class, 'ShowEmployee'])->name('employee.single.show');
  Route::get('/employee/{uid}/edit', [Employee_Controller::class, 'EditEmployee'])->name('employee.single.edit');
  Route::post('/employee/{uid}/edit', [Employee_Controller::class, 'UpdateEmployee'])->name('employee.single.update');


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
