@extends( 'layouts.app' )

@section( 'title', 'Show Single User' )

@section( 'site-content' )
<div class="Page User Single">
  <div class="page-wrapper p-10">
    <div class="single-user-page">
      <div class="page-content">
        <div class="card">
          <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
            <h5 class="card-title title lh-1-5 my-0">User Single View</h5>

            <div class="">
              <a href="{{ route('user.new.create') }}" class="btn btn-light btn-sm fw-bold">
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

          <div class="card-body overlay-scrollbar">
            <div class="page-body">
              <div class="single-user-area p-relative pt-20">
                @if ( $user )
                  <div class="user-image-block bg-white p-absolute pos-top-right w-300px h-260px mt-35 mr-5 z-index-11">
                    <div class="pl-30 pr-10">
                      <div class="image-box">
                        <?php
                          /* @var $user */
                          $hasImage = $user->employee->image && file_exists( public_path( $user->employee->image['url'] ) ) ? $user->employee->image['url'] : null;
                        ?>
                        @if ( $hasImage )
                          <a href="{{ asset($hasImage) }}" class="image-on-lightbox cur-zoomIn">
                            <img src="{{ asset($hasImage) }}" alt="User image" class="user-img w-100" />
                          </a>
                        @else
                          <img src="https://via.placeholder.com/800x800.jpg" alt="" class="user-img w-100" />
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="user-info-block h-auto">
                    <ul class="list-group">
                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Name
                          </label>

                          <div class="col-md-10">
                            {{ $user->name }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Username
                          </label>

                          <div class="col-md-10">
                            {{ $user->username }}
                          </div>
                        </div>
                      </li>
                      
                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Status
                          </label>

                          <div class="col-md-10">
                            <span class="{{ $user->active ? 'bg-success' : 'bg-danger' }} text-white fw-bold py-5 px-15 brd-3">
                              {{ $user->active ? 'Active' : 'Not-Active' }}
                            </span>
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Email
                          </label>
                          
                          <div class="col-md-10">
                            <span class="email-address">
                              {{ $user->email }}
                            </span>

                            <span class="email-verify-icon {{ $user->email_verified_at ? 'text-success' : 'text-secondary' }} fz-18 lh-1 ml-10">
                              <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->email_verified_at ? 'Verified' : 'Not-Verified' }}">
                                @if ( $user->email_verified_at )
                                  <i class="fa fa-check-circle"></i>
                                @else
                                  <i class="fa fa-check-circle"></i>
                                @endif
                              </span>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Mobile Number (Personal)
                          </label>

                          <div class="col-md-10">
                            {{ $user->phone_personal ?? '- - -' }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Mobile Number (Official)
                          </label>

                          <div class="col-md-10">
                            {{ $user->phone_official ?? '- - -' }}
                          </div>
                        </div>
                      </li>
                      
                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Present Address
                          </label>

                          <div class="col-md-10">
                            {{ $user->employee->present_address ?? '- - -' }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Permanent Address
                          </label>
                          
                          <div class="col-md-10">
                            {{ $user->employee->permanent_address ?? '- - -' }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            User Role
                          </label>

                          <div class="col-md-10 text-primary fw-bold">
                            {{ $user->role->name }}
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20">
                        <div class="row align-items-center">
                          <label for="" class="col-md-2 fw-bold">
                            Permissions
                          </label>

                          <div class="col-md-10">
                            @if ( $user->permissions )
                              <ul class="row list-style-disc">
                                @foreach ( $user->permissions as $permission )
                                  <li class="col-lg-2 col-md-3 col-sm-4 col-6 mb-10">
                                    {{ ucwords( str_replace('-', ' ', $permission) ) }}
                                  </li>
                                @endforeach
                              </ul>
                            @else
                              {{ '- - -' }}
                            @endif
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item py-20 routes">
                        <div class="row align-items-start">
                          <label for="" class="col-md-2 fw-bold">
                            Route Access
                          </label>

                          <div class="col-md-10">
                            @if ( $user->routes )
                              <div class="row">
                                @foreach ( $user->routes as $index => $route )
                                <div class="col-lg-3 col-md-4 col-6 mb-10">
                                  <span class="serial mr-5">
                                    {{ $index <= 8 ? ('0' . ($index + 1) . '. ') : (($index + 1) . '. ') }}
                                  </span>
                                  {{ ucwords( str_replace('.', ' ', $route) ) }}
                                </div>
                                @endforeach
                              </div>
                            @else
                              {{ '- - -' }}
                            @endif
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>

                  @if ( Gate::check('isSuperAdmin') && Gate::check('entryEdit') )
                    <div class="h-auto py-50">
                      <a href="{{ route('user.single.edit', $user->uid) }}" class="edit-button btn btn-success fz-18 py-5 px-20 brd-3">
                        Edit
                      </a>
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
