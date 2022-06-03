@extends( 'layouts.app' )

@section( 'title', 'Edit User' )

@section( 'site-content' )
  <div class="Page User Edit">
    <div class="page-wrapper p-10">
      <div class="edit-user-page">
        <div class="page-content">
          <div class="card">
            <div class="card-header page-header d-flex justify-content-between align-items-center bg-danger text-white">
              <h5 class="card-title title lh-1-5 my-0">User Edit Mode</h5>

              <div class="">
                <a href="{{ route('user.add.new') }}" class="btn btn-light btn-sm fw-bold">
                  Add User
                </a>
  
                <a href="{{ route('user.all.index') }}" class="btn btn-light btn-sm fw-bold ml-5">
                  User Index
                </a>
              </div>
            </div>

            {{--@if (session('error'))
              <div role="alert" class="alert alert-danger alert-dismissible fade show fw-bold fz-18 text-center lh-1 py-3 mb-20">
                {{ session('error') }}
                <button type="button" class="btn-close mt-5 mr-5" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @elseif (session('success'))
              <div role="alert" class="alert alert-success alert-dismissible fade show fw-bold fz-18 text-center lh-1 py-3 mb-20">
                {{ session('success') }}
                <button type="button" class="btn-close mt-5 mr-5" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif--}}

            <div class="card-body overflowY-scroll">
              <div class="page-body">
                <div class="edit-user-area mt-10">
                  <form method="POST" action="{{ route('user.single.edit', $user->uid) }}" enctype="multipart/form-data" name="EditUserForm" id="EditUserForm" class="user-form edit row mx-0">
                    @csrf

                    {{--Name--}}
                    <div class="col-lg-6 mb-20 name">
                      <div class="row">
                        <label for="name" class="col-4"><span>Name</span></label>

                        <div class="col-7">
                          <input type="text" disabled name="name" id="name" class="form-control border-secondary brd-3 cur-not-allowed @error('name') is-invalid @enderror" placeholder="User full name" value="{{ $user->name }}" />
      
                          @if ( $errors->has('name') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('name') }}
                            </div>
                          @endif

                          <div class="text-primary fz-12 fw-500 info">
                            Change in employee portal.
                          </div>
                        </div>
                      </div>
                    </div>

                    {{--Status--}}
                    <div class="col-lg-6 mb-20 user-status">
                      <div class="row justify-content-end">
                        <label for="" class="col-4 fw-bold"><span>Status</span></label>

                        <div class="col-7">
                          <div class="d-flex">
                            <span class="form-check w-50">
                              <input type="radio" name="active" id="active" class="status form-check-input cur-pointer @error('active') is-invalid @enderror" value="{{ 'active' }}" {{ $user->active ? 'checked' : '' }} />

                              <label for="active" class="form-check-label {{ $user->active ? 'bg-success text-white fw-bold py-1 px-10' : '' }} brd-3 cur-pointer">Active</label>
                            </span>

                            <span class="form-check w-50">
                              <input type="radio" name="active" id="not-active" class="status form-check-input cur-pointer @error('active') is-invalid @enderror" value="{{ 'not-active' }}" {{ $user->active ? '' : 'checked' }} />
                              
                              <label for="not-active" class="form-check-label {{ $user->active ? '' : 'bg-danger text-white fw-bold py-1 px-10' }} brd-3 cur-pointer">Not-Active</label>
                            </span>
                          </div>

                          @if ( $errors->has('active') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('active') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{--Username--}}
                    <div class="col-lg-6 mb-20 username">
                      <div class="row">
                        <label for="username" class="col-4">
                          <span>Username</span>
                        </label>

                        <div class="col-7">
                          <input disabled type="text" name="username" id="username" class="form-control border-secondary brd-3 cur-not-allowed @error('username') is-invalid @enderror" placeholder="User unique username" value="{{ $user->username }}" />

                          @if ( $errors->has('username') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('username') }}
                            </div>
                          @endif

                          <div class="text-danger fz-12 fw-bold info">Username not-changeable</div>
                        </div>
                      </div>
                    </div>

                    {{--Email--}}
                    <div class="col-lg-6 mb-20 email">
                      <div class="row justify-content-end">
                        <label for="" class="col-4"><span>Email</span></label>

                        <div class="col-7">
                          <input disabled type="email" name="email" id="email" class="form-control border-secondary brd-3 cur-not-allowed @error('email') is-invalid @enderror" placeholder="email@domain.com" value="{{ $user->email }}" />

                          @if ( $errors->has('email') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('email') }}
                            </div>
                          @endif

                          <div class="text-danger fz-12 fw-bold info">Email address not-changeable</div>
                        </div>
                      </div>
                    </div>

                    {{--Password--}}
                    <div class="col-lg-6 mb-20 password">
                      <div class="row">
                        <label for="" class="col-4"><span>Password</span></label>

                        <div class="col-7">
                          <div class="p-relative">
                            <input type="password" name="password" id="password" class="form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="Password" />

                            <label for="" class="show-password text-secondary p-absolute w-30px h-100 text-center fz-20 lh-1-3 pos-top-right mt-2 mr-2 cur-pointer z-index-11">
                              <i class="fa fa-eye-slash"></i>
                              {{--<i class="fa fa-eye"></i>--}}
                            </label>
                          </div>

                          <div class="text-secondary fz-14 lh-1 pt-5 info">Min 8 character</div>
      
                          @if ( $errors->has('password') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('password') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{--Confirm-Password--}}
                    <div class="col-lg-6 mb-20 password-confirmation">
                      <div class="row justify-content-end">
                        <label for="" class="col-4"><span>Confirm Password</span></label>

                        <div class="col-7">
                          <div class="p-relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-secondary brd-3" placeholder="Retype password" />

                            <label for="" class="show-password text-secondary p-absolute w-30px h-100 text-center fz-20 lh-1-3 pos-top-right mt-2 mr-2 cur-pointer z-index-11">
                              <i class="fa fa-eye-slash"></i>
                              {{--<i class="fa fa-eye"></i>--}}
                            </label>
                          </div>
      
                          @if ( $errors->has('password') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('password') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
  
                    {{-- Mobile-Number-Personal --}}
                    {{-- <div class="col-lg-6 mb-20 mobile-number-personal">
                      <div class="row">
                        <label for="" class="col-4">
                          <span>Mobile Personal</span>
                        </label>
                        
                        <div class="col-7">
                          <input type="text" name="phone_personal" id="phone_personal" class="form-control border-secondary brd-3 @error('phone_personal') is-invalid @enderror" placeholder="01799885522" value="{{ $user->phone_personal ?? '' }}" />

                          <div class="text-secondary fz-14 lh-1 mt-5 info">No spaces please</div>
      
                          @if ( $errors->has('phone_personal') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('phone_personal') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div> --}}

                    {{-- Mobile-Number-Official --}}
                    {{-- <div class="col-lg-6 mb-20 mobile-number-official">
                      <div class="row justify-content-end">
                        <label for="phone_official" class="col-4">
                          <span>Mobile Official</span>
                        </label>

                        <div class="col-7">
                          <input type="text" name="phone_official" id="phone_official" class="form-control border-secondary brd-3 @error('phone_official') is-invalid @enderror" placeholder="01844995577" value="{{ $user->phone_official ?? '' }}" />

                          <div class="text-secondary fz-14 lh-1 mt-5 info">No spaces please</div>
      
                          @if ( $errors->has('phone_official') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('phone_official') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div> --}}
  
                    <div class="col-12 mb-20 bb-1 border-secondary-3 section-divider"></div>

                    {{-- Role --}}
                    <div class="col-lg-6 mb-30 user-role">
                      <div class="row">
                        <label for="user_role" class="col-4 required">
                          <span>Role</span>
                        </label>

                        <div class="col-7">
                          <select name="user_role" id="user_role" class="required form-select border-secondary brd-3 @error('user_role') is-invalid @enderror">
                            <option value="">Select User Role</option>
                            @if ( $roles && count($roles) > 0 )
                              @foreach ( $roles as $role )
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                              @endforeach
                            @endif
                          </select>
                          
                          @if ( $errors->has('user_role') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('user_role') }}
                            </div>
                          @endif
                        </div>
                      </div>

                      
                    </div>

                    {{-- Permissions --}}
                    <div class="col-lg-12 mb-30 permissions">
                      <div class="row">
                        <label for="" class="col-2 required">
                          <span>Permissions</span>
                        </label>

                        <div class="col-10">
                          @if ( $permissions && count($permissions) > 0 )
                            <div class="form-check settings-input mb-10">
                              <span class="mr-10">
                                <input name="" type="checkbox" id="selectAll-permission" class="form-check-input permission select-all cur-pointer" />

                                <label for="selectAll-permission" class="form-check-label cur-pointer">Select All</label>
                              </span>

                              @if ( $errors->has('routes') )
                                <span class="text-danger fw-bold ml-50" role="alert">
                                  {{ $errors->first('routes') }}
                                </span>
                              @endif
                            </div>

                            <div class="row" id="permissions">
                              @foreach ( $permissions as $permission )
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 form-check settings-input pl-35 pr-20 mb-10">
                                  <input name="permissions[]" type="checkbox"
                                          id="permission-{{ $permission->slug }}" class="form-check-input permission cur-pointer"
                                          value="{{ $permission->slug }}" {{ is_array($user->permissions) && in_array($permission->slug, $user->permissions) ? 'checked' : '' }} />
                                          
                                  <label for="permission-{{ $permission->slug }}" class="form-check-label cur-pointer">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          @endif

                          @if ( $errors->has('permissions') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('permissions') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{-- Routes --}}
                    <div class="col-lg-12 mb-20 routes">
                      <div class="row">
                        <label for="" class="col-2 required"><span>Route Access</span></label>

                        <div class="col-10">
                          @if ( $routes )
                            <div class="form-check settings-input mb-10">
                              <span class="mr-10">
                                <input name="" type="checkbox" id="selectAll-route" class="form-check-input route select-all cur-pointer" />

                                <label for="selectAll-route" class="form-check-label cur-pointer">Select All</label>
                              </span>

                              @if ( $errors->has('routes') )
                                <span class="text-danger fw-bold ml-50" role="alert">
                                  {{ $errors->first('routes') }}
                                </span>
                              @endif
                            </div>

                            <div class="row" id="routes">
                              @foreach ( $routes as $route )
                                <div class="col-3 form-check settings-input pl-35 pr-20 mb-10">
                                  <input name="routes[]" type="checkbox" id="route-{{ $route }}"
                                    class="form-check-input route cur-pointer" value="{{ $route }}"
                                    {{ is_array($user->routes) && in_array($route, $user->routes) ? 'checked' : '' }} />

                                  <label for="route-{{ $route }}" class="form-check-label cur-pointer">{{ ucwords(str_replace(".", " ", $route)) }}</label>
                                </div>
                              @endforeach
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{--Submit--}}
                    @if ( Auth::user()->can('isSuperAdmin') && Auth::user()->can('entryEdit') )
                      <div class="col-12 mt-50 mb-100 text-center">
                        <button type="submit" class="btn btn-success px-20">Update User</button>
                      </div>
                    @endif
                    
                  </form>
                </div> {{-- ./page-area --}}
              </div> {{-- ./page-body --}}
            </div> {{-- ./card-body --}}
          </div> {{-- ./card --}}
        </div> {{-- ./page-content --}}
      </div> {{-- ./page-name --}}
    </div> {{-- ./page-wrapper --}}
  </div> {{-- ./Page View-Name --}}
@endsection


@section( 'custom-script' )
<script>

	// Showing Session Error or Success Message
	let sessionError = null, sessionSuccess = null;

  @if ( session('error') ) sessionError = @json( session('error') );
  @elseif ( session('success') ) sessionSuccess = @json( session('success') );
  @endif

	if( sessionError ){
		Swal.fire({
			icon: 'error',
			title: 'Oops! Sorry.',
			text: sessionError,
		});
	} else if( sessionSuccess ){
		Swal.fire({
			icon: 'success',
			title: 'Thank You!',
			text: sessionSuccess,
		});
	}


	$(document).ready(function(){
		$("input[type=radio].status").on("click", function(){
			if( this.id === 'active' ){
				if( ! $(this).next().hasClass('bg-success text-white fw-bold px-2') ){
					$(this).next().addClass('bg-success text-white fw-bold px-2');
				}
				if( $("input[type=radio]#inactive").next().hasClass('bg-danger text-white fw-bold px-2') ){
					$("input[type=radio]#inactive").next().removeClass('bg-danger text-white fw-bold px-2');
				}
			}
			else if( this.id === 'inactive' ){
				if( ! $(this).next().hasClass('bg-danger text-white fw-bold px-2') ){
					$(this).next().addClass('bg-danger text-white fw-bold px-2');
				}
				if( $("input[type=radio]#active").next().hasClass('bg-success text-white fw-bold px-2') ){
					$("input[type=radio]#active").next().removeClass('bg-success text-white fw-bold px-2');
				}
			}
		});
	});

</script>
@endsection
