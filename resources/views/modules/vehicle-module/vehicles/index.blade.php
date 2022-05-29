@extends( 'layouts.app' )

{{--@section( 'title', 'View All Vehicle' )--}}

@section('site-content')
<div class="Page Vehicle Index">
  <div class="container-fluid">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Vehicle Index</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="vehicle-all-area full-height-parent">
            {{--Vehicle-Search-Block--}}
            <div class="vehicle-search h-auto fz-14 p-15 pt-10 pb-5">
              <form method="GET" action="{{ route('vehicle.all.show') }}"
                    name="vehicleSearchForm" id="vehicleSearchForm" class="vehicle-search-form">

                <div class="row">
                  {{--Search-By--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 search_by">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-end mr-10"><span>Search By</span></label>
                      <input type="text" name="search_by" id="search_by" class="form-control d-inline-block fz-14 lh-1-8 border-secondary-1 brd-3" placeholder="Vehicle No." value="{{ $search_by ?? '' }}" />
                    </div>
                  </div>
                  
                  {{--Category--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 category_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-end mr-10"><span>Category</span></label>
                      <select name="category_id" id="category_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $category_all )
                          <option value="all">All</option>
                          @foreach ( $category_all as $category )
                            <option value="{{$category->id}}" {{ $category->id == $category_id ? 'selected' : '' }}>
                              {{ $category->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Brand--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 brand_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-end mr-10"><span>Brand</span></label>
                      <select name="brand_id" id="brand_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $brand_all )
                          <option value="all">All</option>
                          @foreach ( $brand_all as $brand )
                            <option value="{{$brand->id}}" {{ $brand->id == $brand_id ? 'selected' : '' }}>
                              {{ $brand->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Department--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 department_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-end mr-10"><span>Department</span></label>
                      <select name="department_id" id="department_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $department_all )
                          <option value="all">All</option>
                          @foreach ( $department_all as $department )
                            <option value="{{$department->id}}" {{ $department->id == $department_id ? 'selected' : '' }}>
                              {{ $department->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Driver--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 driver_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-end mr-10"><span>Driver</span></label>
                      <select name="driver_id" id="driver_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $driver_all )
                          <option value="all">All</option>
                          @foreach ( $driver_all as $driver )
                            <option value="{{$driver->id}}" {{ $driver->id == $driver_id ? 'selected' : '' }}>
                              {{ $driver->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Helper--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 helper_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-end mr-10"><span>Helper</span></label>
                      <select name="helper_id" id="helper_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $helper_all )
                          <option value="all">All</option>
                          @foreach ( $helper_all as $helper )
                            <option value="{{$helper->id}}" {{ $helper->id == $helper_id ? 'selected' : '' }}>
                              {{ $helper->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Status--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 status">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-end mr-10"><span>Status</span></label>
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

                      <input type="reset" value="Clear" id="clearVehicleSearchForm" class="btn btn-secondary btn-sm bg-secondary fz-14 fw-bold lh-1-4 py-5 px-10 ml-5" />

                      <a href="{{ route('vehicle.all.show') }}" class="btn btn-dark btn-sm fz-14 fw-bold lh-1-4 py-5 px-10 ml-5">Refresh</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="blank h-auto bt-1 border-secondary-1"></div>

            <div class="vehicle-all-details overlay-scrollbar full-height-minus minus-110 p-10">
              <table class="table table-bordered table-hover border-secondary-3 vehicle-all-table">
                <thead class="table-header bg-dark text-white fz-14 text-center">
                  <tr class="table-row header align-middle">
                    <th scope="col" class="serial w-30px-min">S/L</th>
                    <th scope="col" class="vehicle-no">Vehicle No.</th>
                    <th scope="col" class="vehicle-status">Status</th>
                    <th scope="col" class="vehicle-brand">Brand</th>
                    <th scope="col" class="vehicle-category">Category</th>
                    <th scope="col" class="vehicle-cc">CC</th>
                    <th scope="col" class="vehicle-origin">Origin</th>
                    <th scope="col" class="vehicle-department">Department</th>
                    <th scope="col" class="vehicle-driver">Driver</th>
                    <th scope="col" class="vehicle-helper">Helper</th>
                    <th scope="col" class="action">---</th>
                  </tr>
                </thead>

                <tbody class="table-body fz-12">
                  @if ( $vehicle_all && count($vehicle_all) > 0 )
                    @foreach ( $vehicle_all as $index => $vehicle )
                      @include('modules.vehicle-module.vehicles.index-tableRow', $vehicle)
                    @endforeach
                  @else
                    <tr class="table-row content no-vehicle align-middle">
                      <td colspan="11" class="error text-danger fz-22 fw-bold text-center py-100">Sorry! Currently there are no vehicle available.</td>
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
