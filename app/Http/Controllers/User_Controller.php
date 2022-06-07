<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Role_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Employee_Model;
use App\Models\Settings_Model;
use Illuminate\Validation\Rule;
use App\Models\Permission_Model;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class User_Controller extends Controller
{
  // If user is not logged in then he can't access this page
  public function __construct()
  {
    // $this->middleware('auth:admin');
  }


  // Get-All-User-Index
  public function UserIndex( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    $searchBy = $request->search_by ?? null;
    $status   = $request->status ?? null;

    $searchColumns = ['name', 'username', 'email', 'phone_personal', 'phone_official'];
    $role_id = [ 1, 2, 3, 4, 5 ];
    // $role = $request->role;

    // query condition as array
    // $whereColumns = [ ['name', 'like', "%{$searchBy}%"], ['email', 'like', "%{$searchBy}%"], ];

    
    $paginate = 20;
    
    // $user_all = User::get()->all();
    // $user_all = User::orderBy('created_at', 'desc')->limit(3)->get();
    // $user_all = User::orderByDesc('created_at')->limit(3)->get()->all();

    // Paginate
    // $user_all = User::latest()->where('status', $status)->paginate($paginate);


    $user_all = User::latest();
    
    if( $status == 'active' ){
      $user_all = $user_all->where('active', '=', 1);
    }
    
    if( $status == 'not-active' ){
      $user_all = $user_all->where('active', '=', 0);
    }
    
    if( ! empty($searchBy) ){
      $user_all = $user_all->where( function($q) use( $searchColumns, $searchBy ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$searchBy}%" );
      });
    }
    
    $user_all = $user_all->whereIn('role_id', $role_id)->orderBy('name', 'asc');

    $user_all = $user_all->paginate($paginate);

    return view('admin.user.index')->with([
      'searchBy' => $searchBy,
      'status'   => $status,
      'paginate' => $paginate,
      'user_all' => $user_all,
    ]);
  }


  // Create-New-User-Form-From-Admin-Backend
  public function CreateUser( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    
    // Get all named-route to uses for user permissions
    $routes_arr = [];
    $routes_generated = [];
    foreach( Route::getRoutes()->getRoutes() as $route ){
      $action = $route->getAction();
      if( array_key_exists('as', $action) ){
        $routes_arr[] = $action['as'];

        if( str_contains($action['as'], 'generated') || str_contains($action['as'], 'ignition') ){
          $routes_generated[] = $action['as'];
        }
      }
    }

    $route_exclude = [
      'login', 'logout', 'register', 'homepage', 'contact-us',
    ];

    $route_exclude_all = array_merge($routes_generated, $route_exclude);

    // exclude unnecessary route from array value with key & re-index the key
    $routes_all = array_values( array_diff( $routes_arr, $route_exclude_all ) );

    // Remove duplicate array value & sorting by ascending order
    $routes = array_unique( $routes_all );
    sort($routes);


    $routes_with_group = [];
    foreach( $routes as $route ){
      $group_name = explode('.', $route)[0];
      if( str_contains($route, $group_name) ){
        $routes_with_group[$group_name][] = $route;
      }
    }


    $employee_all = Employee_Model::whereNull('user_id')
                      ->orderBy('name', 'asc')->get();
    $roles        = Role_Model::get()->all();
    $permissions  = Permission_Model::get()->all();


    return view('admin.user.new')->with([
      'roles'         => $roles,
      'routes'        => $routes_with_group,
      'permissions'   => $permissions,
      'employee_all'  => $employee_all,
    ]);
  }


  // Save-New-User-to-DB-From-Admin-Backend
  public function StoreUser( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    $validator = Validator::make( $request->all(), [
      // 'name'        => ['required', 'string', 'max:191'],
      'employee_id' => ['required', 'numeric', 'exists:employees,id', 'unique:users,employee_id'],
      'username'    => ['required', 'string', 'max:50', 'unique:users,username'],
      'email'       => ['required', 'string', 'email:rfc,dns', 'max:191', 'exists:employees,email_official', 'unique:users,email'],
      'password'    => ['required', 'string', 'min:8', 'max:12', 'confirmed'],
      'role_id'     => ['required', 'numeric', 'between:1,5', 'exists:roles,id'],
      /* 'phone_personal'  => [ 'nullable', 'numeric', 'digits_between:11,13' ],
      'phone_official'  => [ 'nullable', 'numeric', 'digits_between:11,13' ], */
    ], [
      'employee_id.required'  => 'The employee name is required field.',
      'employee_id.numeric'   => 'The employee name not matched.',
      'employee_id.exists'    => 'The employee not exists in system.',
      'employee_id.unique'    => 'The employee has already user profile.',
      'email.exists'          => 'The selected email not exists in system.',
      'role_id.required'      => 'The user-role field is required.',
      'role_id.numeric'       => 'The user-role not matched.',
      'role_id.between'       => 'The user-role not matched.',
      'role_id.exists'        => 'The user-role not exists in system.',
    ]);
    if($validator->fails()) return back()->withErrors($validator)->withInput();
    

    $permissions = $request->permissions ?? null;
    $routes      = $request->routes ?? null;

    if( ! $permissions || ! $routes ){
      if( ! $permissions ){
        $validator->errors()->add('permissions', 'The permissions field is required!');
        Flasher::addError("The permissions field is required!");
      }
      if( ! $routes ){
        $validator->errors()->add('routes', 'The routes field is required!');
        Flasher::addError("The routes field is required!");
      }
      
      return back()->withErrors( $validator )->withInput();
    }
    

    $employee = Employee_Model::find( $request->employee_id );

    if( ! empty($employee->user_id) ){
      Flasher::addError("The employee has already user profile.");
      return back();
    }

    $request_all = [
      'uid'                 => Str::uuid(),
      'name'                => $employee->name,
      'username'            => strtolower( $request->username ),
      'email'               => strtolower( $request->email ),
      //'active'              => true,
      'password'            => $request->password,
      //'password'            => Hash::make($request->password),
      'role_id'             => $request->role_id,
      'employee_id'         => $request->employee_id,
      'phone_personal'      => $employee->phone_personal,
      'phone_official'      => $employee->phone_official,
      'permissions'         => $permissions,
      'routes'              => $routes,
      'settings'            => null,
      'email_settings'      => null,
      'sms_settings'        => null,
      'notif_settings'      => null,
    ];

    $user_created = User::create( $request_all );


    if( $user_created ){
      $employee->update([ 'user_id' => $user_created->id ]);

      Flasher::addSuccess("New User created successfully!");
      return back();

    } else{
      Flasher::addError("Something went wrong.");
      return back();
    }
  }


  // Single-User-Show-From-Admin-Backend
  public function SingleUser( $uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryView') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    
    $user = User::where( 'uid', $uid )->get()->first();

    if( ! $user ){
      Flasher::addError("The user not found in system.");
      return back();
    }

    return view('admin.user.single')->with([
      'user'  => $user,
    ]);
  }


  // Edit-User-Form-From-Admin-Backend
  public function EditUser( $uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    $user = User::where( 'uid', $uid )->get()->first();

    if( ! $user ){
      Flasher::addError("The user not found in system.");
      return back();
    }

    // get previous url parameters
    $previousUrl = parse_url( url()->previous() );


    // Get all named-route to uses for user permissions
    $routes_arr = [];
    $routes_generated = [];
    foreach( Route::getRoutes()->getRoutes() as $route ){
      $action = $route->getAction();
      if( array_key_exists('as', $action) ){
        $routes_arr[] = $action['as'];

        if( str_contains($action['as'], 'generated') || str_contains($action['as'], 'ignition') ){
          $routes_generated[] = $action['as'];
        }
      }
    }

    $route_exclude = [
      'login', 'logout', 'register', 'homepage', 'contact-us',
    ];

    $route_exclude_all = array_merge($routes_generated, $route_exclude);

    // exclude unnecessary route from array value with key & re-index the key
    $routes_all = array_values( array_diff( $routes_arr, $route_exclude_all ) );

    // Remove duplicate array value & sorting by ascending order
    $routes = array_unique( $routes_all );
    sort($routes);


    $routes_with_group = [];
    foreach( $routes as $route ){
      $group_name = explode('.', $route)[0];
      if( str_contains($route, $group_name) ){
        $routes_with_group[$group_name][] = $route;
      }
    }


    $roles       = Role_Model::get()->all();
    $permissions = Permission_Model::get()->all();

    session()->flash('previousUrl', $previousUrl);

    return view('admin.user.edit')->with([
      'user'        => $user,
      'roles'       => $roles,
      'routes'      => $routes_with_group,
      'permissions' => $permissions,
    ]);
  }


  // User-Update-From-Admin-Backend
  public function UpdateUser( $uid, Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    
    $user = User::where( 'uid', $uid )->get()->first();

    if( ! $user ){
      Flasher::addError("The user not found in system.");
      return back();
    }


    $previousUrl = session()->get('previousUrl') ?? parse_url( url()->previous() );
    $search_by = null; $status = null;

    if( $previousUrl && $previousUrl['path'] == '/admin/user/all' ){
      if( array_key_exists('query', $previousUrl) ){
        parse_str( $previousUrl['query'], $params );
        $search_by  = $params['search_by'] ?? null;
        $status     = $params['status'] ?? null;
      }
    }
    $previousUrlQuery = [ 'search_by' => $search_by, 'status' => $status, ];


    $validator = Validator::make( $request->all(), [
      'active'    => [ 'required', 'string' ],
      'name'      => [ 'prohibited' ],
      'username'  => [ 'prohibited' ],
      'email'     => [ 'prohibited' ],
      // 'username'  => ['required', 'string', 'max:50', "unique:users,username, $id"],
      // 'email'     => ['required', 'string', 'email:rfc,dns', 'max:191', "exists:employees,email_official", "unique:users,email, $user_id"],
      'password'  => [ 'nullable', 'string', 'min:8', 'max:12', 'confirmed' ],
      'role_id'   => [ 'required', 'numeric', 'between:1,5', 'exists:roles,id' ],
      // 'employee_id' => ['required', 'numeric', 'exists:employees,id', 'unique:users,employee_id'],
    ], [
      'name.prohibited'  => 'User\'s name can\'t change in here.',
      'role_id.required' => 'The user-role field is required.',
      'role_id.numeric'  => 'The user-role not matched.',
      'role_id.between'  => 'The user-role not matched.',
      'role_id.exists'   => 'The user-role not exists in system.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();


    $active = $request->active === 'active';


    if( $request->has('name') ){
      Flasher::addError("Please, user's name change in employee portal.");
      return back();
    }
    if( $request->has('username') ){
      Flasher::addError("You can't change the username.");
      return back();
    }
    if( $request->has('email') ){
      Flasher::addError("You can't change the email address.");
      return back();
    }
    
    
    $permissions  = $request->permissions ?? null;
    $routes       = $request->routes ?? null;

    if( $active ){
      if( ! $permissions || ! $routes ){
        if( ! $permissions ){
          $validator->errors()->add('permissions', 'The permissions field is required!');
          Flasher::addError("The permissions field is required!");
        }
        if( ! $routes ){
          $validator->errors()->add('routes', 'The routes field is required!');
          Flasher::addError("The routes field is required!");
        }

        return back()->withErrors( $validator )->withInput();
      }

    } else{
      $permissions  = null;
      $routes       = null;
    }

    
    $updated_data = [
      // 'name'              => ucwords( strtolower( $request->name ) ),
      // 'username'          => strtolower( $request->username ),
      // 'email'             => strtolower( $request->email ),
      // 'email_verified_at' => null,
      'active'            => $active,
      'role_id'           => $request->role_id,
      'permissions'       => $permissions,
      'routes'            => $routes,
      //'sms_service'       => null,
      //'email_service'     => null,
    ];

    if( ! empty($request->password) ){
      $updated_data['password'] = $request->password;
    }

    $user_updated = tap( $user )->update( $updated_data );

    if( $user_updated ){
      Flasher::addSuccess("The user updated successfully!");
      return redirect()->route('user.all.index', $previousUrlQuery);

    } else{
      Flasher::addError("Something went wrong.");
      return back();
    }
  }


  // MyAccount-Password-Change
  public function MyAccount()
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    $user     = Auth::user();
    $role_id  = [ 1, 2, 3, 4, 5 ];
    $roles    = [ 'super-admin', 'admin', 'manager', 'moderator', 'user' ];

    if( ! $user ){
      Flasher::addError("The user not found in system.");
      return redirect()->route('logout');
    }

    if( ! in_array($user->role_id, $role_id) && ! in_array($user->role->slug, $roles) ){
      Flasher::addError("The user not found in system.");
      return redirect()->route('logout');
    }

    return view('admin.user.myAccount')->with([
      'user' => $user,
    ]);
  }


  // Update-MyAccount-Password
  public function UpdateMyAccount( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('routeHasAccess') ){
      Flasher::addError( RouteNotAuthorized() );
      return back();
    }

    $user     = User::find( Auth::id() );
    $role_id  = [ 1, 2, 3, 4, 5 ];
    $roles    = [ 'super-admin', 'admin', 'manager', 'moderator', 'user' ];

    if( ! $user || $user->id != $request->userId ){
      Flasher::addError("The user not found in system.");
      return redirect()->route('logout');
    }

    if( ! in_array($user->role_id, $role_id) && ! in_array($user->role->slug, $roles) ){
      Flasher::addError("The user not found in system.");
      return redirect()->route('logout');
    }

    $validator = Validator::make( $request->all(), [
      // 'title'           => [ 'nullable', 'string', 'max:8' ],
      'first_name'      => [ 'required', 'string', 'max:191' ],
      'last_name'       => [ 'required', 'string', 'max:191' ],
      'email'           => [ 'prohibited' ],
      'old_password'    => [ 'nullable', Rule::requiredIf(!empty($request->password)), 'string' ],
      'password'        => [ 'nullable', Rule::requiredIf(!empty($request->old_password)), 'string', 'min:8', 'max:12', 'confirmed' ],

      'birth_date'      => [ 'nullable', 'date_format:d-m-Y' ],
      'mobile_number'   => [ 'nullable', 'numeric', 'digits_between:11,13' ],
      'landline_number' => [ 'nullable', 'numeric', 'digits_between:7,9' ],
      'address_1'       => [ 'nullable', 'string', 'max:191' ],
      'address_2'       => [ 'nullable', 'string', 'max:191' ],
      'city'            => [ 'nullable', 'string', 'max:191' ],
      'state'           => [ 'nullable', 'string', 'max:191' ],
      'postcode'        => [ 'nullable', 'string', 'max:191' ],
      'country'         => [ 'nullable', 'string', 'max:191' ],
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    
    if( $request->has('email') ){
      Flasher::addError("You can't change the email address.");
      return back();
    }

    $address = $user->addresses[0];
    $address['address_1']  = $request->address_1 ?? $address['address_1'];
    $address['address_2']  = $request->address_2 ?? $address['address_2'];
    $address['city']       = $request->city ?? $address['city'];
    $address['state']      = $request->state ?? $address['state'];
    $address['postcode']   = $request->postcode ?? $address['postcode'];
    $address['country']    = $request->country ?? $address['country'];

    $user_data = [
      //'title'             =>  ucwords( $request->title ),
      'first_name'        =>  ucwords( strtolower( $request->first_name ) ),
      'last_name'         =>  ucwords( strtolower( $request->last_name ) ),
      'birth_date'        =>  $request->birth_date ? DateTime::createFromFormat('d-m-Y', $request->birth_date)->format('Y-m-d') : null,
      'mobile_number'     =>  $request->mobile_number,
      'landline_number'   =>  $request->landline_number,
      'addresses'         =>  array($address),
      //'sms_service'       =>  null,
      //'email_service'     =>  null,
    ];


    if( $request->old_password && $request->password ){
      $old_HashedPassword = $user->password;

      if( Hash::check( $request->old_password, $old_HashedPassword ) ){
        if( ! Hash::check( $request->password, $old_HashedPassword ) ){
          $user_data['password'] = $request->password;

        } else{
          $validator->errors()->add('password', 'New password shouldn\'t be same as previous one.');
          Flasher::addError("New password shouldn\'t be same as previous one.");
          return back()->withErrors( $validator )->withInput();
        }
      } else{
        $validator->errors()->add('old_password', 'Old password doesn\'t matched.');
        Flasher::addError("Old password doesn't matched.");
        return back()->withErrors( $validator )->withInput();
      }
    }

    $profile_updated = tap( $user )->update( $user_data );

    if( $profile_updated ){
      if( array_key_exists('password', $user_data) ){
        Session::flush();
        Auth::logout();
        Flasher::addSuccess("Password changed successfully, please login with new-password.");
        // return redirect()->route('logout');
        return redirect()->route('login');

      } else{
        Flasher::addSuccess("Your profile updated successfully!");
        return back();
      }
      
    } else{
      Flasher::addError("Something went wrong.");
      return back();
    }
  }





}
