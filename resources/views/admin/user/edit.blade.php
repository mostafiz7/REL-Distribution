@extends( 'layouts.admin' )

@section( 'title', 'Edit User' )

@section( 'admin-content' )
  <div class="Page User Edit">
    <div class="page-wrapper py-15">
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

            <div class="card-body">
              <div class="page-body">
                <div class="edit-user-area mt-20">
                  <form method="POST" action="{{ route('user.single.edit', $user->id) }}" enctype="multipart/form-data" name="EditUserForm" id="EditUserForm" class="user-form edit row mx-0">
                    @csrf
  
                    {{--Title--}}
                    {{-- <div class="row mb-20 mx-30">
                      <div class="col-lg-6 title">
                        <div class="row">
                          <label for="" class="col-4">Title</label>
                          <div class="col-7">
                            <select name="title" id="title" class="form-select border-secondary brd-3">
                              <option value="mr." {{ $user->title == 'mr.' ? 'selected' : '' }}>Mr</option>
                              <option value="mrs." {{ $user->title == 'mrs.' ? 'selected' : '' }}>Mrs</option>
                              <option value="miss." {{ $user->title == 'miss.' ? 'selected' : '' }}>Miss</option>
                              <option value="ms." {{ $user->title == 'ms.' ? 'selected' : '' }}>Ms</option>
                              <option value="dr." {{ $user->title == 'dr.' ? 'selected' : '' }}>Dr</option>
                              <option value="fr." {{ $user->title == 'fr.' ? 'selected' : '' }}>Fr</option>
                            </select>
        
                            @if ( $errors->has('title') )
                              <div class="text-danger fw-bold" role="alert">
                                {{ $errors->first('title') }}
                              </div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div> --}}

                    {{--First-Name--}}
                    <div class="col-lg-6 mb-20 first-name">
                      <div class="row">
                        <label for="" class="col-4"><span>First Name</span></label>
                        <div class="col-7">
                          <input type="text" name="first_name" id="first_name" class="form-control border-secondary brd-3 @error('first_name') is-invalid @enderror" placeholder="First name" value="{{ $user->first_name }}" />
      
                          @if ( $errors->has('first_name') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('first_name') }}
                            </div>
                          @endif
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

                              <label for="active" class="form-check-label {{ $user->active ? 'bg-success text-white fw-bold px-2' : '' }} brd-3 cur-pointer">Active</label>
                            </span>

                            <span class="form-check w-50">
                              <input type="radio" name="active" id="inactive" class="status form-check-input cur-pointer @error('active') is-invalid @enderror" value="{{ 'inactive' }}" {{ $user->active ? '' : 'checked' }} />
                              
                              <label for="inactive" class="form-check-label {{ $user->active ? '' : 'bg-danger text-white fw-bold px-2' }} brd-3 cur-pointer">In-Active</label>
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

                    {{--Last-Name--}}
                    <div class="col-lg-6 mb-20 last-name">
                      <div class="row">
                        <label for="" class="col-4"><span>Last Name</span></label>
                        <div class="col-7">
                          <input type="text" name="last_name" id="last_name" class="form-control border-secondary brd-3 @error('last_name') is-invalid @enderror" placeholder="Last name" value="{{ $user->last_name }}" />

                          @if ( $errors->has('last_name') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('last_name') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{--Password--}}
                    <div class="col-lg-6 mb-20 password">
                      <div class="row justify-content-end">
                        <label for="" class="col-4"><span>Password</span></label>
                        <div class="col-7">
                          <div class="input-group p-relative">
                            <input type="password" name="password" id="password" class="form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="Password" />

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

                    {{--Email--}}
                    <div class="col-lg-6 mb-20 email">
                      <div class="row">
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

                    {{-- <div class="col-lg-6 blank-space"></div> --}}
    
                    <div class="col-12 mb-20 bb-1 border-secondary-3 section-divider"></div>
  
                    {{--Date of Birth--}}
                    <div class="col-lg-6 mb-20 birth-date">
                      <div class="row">
                        <label for="" class="col-4"><span>Date of Birth</span></label>
                        <div class="col-7">
                          <div class="input-group p-relative input-daterange" id="datepicker" data-provide="datepicker">
                            <input type="text" name="birth_date" id="birth_date" class="input-date form-control text-start border-secondary brd-3 z-index-9 @error('birth_date') is-invalid @enderror" placeholder="dd-mm-yyyy" value="{{ $user->birth_date ? date('d-m-Y', strtotime($user->birth_date)) : '' }}" />
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

                    <?php
                    /* @var $user */
                      $addresses = $user->addresses && count($user->addresses) > 0 ? $user->addresses : null;
                      $address = null;
                      if($addresses){ foreach($addresses as $addr){ if($addr['isDefault']){ $address = $addr; } } }
                    ?>

                    {{--Postcode--}}
                    <div class="col-lg-6 mb-20 postcode">
                      <div class="row justify-content-end">
                        <label for="" class="col-4"><span>Postcode</span></label>
                        <div class="col-7">
                          <input type="text" name="postcode" id="postcode" class="form-control border-secondary brd-3 @error('postcode') is-invalid @enderror" placeholder="ZIPCODE" value="{{ $address ? $address['postcode'] : '' }}" />

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
                          <input type="text" name="mobile_number" id="mobile_number" class="form-control border-secondary brd-3 @error('mobile_number') is-invalid @enderror" placeholder="212-625-78999" value="{{ $user->mobile_number ?? '' }}" />
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
                          <input type="text" name="landline_number" id="landline_number" class="form-control border-secondary brd-3 @error('landline_number') is-invalid @enderror" placeholder="512-625-7899" value="{{ $user->landline_number ?? '' }}" />
                          <div class="text-secondary fz-14 lh-1 mt-5 info">No spaces please</div>
      
                          @if ( $errors->has('landline_number') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('landline_number') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
  
                    {{-- Address-Line-1 --}}
                    <div class="col-lg-6 mb-20 address-1">
                      <div class="row">
                        <label for="" class="col-4"><span>Address</span></label>
                        <div class="col-7">
                          <input type="text" name="address_1" id="address_1" class="form-control border-secondary brd-3 @error('address_1') is-invalid @enderror" value="{{ $address ? $address['address_1'] : '' }}" />
      
                          @if ( $errors->has('address_1') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('address_1') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{-- Address-Line-2 --}}
                    <div class="col-lg-6 mb-20 address-2">
                      <div class="row justify-content-end">
                        <label for="" class="col-4"><span>Address Line 2</span></label>
                        <div class="col-7">
                          <input type="text" name="address_2" id="address_2" class="form-control border-secondary brd-3 @error('address_2') is-invalid @enderror" value="{{ $address ? $address['address_2'] : '' }}" />
      
                          @if ( $errors->has('address_2') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('address_2') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
  
                    {{-- City-Town --}}
                    <div class="col-lg-6 mb-20 city">
                      <div class="row">
                        <label for="" class="col-4"><span>City/Town</span></label>
                        <div class="col-7">
                          <input type="text" name="city" id="city" class="form-control border-secondary brd-3 @error('city') is-invalid @enderror" placeholder="Hornchurch" value="{{ $address ? $address['city'] : '' }}" />
      
                          @if ( $errors->has('city') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('city') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{-- State-County --}}
                    <div class="col-lg-6 mb-20 state-county">
                      <div class="row justify-content-end">
                        <label for="state" class="col-4"><span>State/County</span></label>
                        <div class="col-7">
                          <input type="text" name="state" id="state" class="form-control border-secondary brd-3 @error('state') is-invalid @enderror" placeholder="London" value="{{ $address ? $address['state'] : '' }}" />
      
                          @if ( $errors->has('state') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('state') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                    
                    {{-- Country-Name --}}
                    <div class="col-lg-6 mb-20 country-name">
                      <div class="row">
                        <label for="" class="col-4"><span>Country Name</span></label>
                        <div class="col-7">
                          <input type="text" name="country" id="country" class="form-control border-secondary brd-3 @error('country') is-invalid @enderror" placeholder="United Kingdom" value="{{ $address ? $address['country'] : '' }}" />
      
                          @if ( $errors->has('country') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('country') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 blank-space"></div>
  
                    <div class="col-12 mb-20 bb-1 border-secondary-3 section-divider"></div>

                    {{--Role-Permissions--}}
                    <div class="col-lg-6 mb-30">
                      {{--Role--}}
                      <div class="row mb-30 user-role">
                        <label for="" class="col-4 required"><span>Role</span></label>
                        <div class="col-7">
                          <select name="user_role" id="user_role" class="required form-select border-secondary brd-3 @error('city') is-invalid @enderror">
                            <option value="">Select User Role</option>
                            @if ( $roles )
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
                              <input name="permissions[]" type="checkbox"
                                      id="permission-{{ $permission->slug }}" class="form-check-input permission cur-pointer"
                                      value="{{ $permission->slug }}" {{ is_array($user->permissions) && in_array($permission->slug, $user->permissions) ? 'checked' : '' }} />
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
                    <div class="col-lg-6 mb-30">
                      <div class="row justify-content-end h-100 mb-20 user-image">
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

                          <?php
                            /* @var $user */
                            $hasImage = $user->image && file_exists( public_path( $user->image['url'] ) ) ? $user->image['url'] : null;
                            $imageWithDummy = $hasImage ?? 'https://via.placeholder.com/800x800.jpg';
                          ?>
                          <div class="user-image-block mt-10">
                            <div class="image-box">
                              <a href="{{ $hasImage ? asset($hasImage) : '#' }}" class="{{ $hasImage ? 'image-on-lightbox cur-zoomIn' : 'cur-default' }} mr-10">
                                <img src="{{ asset($imageWithDummy) }}" alt="User image" class="user-img h-120px" />
                              </a>

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
