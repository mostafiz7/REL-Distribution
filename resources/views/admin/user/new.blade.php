@extends( 'layouts.app' )

@section( 'title', 'Create New User' )

@section( 'site-content' )
<div class="Page User New">
  <div class="">
    <div class="page-content p-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="card-title title lh-1-5 my-0">Add New User</h5>

          <div class="">
            <a href="{{ route('user.all.index') }}" class="btn btn-light btn-sm fw-bold">
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

        <div class="card-body full-height-prev-auto">
          <div class="page-body">
            <div class="new-user-area overlay-scrollbar pt-20">
              <form method="POST" action="{{ route('user.new.store') }}" enctype="multipart/form-data" name="NewUserForm" id="NewUserForm" class="user-form new row mx-0">
                @csrf

                {{-- Employee-Name --}}
                <div class="col-lg-6 mb-30 employee-name">
                  <div class="row">
                    <label for="employee-name" class="required col-4">
                      <span>Employee Name</span>
                    </label>

                    <div class="col-7">
                      <select name="employee_id" id="employee-name" class="required form-select border-secondary brd-3 @error('employee_id') is-invalid @enderror">
                        <option value="">Select Employee Name</option>

                        @if ( $employee_all && count($employee_all) > 0 )
                          @foreach ( $employee_all as $employee )
                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('employee_id') )
                        <div class="text-danger fw-bold" role="alert">
                          {{ $errors->first('employee_id') }}
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                {{--Password--}}
                <div class="col-lg-6 mb-30 password">
                  <div class="row">
                    <label for="" class="required col-4">
                      <span>Password</span>
                    </label>

                    <div class="col-7">
                      <div class="p-relative">
                        <input type="password" name="password" id="password" class="required form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="Password" />

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

                {{-- <div class="col-lg-6 mb-30 blank-space"></div> --}}

                {{-- Username --}}
                <div class="col-lg-6 mb-30 username">
                  <div class="row">
                    <label for="username" class="required col-4">
                      <span>Username</span>
                    </label>

                    <div class="col-7">
                      <input type="text" name="username" id="username" class="required form-control border-secondary brd-3 @error('username') is-invalid @enderror" placeholder="username" value="{{ old('username') }}" />

                      @if ( $errors->has('username') )
                        <div class="text-danger fw-bold" role="alert">
                          {{ $errors->first('username') }}
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                {{--Confirm-Password--}}
                <div class="col-lg-6 mb-30 password-confirmation">
                  <div class="row">
                    <label for="password_confirmation" class="required col-4">
                      <span>Confirm Password</span>
                    </label>

                    <div class="col-7">
                      <div class="p-relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="required form-control border-secondary brd-3 @error('password') is-invalid @enderror" placeholder="Retype password" />

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

                {{--Email--}}
                <div class="col-lg-6 mb-30 email">
                  <div class="row">
                    <label for="" class="required col-4">
                      <span>E-mail</span>
                    </label>

                    <div class="col-7">
                      <input type="email" name="email" id="email" class="required form-control border-secondary brd-3 @error('email') is-invalid @enderror" placeholder="email@domain.com" value="{{ old('email') }}" />

                      @if ( $errors->has('email') )
                        <div class="text-danger fw-bold" role="alert">
                          {{ $errors->first('email') }}
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                {{-- Mobile-Personal --}}
                {{-- <div class="col-lg-6 mb-30 mobile-personal">
                  <div class="row">
                    <label for="" class="col-4">
                      <span>Mobile Personal</span>
                    </label>
                    
                    <div class="col-7">
                      <input type="text" name="phone_personal" id="phone_personal" class="form-control border-secondary brd-3 @error('phone_personal') is-invalid @enderror" placeholder="01799885522" value="{{ old('phone_personal') }}" />

                      <div class="text-secondary fz-14 lh-1 mt-5 info">No spaces please</div>
  
                      @if ( $errors->has('phone_personal') )
                        <div class="text-danger fw-bold" role="alert">
                          {{ $errors->first('phone_personal') }}
                        </div>
                      @endif
                    </div>
                  </div>
                </div> --}}

                {{-- Mobile-Official --}}
                {{-- <div class="col-lg-6 mb-30 mobile-official">
                  <div class="row justify-content-end">
                    <label for="phone_official" class="col-4">
                      <span>Mobile Official</span>
                    </label>

                    <div class="col-7">
                      <input type="text" name="phone_official" id="phone_official" class="form-control border-secondary brd-3 @error('phone_official') is-invalid @enderror" placeholder="01844995577" value="{{ old('phone_official') }}" />

                      <div class="text-secondary fz-14 lh-1 mt-5 info">No spaces please</div>
  
                      @if ( $errors->has('phone_official') )
                        <div class="text-danger fw-bold" role="alert">
                          {{ $errors->first('phone_official') }}
                        </div>
                      @endif
                    </div>
                  </div>
                </div> --}}
                

                {{-- <div class="section-divider mb-30 bb-1 border-secondary-3"></div> --}}
                
                {{-- User-Role --}}
                <div class="col-lg-6 mb-30 user-role">
                  <div class="row">
                    <label for="role_id" class="col-4 required">
                      <span>Application Role</span>
                    </label>

                    <div class="col-7">
                      <select name="role_id" id="role_id" class="required form-select border-secondary brd-3 @error('role_id') is-invalid @enderror">
                        <option value="">Select User Role</option>
                        @if ( $roles )
                          @foreach ( $roles as $role )
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('role_id') )
                        <div class="text-danger fw-bold" role="alert">
                          {{ $errors->first('role_id') }}
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="section-divider mb-30 bb-1 border-secondary-3"></div>

                {{--Permissions--}}                  
                <div class="col-12 mb-30 permissions">
                  <div class="row">
                    <label for="" class="col-2 required">
                      <span>Permissions</span>
                    </label>

                    <div class="col-10">
                      @if ( $permissions && count($permissions) > 0 )
                        @if ( $errors->has('permissions') )
                          <div class="text-danger fw-bold mb-5" role="alert">
                            {{ $errors->first('permissions') }}
                          </div>
                        @endif

                        <div class="row" id="permissions">
                          <div class="col-lg-2 col-md-3 col-sm-4 col-6 form-check settings-input pl-35 pr-20 mb-10">
                            <input name="" type="checkbox" id="selectAll-permission" class="form-check-input permission select-all cur-pointer" />

                            <label for="selectAll-permission" class="form-check-label cur-pointer fw-bold ">Select All</label>
                          </div>

                          @foreach ( $permissions as $permission )
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 form-check settings-input pl-35 pr-20 mb-10">
                              <input name="permissions[]" type="checkbox"
                                      id="permission-{{ $permission->slug }}" class="form-check-input permission cur-pointer"
                                      value="{{ $permission->slug }}" {{ old('permissions.*') == $permission->slug ? 'checked' : '' }} />
                                      
                              <label for="permission-{{ $permission->slug }}" class="form-check-label cur-pointer">{{ $permission->name }}</label>
                            </div>
                          @endforeach
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="section-divider mb-30 bb-1 border-secondary-3"></div>

                {{--Routes--}}
                <div class="col-lg-12 mb-30 routes">
                  <div class="row">
                    <label for="" class="col-2 required">
                      <span>Route Access</span>
                    </label>

                    <div class="col-10">
                      @if ( $routes && count($routes) > 0 )
                        <div class="form-check settings-input mb-20">
                          <span class="mr-10">
                            <label for="selectAll-route" class="form-check-label fw-bold cur-pointer">
                              Select All
                            </label>
                            
                            <input name="" type="checkbox" id="selectAll-route" class="form-check-input route select-all cur-pointer" />
                          </span>

                          @if ( $errors->has('routes') )
                            <span class="text-danger fw-bold ml-50" role="alert">
                              {{ $errors->first('routes') }}
                            </span>
                          @endif
                        </div>

                        <div class="row" id="routes">
                          @foreach ( $routes as $key => $route_group )
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-check settings-input pl-35 pr-20 mb-20">
                              <div class="fw-bold mb-5 ml--25">
                                {{ ucwords( $key ) . ' - Routes' }}
                              </div>

                              @foreach ( $route_group as $route )
                                <div class="single-route mb-5">
                                  <input name="routes[]" type="checkbox" id="route-{{ $route }}" class="form-check-input route cur-pointer" value="{{ $route }}" {{ $route == 'login' || $route == 'logout' || $route == 'register' || $route == 'password.change' || $route == 'my-profile.edit' || $route == 'my-profile.update' || $route == 'admin.dashboard' ? 'checked' : '' }} />

                                  <label for="route-{{ $route }}" class="form-check-label cur-pointer">{{ ucwords(str_replace(".", " ", $route)) }}</label>
                                </div>
                              @endforeach
                            </div>
                          @endforeach
                        </div>
                      @endif
                    </div>
                  </div>
                </div>


                {{--Submit--}}
                <div class="col-12 my-50 text-center">
                  <button type="submit" class="btn btn-primary px-20">
                    Save User
                  </button>
                </div>

              </form>
            </div> {{-- ./page-area --}}
          </div> {{-- ./page-body --}}
        </div> {{-- ./card-body --}}
      </div> {{-- ./card --}}
    </div> {{-- ./page-content --}}
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

</script>
@endsection
