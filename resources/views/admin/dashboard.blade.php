@extends('layouts.app')

{{--@section('title', 'Admin Dashboard')--}}

@section('content')
<div class="Page Dashboard">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        {{-- <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Admin Dashboard</h5>
        </div> --}}


        <div class="card-body page-body">
          <div class="dashboard-area">
            
            <h3>Admin Dashboard</h3>
            
          </div> {{-- ./page-content-area --}}
        </div> {{-- ./card-body --}}
      </div> {{-- ./card --}}
    </div> {{-- ./page-content --}}
  </div> {{-- ./container --}}
</div> {{-- ./Page View-Name --}}
@endsection



@section('custom-script')
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