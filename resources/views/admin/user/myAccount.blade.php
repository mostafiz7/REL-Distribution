@extends( 'layouts.admin' )

@section( 'title', 'My Account' )

@section( 'admin-content' )
<div class="Page MyAccount">
  <div class="page-wrapper py-15">
    <div class="myAccount-page">
      <div class="page-content">
        <div class="card">
          <div class="card-header page-header bg-info text-white">
            <h5 class="card-title title lh-1-5 my-0">My Profile</h5>
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
              <div class="myAccount-area mt-20">
                <form method="POST" action="{{ route('my.profile.admin') }}" name="MyAccountForm" id="MyAccountForm" class="myAccount-form">
                  @csrf
                  @method('PUT')

                  <div class="row mb-20 mx-30">
                    {{--First-Name, Last-Name & Email--}}
                    <div class="col-lg-6">
                      {{--First-Name--}}
                      <div class="row mb-20 first-name">
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

                      {{--Last-Name--}}
                      <div class="row mb-20 last-name">
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

                      {{--Email--}}
                      <div class="row email">
                        <label for="" class="col-4"><span>Email</span></label>
                        <div class="col-7">
                          <input disabled type="email" class="form-control border-secondary brd-3 cur-not-allowed @error('email') is-invalid @enderror" value="{{ $user->email }}" />

                          @if ( $errors->has('email') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('email') }}
                            </div>
                          @endif

                          <div class="text-danger fz-12 fw-bold info">Email address not-changeable</div>
                        </div>
                      </div>
                    </div>

                    {{--Old-Password & Change-Password--}}
                    <div class="col-lg-6">
                      {{--OLD-Password--}}
                      <div class="row mb-20 justify-content-end password-old">
                        <label for="" class="col-4"><span>Old Password</span></label>
                        <div class="col-7">
                          <div class="input-group p-relative">
                            <input type="password" name="old_password" id="old_password" class="form-control border-secondary brd-3 z-index-9 @error('old_password') is-invalid @enderror" placeholder="Old Password" />

                            <label id="showOldPassword" class="input-label-icon p-absolute pos-top-right text-secondary fz-19 lh-1-2 cur-pointer z-index-11 @error('old_password') mr-25 @enderror"
                              data-bs-toggle="tooltip" data-bs-placement="top" title="Show old password">
                              <i class="fa fa-eye"></i>
                            </label>
                          </div>

                          @if ( $errors->has('old_password') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('old_password') }}
                            </div>
                          @endif
                        </div>
                      </div>

                      {{--New-Password--}}
                      <div class="row mb-20 justify-content-end password-new">
                        <label for="" class="col-4"><span>New Password</span></label>
                        <div class="col-7">
                          <div class="input-group p-relative">
                            <input type="password" name="password" id="password" class="form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="New Password" />

                            <label for="" id="showPassword" class="input-label-icon p-absolute pos-top-right text-secondary fz-19 lh-1-2 cur-pointer z-index-11 @error('password') mr-25 @enderror"
                              data-bs-toggle="tooltip" data-bs-placement="top" title="Show new password">
                              <i class="fa fa-eye"></i>
                            </label>
                          </div>

                          @if ( $errors->has('password') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('password') }}
                            </div>
                          @endif

                          <div class="color-dark fz-14 lh-1 pt-5 info">Min 8 character</div>
                        </div>
                      </div>

                      {{--Confirm-Password--}}
                      <div class="row justify-content-end password-confirmation">
                        <label for="" class="col-4"><span>Confirm New Password</span></label>
                        <div class="col-7">
                          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-secondary brd-3 @error('password') is-invalid @enderror" placeholder="Retype new password" />

                          @if ( $errors->has('password') )
                            <div class="text-danger fw-bold" role="alert">
                              {{ $errors->first('password') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="section-divider my-20 bb-1 border-secondary-3"></div>

                  {{--Birth-Date & Postcode--}}
                  <div class="row mb-20 mx-30">
                    {{--Date of Birth--}}
                    <div class="col-lg-6 birth-date">
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
                    <div class="col-lg-6 postcode">
                      <div class="row justify-content-end">
                        <label for="" class="col-4"><span>Postcode</span></label>
                        <div class="col-7">
                          <input type="text" name="postcode" id="postcode" class="form-control border-secondary brd-3 @error('postcode') is-invalid @enderror" placeholder="RM12 6NB" value="{{ $address ? $address['postcode'] : '' }}" />

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
                  </div>

                  {{--Mobile-Number & Landline-Number--}}
                  <div class="row mb-20 mx-30">
                    {{--Mobile-Number--}}
                    <div class="col-lg-6 mobile-number">
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
                    <div class="col-lg-6 landline-number">
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
                  </div>

                  {{--Address-1 & Address-2--}}
                  <div class="row mb-20 mx-30">
                    {{--Address-Line-1--}}
                    <div class="col-lg-6 address-1">
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

                    {{--Address-Line-2--}}
                    <div class="col-lg-6 address-2">
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
                  </div>

                  {{--City-Town & State-County--}}
                  <div class="row mb-20 mx-30">
                    {{--City-Town--}}
                    <div class="col-lg-6 city">
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

                    {{--State-County--}}
                    <div class="col-lg-6 state-county">
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
                  </div>

                  {{--Country Name--}}
                  <div class="row mb-20 mx-30">
                    <div class="col-lg-6 country">
                      <div class="row">
                        <label for="country" class="col-4"><span>Country Name</span></label>
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
                    
                  </div>

                  <div class="section-divider my-20 bb-1 border-secondary-3"></div>


                  {{--Hidden input for user ID--}}
                  <input type="hidden" value="{{ $user->id }}" name="userId" id="userId" class="visually-hidden" />


                  {{--Submit--}}
                  <div class="row mt-50 mb-100 mx-30">
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-success px-30">Update Profile</button>
                    </div>
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
