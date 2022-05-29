@extends( 'layouts.app' )

{{--@section( 'title', 'Search-Form Vehicle-Parts-Purchase' )--}}

@section('site-content')
<div class="Page Vehicle-Parts-Purchase Search-Form bg-navy-blue text-white">
  <div class="container-lg">
    <div class="page-content">
      <div class="d-table">
        <div class="d-table-cell">

          <div class="row justify-content-center parts-purchase-search-form-area h-auto">
            <div class="col-lg-8 col-md-10">
              <div class="page-header text-center mb-30">
                <h5 class="title fz-26 text-capitalize mb-0"><span class="pb-5 bb-3">find parts purchase</span></h5>
              </div>

              <form method="GET" action="{{ route('vehicle.parts.purchase.search-result') }}"
                    name="purchaseSearchForm" id="purchaseSearchForm" class="search-form">
                {{--onsubmit="getSearchQuery(this);"--}}

                <div class="row gx-sm-5">
                  {{--Start-Date--}}
                  <div class="col-sm-6 col-12 mb-30 date_start">
                    <label for="" class="w-100 fw-500"><span>Date From</span></label>
                    <div class="p-relative date-select">
                      <input type="text" name="date_start" id="date_start" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ old('date_start') }}" />
                      <label for="date_start" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                    </div>
                  </div>

                  {{--End-Date--}}
                  <div class="col-sm-6 col-12 mb-30 date_end">
                    <label for="" class="w-100 fw-500"><span>Date To</span></label>
                    <div class="p-relative date-select">
                      <input type="text" name="date_end" id="date_end" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ old('date_end') }}" />
                      <label for="date_end" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                    </div>
                  </div>

                  {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 date_start">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-15"><span>Date From</span></label>
                      <div class="p-relative date-select">
                        <input type="text" name="date_start" id="date_start" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="{{ today()->format($date_format) }}" value="{{ $date_start ?? old('date_start') }}" />
                        <label for="date_start" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 date_end">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-30"><span>Date To</span></label>
                      <div class="p-relative date-select">
                        <input type="text" name="date_end" id="date_end" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="{{ today()->format($date_format) }}" value="{{ $date_end ?? old('date_end') }}" />
                        <label for="date_end" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </div>
                    </div>
                  </div>--}}

                  {{--Parts-ID--}}
                  <div class="col-sm-6 col-12 mb-30 parts_id">
                    <label for="" class="w-100 fw-500"><span>Parts</span></label>
                    <select name="parts_id" id="parts_id" class="form-select border-secondary-1 brd-3">
                      @if ( $parts_all )
                        <option value="all">All</option>
                        @foreach ( $parts_all as $parts )
                          <option value="{{$parts->id}}">
                            {{ $parts->name }}
                          </option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  {{--Vehicle-ID--}}
                  <div class="col-sm-6 col-12 mb-30 vehicle_id">
                    <label for="" class="w-100 fw-500"><span>Vehicle</span></label>
                    <select name="vehicle_id" id="vehicle_id" class="form-select d-inline-block border-secondary-1 brd-3">
                      @if ( $vehicle_all )
                        <option value="all">All</option>
                        @foreach ( $vehicle_all as $vehicle )
                          <option value="{{$vehicle->id}}">
                            {{ $vehicle->vehicle_no }}
                          </option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  {{--Action-Buttons--}}
                  <div class="col-12 mt-10 text-center actions-btn">
                    {{--<label for="" class="d-none text-white fw-bold mb-5"><span>Actions</span></label>--}}
                    <div class="w-100">
                      <button class="btn btn-navy-blue-alt fz-22 fw-bold py-5 px-20">Search</button>
                    </div>
                  </div>
                </div>

              </form>
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
