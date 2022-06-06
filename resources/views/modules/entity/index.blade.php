@extends( 'layouts.app' )

@section( 'title', 'Entity All Index' )

@section( 'site-content' )
<div class="Page Entity All">
  <div class="">
    <div class="page-content p-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="card-title title lh-1-5 my-0">Entity All</h5>

          <div class="">
            <a href="{{ route('entity.new.create') }}" class="btn btn-light btn-sm fw-bold">
              Add Entity
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
            <div class="all-entity-area">
              <div class="entity-search-block h-auto mb-10">
                <form method="GET" action="{{ route('entity.all.index') }}" name="EntityAllForm" id="EntityAllForm" class="row mr-30 entity-form all">
                  @csrf

                  {{-- Search-By --}}
                  <div class="col-md-3 mb-10 search-by">
                    <div class="row">
                      <label for="search_by" class="col-lg-4 col-xs-5">
                        <span>Search By</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <input type="text" name="search_by" id="search_by" class="form-control fz-14 lh-1-8 border-secondary brd-3" placeholder="Entity Name / Location / Email / Contact Number" value="{{ $search_by }}" />
                      </div>
                    </div>
                  </div>
                
                  {{-- By-Territory --}}
                  <div class="col-md-3 mb-10 territory_id">
                    <div class="row">
                      <label for="territory_id" class="col-lg-4 col-xs-5">
                        <span>Territory</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <select name="territory_id" id="territory_id" class="form-select border-secondary brd-3">
                          <option value="all">All</option>

                          @if ( $territory_all )
                            @foreach ( $territory_all as $territory )
                              <option value="{{$territory->id}}" {{ $territory->id == $territory_id ? 'selected' : '' }}>
                                {{ $territory->name }}
                              </option>
                            @endforeach
                          @endif

                        </select>
                      </div>
                    </div>
                  </div>
                
                  {{-- By-Zone --}}
                  <div class="col-md-3 mb-10 zone_id">
                    <div class="row">
                      <label for="zone_id" class="col-lg-4 col-xs-5">
                        <span>Zone</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <select name="zone_id" id="zone_id" class="form-select border-secondary brd-3">
                          <option value="all">All</option>

                          @if ( $zone_all )
                            @foreach ( $zone_all as $zone )
                              <option value="{{$zone->id}}" {{ $zone->id == $zone_id ? 'selected' : '' }}>
                                {{ $zone->name }}
                              </option>
                            @endforeach
                          @endif

                        </select>
                      </div>
                    </div>
                  </div>
                
                  {{-- By-Entity-Type --}}
                  <div class="col-md-3 mb-10 entity_type">
                    <div class="row">
                      <label for="entity_type" class="col-lg-4 col-xs-5">
                        <span>Entity Type</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <select name="entity_type" id="entity_type" class="form-select border-secondary brd-3">
                          <option value="all">All</option>

                          @if ( $entity_types )
                            @foreach ( $entity_types as $type )
                              <option value="{{$type}}" {{ $type == $entity_type ? 'selected' : '' }}>
                                {{ ucwords( str_replace('-', ' ', $type) ) }}
                              </option>
                            @endforeach
                          @endif

                        </select>
                      </div>
                    </div>
                  </div>
                
                  {{-- By-Category --}}
                  <div class="col-md-3 mb-10 category">
                    <div class="row">
                      <label for="category" class="col-lg-4 col-xs-5">
                        <span>Category</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <select name="category" id="category" class="form-select border-secondary brd-3">
                          <option value="all">All</option>

                          @if ( $category_all )
                            @foreach ( $category_all as $cat )
                              <option value="{{$cat}}" {{ $cat == $category ? 'selected' : '' }}>
                                {{ ucwords( str_replace('-', ' ', $cat) ) }}
                              </option>
                            @endforeach
                          @endif

                        </select>
                      </div>
                    </div>
                  </div>
                
                  {{-- By-Ownership --}}
                  <div class="col-md-3 mb-10 ownership">
                    <div class="row">
                      <label for="ownership" class="col-lg-4 col-xs-5">
                        <span>Ownership</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <select name="ownership" id="ownership" class="form-select border-secondary brd-3">
                          <option value="all">All</option>

                          @if ( $ownership_all )
                            @foreach ( $ownership_all as $owner )
                              <option value="{{$owner}}" {{ $owner == $ownership ? 'selected' : '' }}>
                                {{ ucwords( str_replace('-', ' ', $owner) ) }}
                              </option>
                            @endforeach
                          @endif

                        </select>
                      </div>
                    </div>
                  </div>

                  {{-- By-Status --}}
                  <div class="col-md-3 mb-10 status">
                    <div class="row">
                      <label for="status" class="col-lg-4 col-xs-5">
                        <span>Status</span>
                      </label>

                      <div class="col-lg-8 col-xs-7">
                        <select name="status" id="showEntityByStatus" class="form-select border-secondary brd-3">
                          <option value="">Select Status</option>

                          <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>

                          <option value="not-active" {{ $status == 'not-active' ? 'selected' : '' }}>Not-Active</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  {{--Submit--}}
                  <div class="col-md-3 mb-10 text-end">
                    <button type="submit" class="btn btn-primary fz-14 fw-bold lh-1-4">Search</button>

                    <a href="{{ route('entity.all.index') }}" class="btn btn-dark fz-14 fw-bold lh-1-4 ml-5">Refresh</a>
                  </div>
                </form>
              </div>

              <div class="all-entity-display-block">
                
                @if ( $entity_all && count($entity_all) > 0 )
                  @php
                    $serial = $entity_all->currentPage() == 1 ? 1 : ((($entity_all->currentPage() - 1) * $paginate) + 1);

                    $page_track = $entity_all->currentPage() == 1 ? 'first-page' : ($entity_all->currentPage() == $entity_all->lastPage() ? 'last-page' : 'center-page');
                  @endphp
                  
                  {{-- paginate-links --}}
                  {{-- <div class="pagination-links {{ $entity_all->total() > $paginate ? 'mb-5' : '' }}">
                    {{ $entity_all->withQueryString()->links() }}
                  </div> --}}

                  <table class="table table-bordered border-1 bt-0 border-secondary-4 entity-all-table">
                    <thead class="bg-dark text-white text-center fw-normal">
                      <tr class="entity-row align-middle">
                        <th class="serial">##</th>
                        <th class="entity-name">Entity Name</th>
                        <th class="entity-status">Status</th>
                        <th class="entity-address">Address</th>
                        <th class="entity-type">Type</th>
                        <th class="entity-cat">Category</th>
                        <th class="entity-owner">Ownership</th>
                        <th class="entity-email">Email</th>
                        <th class="entity-incharge">Incharge</th>
                        <th class="entity-contact">Contact #</th>
                        <th class="actions"></th>
                      </tr>
                    </thead>

                    <tbody id="display-entity-body">
                      @foreach ( $entity_all as $index => $entity )
                        @if ( $entity->type == 'zone' )
                          @if ( $entity->children->count() )
                            @foreach ( $entity as $key => $child_entity )
                              
                            @endforeach
                          @endif
                        @endif

                        <tr class="entity-row align-middle {{ ($index+1) % 2 == 0 ? '' : 'bg-success-light color-black' }}">
                          <td class="serial text-center">
                            {{ $serial++ }}
                          </td>

                          <td class="entity-name">
                            {{ $entity->name }}
                          </td>

                          <td class="entity-status text-center">
                            <span class="{{ $entity->active ? 'bg-success' : 'bg-danger' }} text-white fz-14 fw-500 lh-1-6 py-2 px-8 brd-3">
                              {{ $entity->active ? 'Active' : 'Not-Active' }}
                            </span>
                          </td>

                          <td class="entity-address">
                            @if ( $entity->address )
                              {{ $entity->address }}
                            @else
                              <span class="d-block text-center">- - -</span>
                            @endif
                          </td>

                          <td class="entity-type">
                            {{ ucwords( str_replace('-', ' ', $entity->type) ) }}
                          </td>

                          <td class="entity-cat">
                            {{ ucwords( str_replace('-', ' ', $entity->category) ) }}
                          </td>

                          <td class="entity-owner">
                            {{ ucwords( str_replace('-', ' ', $entity->ownership) ) }}
                          </td>

                          <td class="entity-email">
                            {{ $entity->email }}
                          </td>

                          <td class="entity-incharge">
                            @if ( $entity->incharge->name )
                              {{ $entity->incharge->name }}
                            @else
                              <span class="d-block text-center">- - -</span>
                            @endif
                          </td>

                          <td class="entity-contact">
                            {{ $entity->phone_primary ?? '' }}
                            @if ( $entity->phone_secondary )
                              @if ( $entity->phone_primary ) <br> @endif
                                {{ $entity->phone_secondary }}
                            @endif
                            @if ( ! $entity->phone_primary && ! $entity->phone_secondary )
                              <span class="d-block text-center">- - -</span>
                            @endif
                          </td>

                          <td class="actions text-center">
                            <a href="{{ route('entity.single.show', $entity->uid) }}"
                              class="show-single-entity btn btn-primary fz-14 fw-500 py-3 px-10 brd-3">View</a>

                            @if ( Auth::user()->can('isSuperAdmin') && Auth::user()->can('entryEdit') )
                              <a href="{{ route('entity.single.edit', $entity->uid) }}"
                                class="edit-entity btn btn-success fz-14 fw-500 py-3 px-10 brd-3 ms-1">Edit</a>
                            @endif
                          </td>
                        </tr>

                      @endforeach
                    </tbody>
                  </table>
                  
                  {{-- paginate-links --}}
                  <div class="pagination-links {{ $entity_all->total() > $paginate ? 'mt-5' : '' }}">
                    {{ $entity_all->withQueryString()->links() }}
                  </div>

                @else
                  <div class="text-danger fz-30 fw-bold text-center py-100">
                    <div class="">Oops! Sorry.</div>
                    There are no entity found.
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
