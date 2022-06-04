@extends( 'layouts.app' )

@section( 'title', 'User All Index' )

@section( 'site-content' )
<div class="Page User All">
  <div class="">
    <div class="page-content p-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="card-title title lh-1-5 my-0">User All</h5>

          <div class="">
            <a href="{{ route('user.new.create') }}" class="btn btn-light btn-sm fw-bold">
              Add User
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

        <div class="card-body overlay-scrollbar pt-10">
          <div class="page-body">
            <div class="all-user-area">
              <div class="user-search-block h-auto mb-10">
                <form method="GET" action="{{ route('user.all.index') }}" name="AllUserForm" id="AllUserForm" class="row mr-30 user-form all">
                  @csrf

                  {{--Search-By--}}
                  <div class="col-md-3 mb-10 search-by">
                    <div class="row">
                      <label for="" class="col-lg-4 col-xs-5">
                        <span>Search By</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <input type="text" name="search_by" id="search_by" class="form-control fz-14 lh-1-8 border-secondary brd-3" placeholder="First Name / Last Name / Email / Role / Contact Number" value="{{ $searchBy ?? '' }}" />
                      </div>
                    </div>
                  </div>
                
                  {{--Department--}}
                  <div class="col-md-3 mb-10 department_id">
                    <div class="row">
                      <label for="" class="col-lg-4 col-xs-5">
                        <span>Department</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <select name="department_id" id="department_id" class="form-select border-secondary brd-3">
                          <option value="all">All</option>

                          {{-- @if ( $department_all )
                            @foreach ( $department_all as $department )
                              <option value="{{$department->id}}" {{ $department->id == $department_id ? 'selected' : '' }}>
                                {{ $department->name }}
                              </option>
                            @endforeach
                          @endif --}}
                        </select>
                      </div>
                    </div>
                  </div>

                  {{--By-Status--}}
                  <div class="col-md-3 mb-10 status">
                    <div class="row ml-30">
                      <label for="" class="col-lg-4 col-xs-5">Status</label>
                      <div class="col-lg-8 col-xs-7">
                        <select name="status" id="showUserByStatus" class="form-select border-secondary brd-3">
                          <option value="">Select Status</option>

                          <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>

                          <option value="not-active" {{ $status == 'not-active' ? 'selected' : '' }}>Not-Active</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  {{--Submit--}}
                  <div class="col-md-3 mb-10 text-center">
                    <button type="submit" class="btn btn-primary fz-14 fw-bold lh-1-4">Search</button>

                    <a href="{{ route('user.all.index') }}" class="btn btn-dark fz-14 fw-bold lh-1-4 ml-5">Refresh</a>
                  </div>
                </form>
              </div>

              <div class="all-user-display-block">
                
                @if ( $user_all && count($user_all) > 0 )
                  @php
                    $serial = $user_all->currentPage() == 1 ? 1 : ((($user_all->currentPage() - 1) * $paginate) + 1);

                    $page_track = $user_all->currentPage() == 1 ? 'first-page' : ($user_all->currentPage() == $user_all->lastPage() ? 'last-page' : 'center-page');
                  @endphp
                  
                  {{-- paginate-links --}}
                  {{-- <div class="pagination-links {{ $user_all->total() > $paginate ? 'mb-5' : '' }}">
                    {{ $user_all->withQueryString()->links() }}
                  </div> --}}

                  <table class="table table-bordered border-1 bt-0 border-secondary-4 user-all-table">
                    <thead class="bg-dark text-white text-center fw-normal">
                      <tr class="user-row align-middle">
                        <th class="serial">##</th>
                        <th class="user-username">Username</th>
                        <th class="user-status">Status</th>
                        <th class="user-name">Name</th>
                        <th class="user-email">Email</th>
                        <th class="user-role">Role</th>
                        <th class="user-contact">Contact #</th>
                        <th class="user-image w-120px">Image</th>
                        <th class="actions"></th>
                      </tr>
                    </thead>

                    <tbody id="display-user-body">
                      @foreach ( $user_all as $index => $user )
                        <tr class="user-row align-middle {{ ($index+1) % 2 == 0 ? '' : 'bg-success-light color-black' }}">
                          <td class="serial text-center">
                            {{ $serial++ }}
                          </td>

                          <td class="user-username">
                            {{ $user->username }}
                          </td>

                          <td class="user-status text-center">
                            <span class="{{ $user->active ? 'bg-success' : 'bg-danger' }} text-white fz-14 fw-500 lh-1-6 py-2 px-8 brd-3">
                              {{ $user->active ? 'Active' : 'Not-Active' }}
                            </span>
                          </td>

                          <td class="user-name">
                            {{ $user->name }}
                          </td>

                          <td class="user-email">
                            {{ $user->email }}
                          </td>

                          <td class="user-role">
                            {{ $user->role->name }}
                          </td>

                          <td class="user-contact">
                            {{ $user->phone_personal ?? '' }}
                            @if ( $user->phone_official )
                              @if ( $user->phone_personal ) <br> @endif
                                {{ $user->phone_official }}
                            @endif
                            @if ( ! $user->phone_personal && ! $user->phone_official ) --- @endif
                          </td>

                          <td class="user-image w-120px">
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
                                <img src="https://via.placeholder.com/800x680.jpg" alt="" class="user-img w-100" />
                              @endif
                            </div>
                          </td>

                          <td class="actions text-center">
                            <a href="{{ route('user.single.show', $user->uid) }}"
                              class="show-single-user btn btn-primary fz-14 fw-500 py-3 px-10 brd-3">View</a>

                            @if ( Auth::user()->can('isSuperAdmin') && Auth::user()->can('entryEdit') )
                              <a href="{{ route('user.single.edit', $user->uid) }}"
                                class="edit-user btn btn-success fz-14 fw-500 py-3 px-10 brd-3 ms-1">Edit</a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
                  {{-- paginate-links --}}
                  <div class="pagination-links {{ $user_all->total() > $paginate ? 'mt-5' : '' }}">
                    {{ $user_all->withQueryString()->links() }}
                  </div>

                @else
                  <div class="text-danger fz-30 fw-bold text-center py-100">
                    <div class="">Oops! Sorry.</div>
                    There are no registered user found.
                  </div>
                @endif

              </div>
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
