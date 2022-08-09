@extends( 'layouts.app' )

@section( 'title', 'Product-Requirement All Index' )

@section( 'site-content' )
<div class="Page Product-Requirement All">
  <div class="">
    <div class="page-content p-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="card-title title lh-1-5 my-0">Product-Requirement All</h5>

          {{-- <div class="">
            <a href="{{ route('product-requirement.new.create') }}" class="btn btn-light btn-sm fw-bold">
              New Requirement
            </a>
          </div> --}}
        </div>


        <div class="card-body page-body full-height-prev-auto pt-10">
          <div class="all-product-requirement-area">
            <div class="product-requirement-search-block h-auto mb-10">
              <form method="GET" action="{{ route('product-requirement.all.show') }}" name="ProductRequirementAllForm" id="ProductRequirementAllForm" class="row mr-0 product-requirement-form all">
                @csrf

                {{-- Search-By --}}
                <div class="col-md-3 mb-10 search-by">
                  <div class="row">
                    <label for="search_by" class="col-lg-4 col-xs-5">
                      <span>Search By</span>
                    </label>

                    <div class="col-lg-8 col-xs-7">
                      <input type="text" name="search_by" id="search_by" class="form-control border-secondary brd-3 fz-14 lh-1-7" placeholder="Product model no# / Requirement no#" value="{{ $search_by }}" />
                    </div>
                  </div>
                </div>

                {{--Submit--}}
                <div class="col-md-3 mb-10 text-end">
                  <button type="submit" class="btn btn-primary fz-14 fw-bold lh-1-4">Search</button>

                  <a href="{{ route('product-requirement.all.show') }}" class="btn btn-dark fz-14 fw-bold lh-1-4 ml-5">Refresh</a>
                </div>
              </form>
            </div>

            {{-- Full-Height-Previous-Element-Auto --}}
            {{-- Overlay-Scrollbar --}}
            <div class="all-product-requirement-display-block full-height-prev-auto overlay-scrollbar bt-1">
              
              

            </div>
          </div> {{-- ./page-area --}}
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
