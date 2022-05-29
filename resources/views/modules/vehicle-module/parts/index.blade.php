@extends( 'layouts.app' )

{{--@section( 'title', 'View All Parts' )--}}

@section('site-content')
<div class="Page Parts Index">
  <div class="container-fluid">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Parts Index</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="parts-all-area full-height-parent">
            {{--Parts-Search-Block--}}
            <div class="parts-search h-auto fz-14 p-15 pt-10 pb-5">
              <form method="GET" action="{{ route('vehicle.parts.all') }}"
                    name="partsSearchForm" id="partsSearchForm" class="parts-search-form">

                <div class="row">
                  {{--Search-By--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 search_by">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Search By</span></label>
                      <input type="text" name="search_by" id="search_by" class="form-control d-inline-block fz-14 lh-1-8 border-secondary-1 brd-3" placeholder="Parts Name" value="{{ $search_by ?? '' }}" />
                    </div>
                  </div>
                  
                  {{--Category--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 parts_category">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Category</span></label>
                      <select name="parts_category" id="parts_category" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $category_all )
                          <option value="all">All</option>
                          @foreach ( $category_all as $category )
                            <option value="{{$category->id}}" {{ $category->id == $parts_category ? 'selected' : '' }}>
                              {{ $category->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Status--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 status">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Status</span></label>
                      <select name="status" id="status" class="form-select d-inline-block border-secondary-1 brd-3">
                        <option value="">General</option>
                        <option value="enabled" {{ $status == 'enabled' ? 'selected' : '' }}>Enabled</option>
                        <option value="disabled" {{ $status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                      </select>
                    </div>
                  </div>

                  {{--Action-Buttons--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 action-btns">
                    <div class="w-100 text-center">
                      <button class="btn btn-primary btn-sm fz-14 fw-bold lh-1-4 py-5 px-10">Search</button>

                      <input type="reset" value="Clear" id="clearPartsSearchForm" class="btn btn-secondary btn-sm bg-secondary fz-14 fw-bold lh-1-4 py-5 px-10 ml-5" />

                      <a href="{{ route('vehicle.parts.all') }}" class="btn btn-dark btn-sm fz-14 fw-bold lh-1-4 py-5 px-10 ml-5">Refresh</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="blank h-auto bt-1 border-secondary-1"></div>

            <div class="parts-all-details overlay-scrollbar full-height-minus minus-70 p-10">
              <table class="table table-bordered table-hover border-secondary-3 parts-all-table">
                <thead class="table-header bg-dark text-white fz-14 text-center">
                  <tr class="table-row header align-middle">
                    <th scope="col" class="serial w-30px-min">S/L</th>
                    <th scope="col" class="parts-name">Parts Name</th>
                    <th scope="col" class="parts-status">Status</th>
                    <th scope="col" class="parts-category">Category</th>
                    <th scope="col" class="parts-origin">Origin</th>
                    <th scope="col" class="parts-unit">Unit</th>
                    <th scope="col" class="parts-sizes">Sizes</th>
                    <th scope="col" class="parts-description">Description</th>
                    <th scope="col" class="parts-metals">Metals</th>
                    <th scope="col" class="parts-materials">Materials</th>
                    <th scope="col" class="action">---</th>
                  </tr>
                </thead>

                <tbody class="table-body fz-12">
                  @if ( $parts_all && count($parts_all) > 0 )
                    @foreach ( $parts_all as $index => $parts )
                      @include('modules.vehicle-module.parts.index-tableRow', $parts)
                    @endforeach
                  @else
                    <tr class="table-row content no-parts align-middle">
                      <td colspan="11" class="error text-danger fz-22 fw-bold text-center py-100">Sorry! Currently there are no parts available.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>

          </div> {{-- ./page-area --}}
        </div> {{-- ./card-body --}}
      </div> {{-- ./card --}}
    </div> {{-- ./page-content --}}
  </div> {{-- ./container-fluid --}}
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
