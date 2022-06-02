@extends( 'layouts.admin' )

@section( 'title', 'Show Single User' )

@section( 'admin-content' )
<div class="Page User Single">
  <div class="page-wrapper py-15">
    <div class="single-user-page">
      <div class="page-content">
        <div class="card">
          <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
            <h5 class="card-title title lh-1-5 my-0">User Single View</h5>

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
              <div class="single-user-area p-relative pt-20 pb-100">
                @if ( $user )
                  <div class="user-image-block bg-white p-absolute pos-top-right w-300px h-260px mt-25 mr-5 z-index-11">
                    <div class="pl-30 pr-10">
                      <div class="image-box">
                        <?php
                          /* @var $user */
                          $hasImage = $user->image && file_exists( public_path( $user->image['url'] ) ) ? $user->image['url'] : null;
                        ?>
                        @if ( $hasImage )
                          <a href="{{ asset($hasImage) }}" class="image-on-lightbox cur-zoomIn">
                            <img src="{{ asset($hasImage) }}" alt="User image" class="user-img w-100" />
                          </a>
                        @else
                          <img src="https://via.placeholder.com/800x800.jpg" alt="User image not found" class="user-img w-100" />
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="user-info-block">
                    <ul class="list-group">
                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Status</label>
                          <div class="col-md-10">
                            <span class="{{ $user->active ? 'bg-success' : 'bg-danger' }} text-white fw-bold py-5 px-15 brd-3">
                              {{ $user->active ? 'Active' : 'In-Active' }}
                            </span>
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Name</label>
                          <div class="col-md-10">
                            {{ ucwords($user->title) . ' ' . $user->first_name . ' ' . $user->last_name }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Email</label>
                          <div class="col-md-10">
                            <span class="email-address">
                              {{ $user->email }}
                            </span>

                            <span class="email-verify-icon {{ $user->email_verified_at ? 'text-success' : 'color-secondary-1' }} fz-18 lh-1 ml-10">
                              <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->email_verified_at ? 'Verified' : 'Not-Verified' }}">
                                @if ( $user->email_verified_at )
                                  <i class="fas fa-check-circle"></i>
                                @else
                                  <i class="fas fa-check-circle"></i>
                                @endif
                              </span>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Date of Birth</label>
                          <div class="col-md-10">
                            {{ $user->birth_date ? date('d-m-Y', strtotime($user->birth_date)) : '- - -' }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Mobile Number</label>
                          <div class="col-md-10">
                            {{ $user->mobile_number ?? '- - -' }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Landline Number</label>
                          <div class="col-md-10">
                            {{ $user->landline_number ?? '- - -' }}
                          </div>
                        </div>
                      </li>

                      <?php
                        /* @var $user */
                        $address = count($user->addresses) > 0 ? $user->addresses[0] : null;
                      ?>
                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Address</label>
                          <div class="col-md-10">
                            @if ( $address )
                              {{ $address['address_1'] }} <br/>
                              {{ $address['city'] . ', ' . $address['state'] . ' - ' . strtoupper($address['postcode']) }} <br/>
                              {{ strtoupper($address['country']) }}
                            @else
                              {{ '- - -' }}
                            @endif
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">User Role</label>
                          <div class="col-md-10 text-primary fw-bold">
                            {{ ucwords( unslug('-', ' ', $user->role) ) }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">Permissions</label>
                          <div class="col-md-10">
                            @if ( $user->permissions )
                              <ul class="list-style-disc">
                                @foreach ( $user->permissions as $permission )
                                  <li class="float-start mr-50">
                                    {{ ucwords($permission) }}
                                  </li>
                                @endforeach
                              </ul>
                            @endif
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20 routes">
                        <div class="row align-items-start">
                          <label for="" class="col-md-2 fw-bold">Route Access</label>
                          <div class="col-md-10">
                            @if ( $user->routes )
                              <div class="row">
                                @foreach ( $user->routes as $index => $route )
                                <div class="col-lg-3 col-md-4 col-6 mb-10">
                                  <span class="serial mr-5">
                                    {{ $index <=8 ? ('0' . ($index + 1) . '. ') : (($index + 1) . '. ') }}
                                  </span>
                                  {{ ucwords( unslug('.', ' ', $route) ) }}
                                </div>
                                @endforeach
                              </div>
                            @endif
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>

                  @if ( Gate::check('isSuperAdmin') && Gate::check('entryEdit') )
                    <div class="mt-50">
                      <a href="{{ route('user.single.edit', $user->id) }}" class="edit-button btn btn-success fz-18 py-5 px-20 brd-3">Edit</a>
                    </div>
                  @endif
                @else
                  <div class="text-danger text-center mt-100">
                    <h2>Oops! Sorry, user data not found.</h2>
                  </div>
                @endif

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
