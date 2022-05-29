@extends('layouts.app')

{{--@section('title', 'Add New Parts')--}}

@section('site-content')
<div class="Page Parts New">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Add New Parts</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="parts-new-area overlay-scrollbar">
            <form method="post" action="{{ route('vehicle.parts.add.new') }}"
                  name="addPartsForm" id="addPartsForm" class="parts-form new p-20 pb-0">
              @csrf

              <div class="row">
                {{--Parts-Name--}}
                <div class="col-md-6 col-12 mb-30 name">
                  <label for="" class="required w-100 mr-15"><span>Parts Name</span></label>
                  <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" placeholder="Radiator" value="{{ old('name') }}" />

                  @if ( $errors->has('name') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>

                {{--Category--}}
                <div class="col-md-6 col-12 mb-30 category_id">
                  <label for="" class="required w-100 mr-15"><span>Category</span></label>
                  <select name="category_id" id="category_id" class="required form-select border-secondary brd-3 @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                    @if ( $category_all )
                      @foreach ( $category_all as $category )
                        <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''}}>
                          {{ $category->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('category_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('category_id') }}
                    </div>
                  @endif
                </div>

                {{--Unit--}}
                <div class="col-md-6 col-12 mb-30 unit">
                  <label for="" class="required w-100 mr-15"><span>Unit</span></label>
                  <select name="unit" id="unit" class="required form-select border-secondary brd-3 @error('unit') is-invalid @enderror">
                    <option value="">Select Unit</option>
                    @if ( $units )
                      @foreach ( $units as $unit )
                        <option value="{{$unit}}" {{$unit == old('unit') ? 'selected' : ''}}>
                          {{ ucwords( str_replace('-', ' ', $unit) ) }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('unit') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('unit') }}
                    </div>
                  @endif
                </div>

                {{--Description--}}
                <div class="col-md-6 col-12 mb-30 description">
                  <label for="" class="w-100 mr-15"><span>Description</span></label>
                  <input type="text" name="description" id="description" class="form-control border-secondary brd-3 @error('description') is-invalid @enderror" value="{{ old('description') }}" />

                  @if ( $errors->has('description') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('description') }}
                    </div>
                  @endif
                </div>

                {{--Sizes--}}
                <div class="col-md-6 col-12 mb-30 sizes">
                  <label for="" class="w-100 mr-15"><span>Sizes</span></label>
                  <input type="text" name="sizes" id="sizes" class="form-control border-secondary brd-3 @error('sizes') is-invalid @enderror" value="{{ old('sizes') }}" />

                  @if ( $errors->has('sizes') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('sizes') }}
                    </div>
                  @endif
                </div>

                {{--Origin-Country--}}
                <div class="col-md-6 col-12 mb-30 origin">
                  <label for="" class="w-100 mr-15"><span>Origin</span></label>
                  <select name="origin" id="origin" class="form-select border-secondary brd-3 @error('origin') is-invalid @enderror">
                    <option value="">Select Country</option>
                    @foreach ( $countries as $country )
                      <option value="{{ $country['slug'] }}" {{ $country['slug'] == old('origin') ? 'selected' : '' }}>
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

                {{--Metals--}}
                <div class="col-md-6 col-12 mb-30 metals">
                  <label for="" class="w-100 mr-15"><span>Metals</span></label>
                  <input type="text" name="metals" id="metals" class="form-control border-secondary brd-3 @error('metals') is-invalid @enderror" value="{{ old('metals') }}" />

                  @if ( $errors->has('metals') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('metals') }}
                    </div>
                  @endif
                </div>

                {{--Materials--}}
                <div class="col-md-6 col-12 mb-30 materials">
                  <label for="" class="w-100 mr-15"><span>Materials</span></label>
                  <input type="text" name="materials" id="materials" class="form-control border-secondary brd-3 @error('materials') is-invalid @enderror" value="{{ old('materials') }}" />

                  @if ( $errors->has('materials') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('materials') }}
                    </div>
                  @endif
                </div>


                {{--Submit--}}
                <div class="col-12 mt-20 mb-50 text-end submit">
                  <div class="">
                    <button class="btn btn-primary">Submit</button>
                  </div>
                </div>

              </div> {{--/.row--}}
            </form>

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