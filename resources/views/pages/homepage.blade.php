@extends( 'layouts.app' )

{{--@section( 'title', '' )--}}

@section('site-content')
<div class="Page Homepage bg-navy-blue text-white">
  <div class="container-lg">
    <div class="page-content">
      <div class="d-table">
        <div class="d-table-cell">

          <div class="row justify-content-center parts-purchase-search-form-area h-auto">
            <div class="col-lg-8 col-md-10">
              <div class="page-header text-center mb-30">
                <h2 class="title text-capitalize fz-36 mt--20 mb-50">
                  Rangs electronics limited
                </h2>
              </div>
              
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

  @if ( session('error') )
    sessionError = @json( session('error') );
  @elseif ( session('success') )
    sessionSuccess = @json( session('success') );
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