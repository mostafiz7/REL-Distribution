@extends('layouts.app')

{{--@section('title', 'Add New Vehicle-Brands')--}}

@section('site-content')
<div class="Page Vehicle-Brands New">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Vehicle Brands</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="vehicleBrands-new-area">
            <div class="row">
              <div class="col-md-6">
                <form method="post" action="{{ route('vehicle.brands') }}"
                      name="addVehicleBrandForm" id="addVehicleBrandForm" class="vehicleBrand-form new mx-md-3 p-20 pb-0">
                  @csrf

                  <div class="fz-20 fw-bold mb-30 pb-5 bb-1">
                    Add New Brand:
                  </div>

                  {{--Brand-Name--}}
                  <div class="mb-30 name">
                    <label for="" class="required w-100 mr-15"><span>Brand Name</span></label>
                    <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" placeholder="Toyota" value="{{ old('name') }}" />

                    @if ( $errors->has('name') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('name') }}
                      </div>
                    @endif
                  </div>

                  {{--Origin--}}
                  <div class="mb-30 origin">
                    <label for="" class="required w-100 mr-15"><span>Origin</span></label>
                    {{--<input type="text" name="origin" id="origin" class="required form-control border-secondary brd-3 @error('origin') is-invalid @enderror" value="{{ old('origin') }}" />--}}
                    <select name="origin" id="origin" class="required form-select border-secondary brd-3 @error('origin') is-invalid @enderror">
                      <option value="">Select Country</option>
                      @foreach ( $countries as $country )
                        <option value="{{$country['slug']}}" {{$country['slug'] == old('origin') ? 'selected' : ''}}>
                          {{ $country['name'] }}
                        </option>
                      @endforeach
                    </select>

                    @if ( $errors->has('origin') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('origin') }}
                      </div>
                    @endif
                  </div>


                  {{--Submit--}}
                  <div class="my-50 submit">
                    <div class="">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </div>

                </form>
              </div>

              {{--Show All Vehicle-Brand--}}
              <div class="col-md-6">
                <div class="full-height-parent mx-md-3 p-20">
                  <div class="h-auto fz-20 fw-bold mb-30 pb-5 bb-1">
                    Brand Lists:
                  </div>

                  <div class="vehicle-brands-list full-height-minus minus-110 overlay-scrollbar">
                    <table class="table table-bordered border-secondary-1 table-hover vehicle-brand-table">
                      <thead class="brand-header text-center">
                        <tr class="brand-row align-middle bb-0">
                          <th scope="col" class="serial bb-0">SL#</th>
                          <th scope="col" class="brand-name bb-0">Name</th>
                          <th scope="col" class="brand-origin bb-0">Origin</th>
                          <th scope="col" class="action text-center bb-0">---</th>
                        </tr>
                      </thead>

                      <tbody class="brand-body">
                        @if ( $brand_all )
                          @foreach ( $brand_all as $index => $brand )
                            <tr class="brand-row align-middle">
                              <td class="serial text-center">{{ $index+1 }}</td>
                              <td class="brand-name">{{ $brand->name }}</td>
                              <td class="brand-origin">{{ ucwords( str_replace('-', ' ', $brand->origin) ) }}</td>
                              <td class="action text-center">
                                <a href="{{ route('vehicle.brand.edit', $brand) }}" 
                                  class="brand-edit btn btn-success fz-20 p-0 px-7 brd-3 ml-5">
                                 <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Brand">
                                   <i class="fa fa-pencil"></i>
                                 </span>
                               </a>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
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