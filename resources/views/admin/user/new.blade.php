@extends( 'layouts.admin' )

@section( 'title', 'Create New User' )

@section( 'admin-content' )
<div class="Page User New">
  <div class="page-wrapper py-15">
    <div class="new-user-page">
      <div class="page-content">
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

          <div class="card-body">
            <div class="page-body">
              <div class="new-user-area mt-20">
                <form method="POST" action="{{ route('user.add.new') }}" enctype="multipart/form-data" name="NewUserForm" id="NewUserForm" class="user-form new row mx-0">
                  @csrf

                  {{--First-Name--}}
                  <div class="col-lg-6 mb-20 first-name">
                    <div class="row">
                      <label for="" class="required col-4"><span>First Name</span></label>
                      <div class="col-7">
                        <input type="text" name="first_name" id="first_name" class="required form-control border-secondary brd-3 @error('first_name') is-invalid @enderror" placeholder="First name" value="{{ old('first_name') }}" />

                        @if ( $errors->has('first_name') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('first_name') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Last-Name--}}
                  <div class="col-lg-6 mb-20 last-name">
                    <div class="row justify-content-end">
                      <label for="" class="required col-4"><span>Last Name</span></label>
                      <div class="col-7">
                        <input type="text" name="last_name" id="last_name" class="required form-control border-secondary brd-3 @error('last_name') is-invalid @enderror" placeholder="Last name" value="{{ old('last_name') }}" />

                        @if ( $errors->has('last_name') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('last_name') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Email--}}
                  <div class="col-lg-6 mb-20 email">
                    <div class="row">
                      <label for="" class="required col-4"><span>E-mail</span></label>
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

                  {{--Status--}}
                  {{--<div class="col-lg-6 mb-20 status">
                    <div class="row justify-content-end">
                      <label for="" class="required col-4"><span>Status</span></label>
                      <div class="col-7">
                        <div class="d-flex">
                          <span class="form-check w-50">
                            <input type="radio" name="active" id="active" class="form-check-input @error('active') is-invalid @enderror" value="{{ 'yes' }}" />
                            <label for="active" class="form-check-label fw-bold">Active</label>
                          </span>
                          <span class="form-check w-50">
                            <input type="radio" name="active" id="inactive" class="form-check-input @error('active') is-invalid @enderror" value="{{ 'no' }}" />
                            <label for="inactive" class="form-check-label fw-bold">In-Active</label>
                          </span>
                        </div>

                        @if ( $errors->has('active') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('active') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>--}}

                  <div class="col-lg-6 mb-20 blank-space"></div>

                  {{--Password--}}
                  <div class="col-lg-6 mb-20 password">
                    <div class="row">
                      <label for="" class="required col-4"><span>Password</span></label>
                      <div class="col-7">
                        <div class="input-group p-relative">
                          <input type="password" name="password" id="password" class="required form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="Password" />

                          <label for="" id="showPassword" onclick="ShowPassword(this);" class="show-password text-secondary">
                            <i class="fa fa-eye"></i>
                            {{--<i class="fa fa-eye-slash"></i>--}}
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
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-secondary brd-3" placeholder="Retype password" />

                        @if ( $errors->has('password') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('password') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-12 mb-30 bb-1 border-secondary-3 section-divider"></div>

                  {{--Date of Birth--}}
                  <div class="col-lg-6 mb-20 birth-date">
                    <div class="row">
                      <label for="" class="col-4"><span>Date of Birth</span></label>
                      <div class="col-7">
                        <div class="input-group p-relative input-daterange" id="datepicker" data-provide="datepicker">
                          <input type="text" name="birth_date" id="birth_date" class="input-date form-control text-start border-secondary brd-3 z-index-9 @error('birth_date') is-invalid @enderror" placeholder="dd-mm-yyyy" value="{{ old('birth_date') }}" />
                          <label for="birth_date" class="input-label-icon p-absolute pos-top-right color-base-1 fz-19 lh-1-2 cur-pointer z-index-11"><i class="far fa-calendar-alt"></i></label>
                        </div>

                        @if ( $errors->has('birth_date') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('birth_date') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Postcode--}}
                  <div class="col-lg-6 mb-20 postcode">
                    <div class="row justify-content-end">
                      <label for="" class="col-4"><span>Postcode</span></label>
                      <div class="col-7">
                        <input type="text" name="postcode" id="postcode" class="form-control border-secondary brd-3 @error('postcode') is-invalid @enderror" placeholder="ZIPCODE" value="{{ old('postcode') }}" />

                        {{--<button id="addressAutofill" class="btn btn-primary btn-sm text-capitalize ms-1 brd-0">Autofill Address</button>--}}

                        {{-- <a href="#" id="addressAutofill" class="btn btn-primary btn-sm text-capitalize ms-1 brd-3">Autofill Address</a> --}}

                        @if ( $errors->has('postcode') )
                          <div class="float-start w-100 text-danger fw-bold" role="alert">
                            {{ $errors->first('postcode') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Mobile-Number--}}
                  <div class="col-lg-6 mb-20 mobile-number">
                    <div class="row">
                      <label for="" class="col-4"><span>Mobile Number</span></label>
                      <div class="col-7">
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control border-secondary brd-3 @error('mobile_number') is-invalid @enderror" placeholder="212-625-78999" value="{{ old('mobile_number') }}" />
                        <div class="text-secondary fz-14 lh-1 mt-5 info">No spaces please</div>

                        @if ( $errors->has('mobile_number') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('mobile_number') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Landline-Number--}}
                  <div class="col-lg-6 mb-20 landline-number">
                    <div class="row justify-content-end">
                      <label for="" class="col-4"><span>Landline Number</span></label>
                      <div class="col-7">
                        <input type="text" name="landline_number" id="landline_number" class="form-control border-secondary brd-3 @error('landline_number') is-invalid @enderror" placeholder="512-625-7899" value="{{ old('landline_number') }}" />
                        <div class="text-secondary fz-14 lh-1 mt-5 info">No spaces please</div>

                        @if ( $errors->has('landline_number') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('landline_number') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Address-Line-1--}}
                  <div class="col-lg-6 mb-20 address-1">
                    <div class="row">
                      <label for="" class="col-4"><span>Address</span></label>
                      <div class="col-7">
                        <input type="text" name="address_1" id="address_1" class="form-control border-secondary brd-3 @error('address_1') is-invalid @enderror" value="{{ old('address_1') }}" />

                        @if ( $errors->has('address_1') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('address_1') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Address-Line-2--}}
                  <div class="col-lg-6 mb-20 address-2">
                    <div class="row justify-content-end">
                      <label for="" class="col-4"><span>Address Line 2</span></label>
                      <div class="col-7">
                        <input type="text" name="address_2" id="address_2" class="form-control border-secondary brd-3 @error('address_2') is-invalid @enderror" value="{{ old('address_2') }}" />

                        @if ( $errors->has('address_2') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('address_2') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--City-Town--}}
                  <div class="col-lg-6 mb-20 city">
                    <div class="row">
                      <label for="" class="col-4"><span>City/Town</span></label>
                      <div class="col-7">
                        <input type="text" name="city" id="city" class="form-control border-secondary brd-3 @error('city') is-invalid @enderror" placeholder="City/Town" value="{{ old('city') }}" />

                        @if ( $errors->has('city') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('city') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--State/County--}}
                  <div class="col-lg-6 mb-20 state-county">
                    <div class="row justify-content-end">
                      <label for="state" class="col-4"><span>State/County</span></label>
                      <div class="col-7">
                        <input type="text" name="state" id="state" class="form-control border-secondary brd-3 @error('state') is-invalid @enderror" placeholder="London" value="{{ old('state') }}" />

                        @if ( $errors->has('state') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('state') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Country--}}
                  <div class="col-lg-6 mb-20 country-name">
                    <div class="row">
                      <label for="" class="col-4"><span>Country Name</span></label>
                      <div class="col-7">
                        <input type="text" name="country" id="country" class="form-control border-secondary brd-3 @error('country') is-invalid @enderror" placeholder="Country" />
    
                        @if ( $errors->has('country') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('country') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 mb-20 blank-space"></div>

                  <div class="section-divider my-30 bb-1 border-secondary-3"></div>
                  
                  {{--Role-Permissions--}}
                  <div class="col-lg-6 mb-20">
                    {{--Role--}}
                    <div class="row mb-30 user-role">
                      <label for="" class="col-4 required"><span>Role</span></label>
                      <div class="col-7">
                        <select name="user_role" id="user_role" class="required form-select border-secondary brd-3 @error('city') is-invalid @enderror">
                          <option value="">Select User Role</option>
                          @if ( $roles )
                            @foreach ( $roles as $role )
                              <option value="{{ $role->id }}" {{ old('user_role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
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

                    {{--Permissions--}}
                    <div class="row permissions">
                      <label for="" class="col-4 required"><span>Permissions</span></label>
                      <div class="col-7">
                        @if ( $permissions )
                          <div class="" id="permissions">
                          <span class="form-check d-inline-block settings-input mr-20 mb-5">
                            <input name="" type="checkbox" id="selectAll-permission" class="form-check-input permission select-all cur-pointer" />
                            <label for="selectAll-permission" class="form-check-label cur-pointer">Select All</label>
                          </span>

                            @foreach ( $permissions as $permission )
                              <span class="form-check d-inline-block settings-input mr-20 mb-5">
                            <input name="permissions[]" type="checkbox" id="permission-{{ $permission->slug }}" class="form-check-input permission cur-pointer" value="{{ $permission->slug }}" {{ old('permissions.*') == $permission->slug ? 'checked' : '' }} />
                            <label for="permission-{{ $permission->slug }}" class="form-check-label cur-pointer">{{ $permission->name }}</label>
                          </span>
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

                  {{--Image--}}
                  <div class="col-lg-6 mb-20">
                    <div class="row justify-content-end h-100 user-image">
                      <div class="col-4">
                        <label for="" class="w-100 mb-5"><span>Image</span></label>
                        <div class="image-rules fz-14 ml-10">
                          <label class="me-1">Rules:</label>
                          <ul class="text-secondary list-style-disc">
                            <li class="mb-5">Format allowed: jpg, jpeg, png or bmp.</li>
                            <li class="mb-5">Max file size 1 MB.</li>
                            <li class="mb-5">Dimensions allowed upto 1200 X 1200 pixel.</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-7">
                        <input type="file" name="image" id="image" onchange="PreviewUploadedImage(this, 'previewImage');" class="form-control border-secondary brd-3 @error('image') is-invalid @enderror" />

                        @if ( $errors->has('image') )
                          <div class="text-danger fw-bold" role="alert">
                            {{ $errors->first('image') }}
                          </div>
                        @endif

                        <div class="user-image-block mt-10">
                          <div class="image-box">
                            <a id="previewImage-lightbox" class="image-on-lightbox d-none cur-zoomIn" href="#">
                              <img id="previewImage" src="" alt="Uploaded image" class="user-img h-120px" />
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{--Routes--}}
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
                                  {{ $route == 'login' || $route == 'logout' || $route == 'register' || $route == 'password.change' || $route == 'my.profile.admin' || $route == 'admin.dashboard' ? 'checked' : '' }} />
                                <label for="route-{{ $route }}" class="form-check-label cur-pointer">{{ ucwords(str_replace(".", " ", $route)) }}</label>
                              </div>
                            @endforeach
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Submit--}}
                  <div class="col-12 mt-50 mb-100 text-center">
                    <button type="submit" class="btn btn-primary px-20">Save User</button>
                  </div>

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

</script>
@endsection
