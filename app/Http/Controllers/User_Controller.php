<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Role_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
    $status   = $request->status == 'active' ? 'active' : ($request->status == 'inactive' ? 'inactive' : null);

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
    
    if( $status == 'inactive' ){
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
    foreach( Route::getRoutes()->getRoutes() as $route ){
      $action = $route->getAction();
      if( array_key_exists('as', $action) ){
        $routes_arr[] = $action['as'];
      }
    }

    $route_exclude = [
      'ignition.healthCheck', 'ignition.executeSolution',
      'ignition.shareReport', 'ignition.scripts', 'ignition.styles',
      'login', 'logout', 'register', 'homepage', 'menu', 'menu.ordering',
      'order.place', 'coupon.apply', 'reservation.table', 'contact-us',
      'members.home', 'members.loyalty', 'members.orders', 'members.profile',
      'members.address', 'members.numbers', 'members.password.change',
    ];

    // exclude unnecessary route from array value with key & re-index the key
    $routes_all = array_values( array_diff( $routes_arr, $route_exclude ) );

    // Remove duplicate array value & sorting by ascending order
    $routes = array_unique( $routes_all );
    sort($routes);

    $roles       = Role_Model::get()->all();
    $permissions = Permission_Model::get()->all();

    return view('admin.user.new')->with([
      'roles'       => $roles,
      'routes'      => $routes,
      'permissions' => $permissions,
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
      //'title'           => [ 'nullable', 'string', 'max:8' ],
      'first_name'      => [ 'required', 'string', 'max:191' ],
      'last_name'       => [ 'required', 'string', 'max:191' ],
      'email'           => [ 'required', 'string', 'email:rfc,dns', 'max:191', 'unique:users,email' ],
      'password'        => [ 'required', 'string', 'min:8', 'max:12', 'confirmed' ],
      'user_role'       => [ 'required', 'integer', 'between:1,5' ],

      'image'           => [ 'nullable', 'image', 'mimes:jpg,jpeg,png,bmp', 'max:1024', 'dimensions:max_width=1200,max_height=1200' ],
      'birth_date'      => [ 'nullable', 'date_format:d-m-Y' ],
      'mobile_number'   => [ 'nullable', 'numeric', 'digits_between:11,13' ],
      'landline_number' => [ 'nullable', 'numeric', 'digits_between:7,9' ],
      'address_1'       => [ 'nullable', 'string', 'max:191' ],
      'address_2'       => [ 'nullable', 'string', 'max:191' ],
      'city'            => [ 'nullable', 'string', 'max:191' ],
      'state'           => [ 'nullable', 'string', 'max:191' ],
      'postcode'        => [ 'nullable', 'string', 'max:191' ],
      'country'         => [ 'nullable', 'string', 'max:191' ],
    ], [
      'image.image'      => 'The uploaded file must be an image.',
      'image.mimes'      => 'The image type must be: jpg, jpeg, png or bmp.',
      'image.max'        => 'The image size must not be greater than 1 MB.',
      'image.dimensions' => 'The image dimension must be less then 1200 X 1200 pixel.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $birth_date  = $request->birth_date ? DateTime::createFromFormat('d-m-Y', $request->birth_date)->format('Y-m-d') : null;
    $company_address = Settings_Model::count() == 1 ? Settings_Model::get()->first()->value('company_address') : null;

    $address = [
      'id'          => 1,
      'isDefault'   => true,
      'description' => null,
      'address_1'   => $request->address_1 ?? ($company_address ? $company_address['address_1'] : null),
      'address_2'   => $request->address_2 ?? ($company_address ? $company_address['address_2'] : null),
      'city'        => $request->city ?? ($company_address ? $company_address['city'] : null),
      'state'       => $request->state ?? ($company_address ? $company_address['state'] : null),
      'postcode'    => $request->postcode ?? ($company_address ? $company_address['postcode'] : null),
      'country'     => $request->country ?? ($company_address ? $company_address['country'] : null),
    ];

    $get_role    = Role_Model::find( $request->user_role );
    $role_id     = $get_role ? $get_role->id : 6;
    $role        = $get_role ? $get_role->slug : 'member';
    $permissions = $request->permissions ?? null;
    $routes      = $request->routes ?? null;

    if( ! $permissions ){
      $validator->errors()->add('permissions', 'The permissions field is required!');
      Flasher::addError("The permissions field is required!");
      return back()->withErrors( $validator )->withInput();
    }
    if( ! $routes ){
      $validator->errors()->add('routes', 'The routes field is required!');
      Flasher::addError("The routes field is required!");
      return back()->withErrors( $validator )->withInput();
    }

    $avatar = $request->file('image');
    $image  = null;

    // Upload-User-Image
    if( $avatar ){
      if( $avatar->isValid() ){
        $full_name = $request->first_name . ' ' . $request->last_name;
        $full_name_slug = Str::slug($full_name);

        $table_status = DB::select("show table status like 'users'");
        $current_id = $table_status[0]->Auto_increment;

        $extension = $avatar->getClientOriginalExtension();
        $fileName = "user_id__{$current_id}" . "__{$full_name_slug}" . ".{$extension}";
        $location = 'assets/img/admins/';
        $path = public_path() . "/{$location}" . $fileName;

        $Image = Image::make( $avatar );
        $Image->resize( 800, 800, function( $constraint ){
          $constraint->aspectRatio();
          $constraint->upsize();
        });
        // image save with quality compression to 50%
        $Image->save( $path, 50 );
        $Image->destroy();

        $image = [
          'name'     => $fileName,
          'location' => $location,
          'url'      => $location . $fileName,
        ];
      } else{
        Flasher::addError("The image not valid.");
        return back();
      }
    }

    $request_all = [
      //'id'                  => mb_strtoupper( Str::orderedUid() ),
      //'title'               => ucwords( $request->title ),
      'first_name'          => ucwords( strtolower( $request->first_name ) ),
      'last_name'           => ucwords( strtolower( $request->last_name ) ),
      'email'               => strtolower( $request->email ),
      'email_verified_at'   => null,
      'password'            => $request->password,
      //'password'            => Hash::make($request->password),
      'active'              => true,
      'role_id'             => $role_id,
      'role'                => $role,
      'permissions'         => $permissions,
      'routes'              => $routes,
      'birth_date'          => $birth_date,
      'mobile_number'       => $request->mobile_number,
      'landline_number'     => $request->landline_number,
      'addresses'           => array( $address ),
      'image'               => $image,
      'terms'               => true,
      'promo_email'         => false,
      'promo_sms'           => false,
      'sms_service'         => null,
      'email_service'       => null,
    ];

    $user_created = User::create( $request_all );

    if( $user_created ){
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
    foreach( Route::getRoutes()->getRoutes() as $route ){
      $action = $route->getAction();
      if( array_key_exists('as', $action) ){
        $routes_arr[] = $action['as'];
      }
    }

    $route_exclude = [
      'ignition.healthCheck', 'ignition.executeSolution',
      'ignition.shareReport', 'ignition.scripts', 'ignition.styles',
      'login', 'logout', 'register', 'homepage', 'menu', 'menu.ordering',
      'order.place', 'coupon.apply', 'reservation.table', 'contact-us',
      'members.home', 'members.loyalty', 'members.orders', 'members.profile',
      'members.address', 'members.numbers', 'members.password.change',
    ];

    // exclude unnecessary route from array value with key & re-index the key
    $routes_all = array_values( array_diff( $routes_arr, $route_exclude ) );

    // Remove duplicate array value & sorting by ascending order
    $routes = array_unique( $routes_all );
    sort($routes);

    $roles       = Role_Model::get()->all();
    $permissions = Permission_Model::get()->all();

    session()->flash('previousUrl', $previousUrl);

    return view('admin.user.edit')->with([
      'user'        => $user,
      'roles'       => $roles,
      'routes'      => $routes,
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
      'active'          => [ 'required', 'string' ],
      'name'            => [ 'prohibited' ],
      'username'        => [ 'prohibited' ],
      'email'           => [ 'prohibited' ],
      //'email'           => [ 'required', 'string', 'email:rfc,dns', 'max:191', "unique:users,email, $id" ],
      'password'        => [ 'nullable', 'string', 'min:8', 'max:12', 'confirmed' ],
      'user_role'       => [ 'required', 'integer', 'between:1,5', 'exists:roles,id' ],
    ], [
      'name.prohibited'  => 'User\'s name can\'t change in here.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();


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
    
    
    // $get_role     = Role_Model::find( $request->user_role );
    // $role_id      = $get_role ? $get_role->id : 6;
    // $role         = $get_role ? $get_role->slug : 'customer';
    $permissions  = $request->permissions ?? null;
    $routes       = $request->routes ?? null;

    if( ! $permissions ){
      $validator->errors()->add('permissions', 'The permissions field is required!');
      Flasher::addError("The permissions field is required!");
      return back()->withErrors( $validator )->withInput();
    }
    if( ! $routes ){
      $validator->errors()->add('routes', 'The routes field is required!');
      Flasher::addError("The routes field is required!");
      return back()->withErrors( $validator )->withInput();
    }

    
    $updated_data = [
      // 'name'              => ucwords( strtolower( $request->name ) ),
      // 'username'          => strtolower( $request->username ),
      // 'email'             => strtolower( $request->email ),
      // 'email_verified_at' => null,
      'active'            => $request->active === 'active',
      'role_id'           => $request->user_role,
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
