@extends( 'layouts.app' )

{{--@section( 'title', 'Search-Result Vehicle-Parts-Purchase' )--}}

@section('site-content')
<div class="Page Vehicle-Parts-Purchase Search-Result">
  <div class="container-fluid">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="title mb-0">Purchase Search</h5>
            <span class="">
              <a href="{{ route('vehicle.parts.purchase.all') }}" class="btn btn-purple py-5 px-10">Deep Search</a>
            </span>
          </div>
        </div>


        <div class="card-body page-body p-0">
          <div class="parts-purchase-search-result-area full-height-parent">
            {{--Purchase-Search-Block--}}
            <div class="purchase-search h-auto fz-14 p-15 pt-20 pb-5">
              {{--onsubmit="getSearchQuery(this);"--}}
              <form method="GET" action="{{ route('vehicle.parts.purchase.search') }}"
                    name="purchaseSearchForm" id="purchaseSearchForm" class="search-form">

                <div class="row">
                  {{--Start-Date--}}
                  <div class="col-lg-3 col-md-6 col-12 start-and-end-date">
                    <ul class="list-style-none d-flex flex-column flex-sm-row justify-content-sm-between align-content-center">
                      {{--Date-Start--}}
                      <li class="p-relative date-select flex-grow-1 mb-20 date_start">
                        <input type="text" name="date_start" id="date_start" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="Date From" value="{{ $date_start ?? old('date_start') }}" />
                        <label for="date_start" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </li>

                      <li class="icon d-none d-sm-inline-flex align-self-center mb-20">
                        <span class="d-block fz-18 px-5"><i class="fa fa-long-arrow-right"></i></span>
                      </li>

                      {{--End-Date--}}
                      <li class="p-relative date-select flex-grow-1 mb-20 date_end">
                        <input type="text" name="date_end" id="date_end" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="Date To" value="{{ $date_end ?? old('date_end') }}" />
                        <label for="date_end" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </li>
                    </ul>
                  </div>

                  {{--Parts-ID--}}
                  <div class="col-lg-3 col-md-6 col-12 mb-20 parts_id">
                    <div class="d-flex justify-content-between justify-content-lg-end align-items-center">
                      <label for="" class="fw-500 mr-10"><span>Parts</span></label>
                      <select name="parts_id" id="parts_id" class="form-select border-secondary-1 brd-3">
                        @if ( $parts_all )
                          <option value="all">All</option>
                          @foreach ( $parts_all as $parts )
                            <option value="{{$parts->id}}" {{ $parts_id == $parts->id ? 'selected' : '' }}>
                              {{ $parts->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Vehicle-ID--}}
                  <div class="col-lg-3 col-md-6 col-12 mb-20 vehicle_id">
                    <div class="d-flex justify-content-between justify-content-lg-end align-items-center">
                      <label for="" class="fw-500 mr-10"><span>Vehicles</span></label>
                      <select name="vehicle_id" id="vehicle_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $vehicle_all )
                          <option value="all">All</option>
                          @foreach ( $vehicle_all as $vehicle )
                            <option value="{{$vehicle->id}}" {{ $vehicle_id == $vehicle->id ? 'selected' : '' }}>
                              {{ $vehicle->vehicle_no }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Action-Buttons--}}
                  <div class="col-lg-3 col-md-6 col-12 mb-20 actions-btn">
                    <div class="text-center">
                      <button class="btn btn-primary btn-sm fz-14 fw-500 lh-1-4 py-5 px-10">Search</button>

                      <input type="reset" value="Clear" id="clearPurchaseSearchForm" class="btn btn-secondary btn-sm bg-secondary fz-14 fw-500 lh-1-4 py-5 px-10 ml-5" />

                      <a href="{{ route('vehicle.parts.purchase.search') }}" class="btn btn-dark btn-sm fz-14 fw-500 lh-1-4 py-5 px-10 ml-5">Refresh</a>
                    </div>
                  </div>
                </div>

              </form>
            </div>

            <div class="blank h-auto bt-1 border-secondary-1"></div>

            <div class="purchase-history-details overlay-scrollbar full-height-minus minus-100 p-10">
              <table class="table table-bordered table-hover border-secondary-3 purchase-history-table">
                <thead class="table-header bg-dark text-white fz-14 text-center">
                  <tr class="table-row header align-middle">
                    <th scope="col" class="serial w-30px-min">S/L</th>
                    <th scope="col" class="purchase-number">Purchase No.#</th>
                    <th scope="col" class="purchase-date">Date</th>
                    <th scope="col" class="vehicle-number">Vehicle</th>
                    <th scope="col" class="parts-list">Parts List</th>
                    <th scope="col" class="shop-name">Shop Name</th>
                    <th scope="col" class="total-qty">Total Qty</th>
                    <th scope="col" class="total-amount">Total Amount</th>
                    <th scope="col" class="purchased-by">Purchased-By</th>
                    <th scope="col" class="authorized-by">Authorized-By</th>
                    <th scope="col" class="action">---</th>
                  </tr>
                </thead>

                <tbody class="table-body fz-12 align-middle">
                  @if ( $date_start || $date_end || $parts_id || $vehicle_id )
                    @if ( $purchases_all && count($purchases_all) > 0 )
                      @foreach ( $purchases_all as $index => $purchase )
                        @include('modules.vehicle-module.purchase-parts.index-tableRow', $purchase)
                      @endforeach
                    @else
                      <tr class="table-row content no-purchase align-middle">
                        <td colspan="11" class="error text-danger fz-22 fw-bold text-center py-100">
                          Sorry! Currently there are no record available.
                        </td>
                      </tr>
                    @endif
                  @else
                    <tr class="table-row content no-purchase align-middle">
                      <td colspan="11" class="error text-danger fz-22 fw-bold text-center py-100">
                        Please, select any search criteria!
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>


            {{--Single-Purchase-Details-Modal-View--}}
            <div class="modal fade" id="SinglePurchaseModalView" {{--data-bs-backdrop="static" data-bs-keyboard="true"--}} tabindex="-1" aria-labelledby="PurchaseDetailsModalViewLabel" aria-hidden="true">
              <div id="PurchaseDetailsModalView" class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-scrollable">

                {{--@include('backend.admin.pos-module.order-modalView')--}}

              </div>
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
