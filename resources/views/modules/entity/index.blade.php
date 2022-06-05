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
            <a href="{{ route('user.new.create') }}" class="btn btn-light btn-sm fw-bold">
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
            
            HTML from User Index

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
