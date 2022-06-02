@extends('layouts.app')

{{--@section('title', 'Edit Designation')--}}

@section('site-content')
<div class="Page Designations Edit">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-purple text-white">
          <h5 class="title mb-0">
            <span class="mr-20">Designation</span>
            <span class="edit-mode color-red">Edit-Mode</span>
          </h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="designations-edit-area">
            <div class="row">
              <div class="col-md-6">
                <form method="post" action="{{ route('designation.single.edit', $designation) }}"
                      name="designationEditForm" id="designationEditForm" class="designation-form edit mx-md-3 p-20 pb-0">
                  @csrf

                  {{--Designation-Name--}}
                  <div class="mb-30 name">
                    <label for="" class="required w-100 mr-15"><span>Designation Name</span></label>
                    <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" value="{{ $designation->name }}" />

                    @if ( $errors->has('name') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('name') }}
                      </div>
                    @endif
                  </div>

                  {{--Short-Name--}}
                  <div class="mb-30 short_name">
                    <label for="" class="required w-100 mr-15"><span>Short Name</span></label>
                    <input type="text" name="short_name" id="short_name" class="required form-control border-secondary brd-3 @error('short_name') is-invalid @enderror" value="{{ $designation->short_name }}" />

                    @if ( $errors->has('short_name') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('short_name') }}
                      </div>
                    @endif
                  </div>


                  {{--Submit--}}
                  <div class="my-50 submit">
                    <div class="">
                      <button class="btn btn-purple">Submit</button>
                    </div>
                  </div>

                </form>
              </div>
              
            </div>
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