@extends('layouts.app')

{{--@section('title', 'Add New Entity')--}}

@section('site-content')
<div class="Page Entity New">
  <div class="">
    <div class="page-content p-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="card-title title lh-1-5 my-0">Add New Entity</h5>

          <div class="">
            <a href="{{ route('entity.all.index') }}" class="btn btn-light btn-sm fw-bold">
              Entity Index
            </a>
          </div>
        </div>


        <div class="card-body page-body full-height-prev-auto pt-20">
          <div class="entity-new-area overlay-scrollbar">
            <form method="post" action="{{ route('entity.new.store') }}" {{-- enctype="multipart/form-data" --}} name="entityAddForm" id="entityAddForm" class="row entity-form new">
              @csrf

              {{-- Entity-Name --}}
              <div class="col-md-6 col-12 mb-30 name">
                <label for="name" class="required w-100 mr-15">
                  <span>Entity Name</span>
                </label>

                <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" placeholder="Entity name" value="{{ old('name') }}" />

                @if ( $errors->has('name') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('name') }}
                  </div>
                @endif
              </div>

              {{--Status--}}
              <div class="col-md-6 col-12 mb-30 entity-status">
                <label for="" class="required w-100 mr-15 fw-bold">
                  <span>Status</span>
                </label>

                <div class="d-flex pl-50">
                  <span class="form-check mr-50">
                    <input type="radio" name="active" id="active" class="status form-check-input cur-pointer @error('active') is-invalid @enderror" value="active" />

                    <label for="active" class="form-check-label brd-3 cur-pointer">
                      Active
                    </label>
                    {{-- {{ $user->active ? 'bg-success text-white fw-bold py-1 px-10' : '' }} --}}
                  </span>

                  <span class="form-check">
                    <input type="radio" name="active" id="not-active" class="status form-check-input cur-pointer @error('active') is-invalid @enderror" value="not-active" checked />
                    
                    <label for="not-active" class="form-check-label brd-3 cur-pointer bg-danger text-white fw-bold py-1 px-10">
                      Not-Active
                    </label>
                  </span>
                </div>

                @if ( $errors->has('active') )
                  <div class="text-danger fw-bold" role="alert">
                    {{ $errors->first('active') }}
                  </div>
                @endif
              </div>

              {{-- Report-Priority-for-serialize-data --}}
              <div class="col-md-6 col-12 mb-30 priority">
                <label for="priority" class="w-100 mr-15">
                  <span>Report Priority</span>
                </label>

                <input type="number" step="1" min="1" name="priority" id="priority" class="form-control border-secondary brd-3 @error('priority') is-invalid @enderror" placeholder="Entity serialize in report" value="{{ old('priority') }}" />

                @if ( $errors->has('priority') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('priority') }}
                  </div>
                @endif
              </div>

              {{-- Entity-Email --}}
              <div class="col-md-6 col-12 mb-30 email">
                <label for="email" class="w-100 mr-15">
                  <span>Entity Email</span>
                </label>

                <input type="email" name="email" id="email" class="form-control border-secondary brd-3 @error('email') is-invalid @enderror" placeholder="entity-name@example.com" value="{{ old('email') }}" />

                @if ( $errors->has('email') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('email') }}
                  </div>
                @endif
              </div>
              
              {{-- Primary-Phone --}}
              <div class="col-md-6 col-12 mb-30 phone_primary">
                <label for="phone_primary" class="w-100 mr-15">
                  <span>Primary Phone</span>
                </label>

                <input type="text" name="phone_primary" id="phone_primary" class="form-control border-secondary brd-3 @error('phone_primary') is-invalid @enderror" placeholder="01799268853" value="{{ old('phone_primary') }}" />

                @if ( $errors->has('phone_primary') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('phone_primary') }}
                  </div>
                @endif
              </div>

              {{-- Secondary-Phone --}}
              <div class="col-md-6 col-12 mb-30 phone_secondary">
                <label for="phone_secondary" class="w-100 mr-15">
                  <span>Secondary Phone</span>
                </label>

                <input type="text" name="phone_secondary" id="phone_secondary" class="form-control border-secondary brd-3 @error('phone_secondary') is-invalid @enderror" placeholder="01799268853" value="{{ old('phone_secondary') }}" />

                @if ( $errors->has('phone_secondary') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('phone_secondary') }}
                  </div>
                @endif
              </div>

              {{-- Opening-Date --}}
              <div class="col-md-6 col-12 mb-30 open_date">
                <label for="open_date" class="w-100 mr-15">
                  <span>Opening Date</span>
                </label>

                <div class="p-relative date-select">
                  <input type="text" name="open_date" id="open_date" class="input-date form-control d-inline-block text-start border-secondary brd-3 z-index-9 @error('open_date') is-invalid @enderror" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ old('open_date') }}" />

                  <label for="open_date" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 lh-1-3 p-5 pr-10 cur-pointer z-index-11">
                    <i class="fa fa-calendar"></i>
                  </label>
                </div>

                @if ( $errors->has('open_date') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('open_date') }}
                  </div>
                @endif
              </div>

              {{-- Close-Date --}}
              <div class="col-md-6 col-12 mb-30 close_date">
                <label for="close_date" class="w-100 mr-15 cur-not-allowed">
                  <span>Close Date</span>
                </label>

                <div class="p-relative date-select">
                  <input type="text" disabled name="close_date" id="close_date" class="input-date form-control d-inline-block text-start border-secondary brd-3 z-index-9 cur-not-allowed @error('close_date') is-invalid @enderror" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ old('close_date') }}" />

                  <label for="close_date" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 lh-1-3 p-5 pr-10 cur-not-allowed z-index-11">
                    <i class="fa fa-calendar"></i>
                  </label>
                </div>

                @if ( $errors->has('close_date') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('close_date') }}
                  </div>
                @endif
              </div>

              {{-- Territory --}}
              <div class="col-md-6 col-12 mb-30 territory_id">
                <label for="territory_id" class="w-100 mr-15">
                  <span>Territory</span>
                </label>

                <select name="territory_id" id="territory_id" class="form-select border-secondary brd-3 @error('territory_id') is-invalid @enderror">
                  <option value="">Select Territory Area</option>

                  @if ( $territory_all )
                    @foreach ( $territory_all as $territory )
                      <option value="{{$territory->id}}" {{$territory->id == old('territory_id') ? 'selected' : ''}}>
                        {{ $territory->name }}
                      </option>
                    @endforeach
                  @endif
                </select>
                
                @if ( $errors->has('territory_id') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('territory_id') }}
                  </div>
                @endif
              </div>

              {{-- Parent-Entity --}}
              <div class="col-md-6 col-12 mb-30 parent_id">
                <label for="parent_id" class="w-100 mr-15">
                  <span>Parent / Belongs To</span>
                </label>

                <select name="parent_id" id="parent_id" class="form-select border-secondary brd-3 @error('parent_id') is-invalid @enderror">
                  <option value="">Select Parent Entity</option>

                  @if ( $parents_all )
                    @foreach ( $parents_all as $parent )
                      <option value="{{$parent->id}}" {{$parent->id == old('parent_id') ? 'selected' : ''}}>
                        {{ $parent->name }}
                      </option>
                    @endforeach
                  @endif
                </select>
                
                @if ( $errors->has('parent_id') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('parent_id') }}
                  </div>
                @endif
              </div>

              {{-- Incharge --}}
              <div class="col-md-6 col-12 mb-30 incharge_id">
                <label for="incharge_id" class="w-100 mr-15 cur-not-allowed">
                  <span>Incharge</span>
                </label>

                <select disabled name="incharge_id" id="incharge_id" class="form-select border-secondary brd-3 cur-not-allowed @error('incharge_id') is-invalid @enderror">
                  <option value="">Select Entity Incharge</option>

                  @if ( $employee_all )
                    @foreach ( $employee_all as $employee )
                      <option value="{{$employee->id}}" {{$employee->id == old('incharge_id') ? 'selected' : ''}}>
                        {{ $employee->name }}
                      </option>
                    @endforeach
                  @endif
                </select>
                
                @if ( $errors->has('incharge_id') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('incharge_id') }}
                  </div>
                @endif
              </div>

              {{-- Category --}}
              <div class="col-md-6 col-12 mb-30 category">
                <label for="category" class="required w-100 mr-15">
                  <span>Category</span>
                </label>

                <select name="category" id="category" class="required form-select border-secondary brd-3 @error('category') is-invalid @enderror">
                  <option value="">Entity Category</option>

                  @if ( $category_all )
                    @foreach ( $category_all as $category )
                      <option value="{{$category}}" {{$category == old('category') ? 'selected' : ''}}>
                        {{ ucwords( str_replace('-', ' ', $category) ) }}
                      </option>
                    @endforeach
                  @endif
                </select>
                
                @if ( $errors->has('category') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('category') }}
                  </div>
                @endif
              </div>

              {{-- Type --}}
              <div class="col-md-6 col-12 mb-30 type">
                <label for="type" class="required w-100 mr-15">
                  <span>Entity Type</span>
                </label>

                <select name="type" id="type" class="required form-select border-secondary brd-3 @error('type') is-invalid @enderror">
                  <option value="">Select Entity Type</option>

                  @if ( $entity_types )
                    @foreach ( $entity_types as $type )
                      <option value="{{$type}}" {{$type == old('type') ? 'selected' : ''}}>
                        {{ ucwords( str_replace('-', ' ', $type) ) }}
                      </option>
                    @endforeach
                  @endif
                </select>
                
                @if ( $errors->has('type') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('type') }}
                  </div>
                @endif
              </div>

              {{-- Ownership --}}
              <div class="col-md-6 col-12 mb-30 ownership">
                <label for="ownership" class="required w-100 mr-15">
                  <span>Ownership</span>
                </label>

                <select name="ownership" id="ownership" class="required form-select border-secondary brd-3 @error('ownership') is-invalid @enderror">
                  <option value="">Entity Ownership</option>

                  @if ( $ownership_all )
                    @foreach ( $ownership_all as $owner )
                      <option value="{{$owner}}" {{$owner == old('ownership') ? 'selected' : ''}}>
                        {{ ucwords( str_replace('-', ' ', $owner) ) }}
                      </option>
                    @endforeach
                  @endif
                </select>
                
                @if ( $errors->has('ownership') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('ownership') }}
                  </div>
                @endif
              </div>

              {{-- Selling-Power --}}
              <div class="col-md-6 col-12 mb-30 selling_power">
                <label for="selling_power" class="w-100 mr-15">
                  <span>Selling Power</span>
                </label>

                <select name="selling_power" id="selling_power" class="form-select border-secondary brd-3 @error('selling_power') is-invalid @enderror">
                  <option value=""></option>

                  <option value="enabled" {{ old('selling_power') == 'enabled' ? 'selected' : '' }}>
                    {{ 'Enabled' }}
                  </option>

                  <option value="disabled" {{ old('selling_power') == 'disabled' ? 'selected' : '' }}>
                    {{ 'Disabled' }}
                  </option>
                </select>
                
                @if ( $errors->has('selling_power') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('selling_power') }}
                  </div>
                @endif
              </div>

              {{-- Show-Sales-Report --}}
              <div class="col-md-6 col-12 mb-30 show_sls_report">
                <label for="show_sls_report" class="w-100 mr-15">
                  <span>Show in Sales Report ?</span>
                </label>

                <select name="show_sls_report" id="show_sls_report" class="form-select border-secondary brd-3 @error('show_sls_report') is-invalid @enderror">
                  <option value=""></option>
                  
                  <option value="enabled" {{ old('show_sls_report') == 'enabled' ? 'selected' : '' }}>
                    {{ 'Enabled' }}
                  </option>

                  <option value="disabled" {{ old('show_sls_report') == 'disabled' ? 'selected' : '' }}>
                    {{ 'Disabled' }}
                  </option>
                </select>
                
                @if ( $errors->has('show_sls_report') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('show_sls_report') }}
                  </div>
                @endif
              </div>

              {{-- Show-Stock-Report --}}
              <div class="col-md-6 col-12 mb-30 show_stock_report">
                <label for="show_stock_report" class="w-100 mr-15">
                  <span>Show in Stock Report ?</span>
                </label>

                <select name="show_stock_report" id="show_stock_report" class="form-select border-secondary brd-3 @error('show_stock_report') is-invalid @enderror">
                  <option value=""></option>
                  
                  <option value="enabled" {{ old('show_stock_report') == 'enabled' ? 'selected' : '' }}>
                    {{ 'Enabled' }}
                  </option>

                  <option value="disabled" {{ old('show_stock_report') == 'disabled' ? 'selected' : '' }}>
                    {{ 'Disabled' }}
                  </option>
                </select>
                
                @if ( $errors->has('show_stock_report') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('show_stock_report') }}
                  </div>
                @endif
              </div>

              {{-- Location --}}
              <div class="col-md-6 col-12 mb-30 location">
                <label for="location" class="w-100 mr-15">
                  <span>Location</span>
                </label>

                <input type="text" name="location" id="location" class="form-control border-secondary brd-3 @error('location') is-invalid @enderror" placeholder="" value="{{ old('location') }}" />

                @if ( $errors->has('location') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('location') }}
                  </div>
                @endif
              </div>

              {{-- Latitude --}}
              <div class="col-md-6 col-12 mb-30 lat">
                <label for="lat" class="w-100 mr-15">
                  <span>Latitude</span>
                </label>

                <input type="text" name="lat" id="lat" class="form-control border-secondary brd-3 @error('lat') is-invalid @enderror" placeholder="Latitude" value="{{ old('lat') }}" />

                @if ( $errors->has('lat') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('lat') }}
                  </div>
                @endif
              </div>

              {{-- Longitude --}}
              <div class="col-md-6 col-12 mb-30 long">
                <label for="long" class="w-100 mr-15">
                  <span>Longitude</span>
                </label>

                <input type="text" name="long" id="long" class="form-control border-secondary brd-3 @error('long') is-invalid @enderror" placeholder="Longitude" value="{{ old('long') }}" />

                @if ( $errors->has('long') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('long') }}
                  </div>
                @endif
              </div>

              {{-- Address --}}
              <div class="col-md-6 col-12 mb-30 address">
                <label for="address" class="w-100 mr-15">
                  <span>Address</span>
                </label>

                <input type="text" name="address" id="address" class="form-control border-secondary brd-3 @error('address') is-invalid @enderror" placeholder="" value="{{ old('address') }}" />

                @if ( $errors->has('address') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('address') }}
                  </div>
                @endif
              </div>

              {{-- City --}}
              <div class="col-md-6 col-12 mb-30 city">
                <label for="city" class="w-100 mr-15">
                  <span>City</span>
                </label>

                <input type="text" name="city" id="city" class="form-control border-secondary brd-3 @error('city') is-invalid @enderror" placeholder="" value="{{ old('city') }}" />

                @if ( $errors->has('city') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('city') }}
                  </div>
                @endif
              </div>

              {{-- Police-Station --}}
              <div class="col-md-6 col-12 mb-30 police_station">
                <label for="police_station" class="w-100 mr-15">
                  <span>Police Station</span>
                </label>

                <input type="text" name="police_station" id="police_station" class="form-control border-secondary brd-3 @error('police_station') is-invalid @enderror" placeholder="" value="{{ old('police_station') }}" />

                @if ( $errors->has('police_station') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('police_station') }}
                  </div>
                @endif
              </div>

              {{-- Postcode --}}
              <div class="col-md-6 col-12 mb-30 postcode">
                <label for="postcode" class="w-100 mr-15">
                  <span>Postcode</span>
                </label>

                <input type="text" name="postcode" id="postcode" class="form-control border-secondary brd-3 @error('postcode') is-invalid @enderror" placeholder="" value="{{ old('postcode') }}" />

                @if ( $errors->has('postcode') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('postcode') }}
                  </div>
                @endif
              </div>

              {{-- District --}}
              <div class="col-md-6 col-12 mb-30 district">
                <label for="district" class="w-100 mr-15">
                  <span>District</span>
                </label>

                <input type="text" name="district" id="district" class="form-control border-secondary brd-3 @error('district') is-invalid @enderror" placeholder="" value="{{ old('district') }}" />

                @if ( $errors->has('district') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('district') }}
                  </div>
                @endif
              </div>

              <div class="col-12">
                <div class="info bg-warning fz-16 fw-bold py-10 px-15 mb-20">
                  Fill-up below information if entity ownership is other than own management / administration.
                </div>
              </div>

              {{-- Owner-Name --}}
              <div class="col-md-6 col-12 mb-30 owner_name">
                <label for="owner_name" class="w-100 mr-15">
                  <span>Owner Name</span>
                </label>

                <input type="text" name="owner_name" id="owner_name" class="form-control border-secondary brd-3 @error('owner_name') is-invalid @enderror" placeholder="" value="{{ old('owner_name') }}" />

                @if ( $errors->has('owner_name') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('owner_name') }}
                  </div>
                @endif
              </div>

              {{-- Owner-Contact --}}
              <div class="col-md-6 col-12 mb-30 owner_contact">
                <label for="owner_contact" class="w-100 mr-15">
                  <span>Owner Contact</span>
                </label>

                <input type="text" name="owner_contact" id="owner_contact" class="form-control border-secondary brd-3 @error('owner_contact') is-invalid @enderror" placeholder="" value="{{ old('owner_contact') }}" />

                @if ( $errors->has('owner_contact') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('owner_contact') }}
                  </div>
                @endif
              </div>

              {{-- Owner-Email --}}
              <div class="col-md-6 col-12 mb-30 owner_email">
                <label for="owner_email" class="w-100 mr-15">
                  <span>Owner Email</span>
                </label>

                <input type="email" name="owner_email" id="owner_email" class="form-control border-secondary brd-3 @error('owner_email') is-invalid @enderror" placeholder="" value="{{ old('owner_email') }}" />

                @if ( $errors->has('owner_email') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('owner_email') }}
                  </div>
                @endif
              </div>

              {{-- Owner-Address --}}
              <div class="col-md-6 col-12 mb-30 owner_address">
                <label for="owner_address" class="w-100 mr-15">
                  <span>Owner Address</span>
                </label>

                <input type="text" name="owner_address" id="owner_address" class="form-control border-secondary brd-3 @error('owner_address') is-invalid @enderror" placeholder="" value="{{ old('owner_address') }}" />

                @if ( $errors->has('owner_address') )
                  <div class="text-danger fz-14 fw-bold" role="alert">
                    {{ $errors->first('owner_address') }}
                  </div>
                @endif
              </div>

              
              {{--Submit--}}
              <div class="col-12 mt-20 mb-50 text-center submit">
                <div class="">
                  <button class="btn btn-primary">
                    Save Entity
                  </button>
                </div>
              </div>
              
            </form> {{--/.row--}}
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



  // Office-ID required based on Employment-Status
  ChangeEmploymentStatus();
  function ChangeEmploymentStatus(){
    $('#employment_status').change(function(){
      let status = $(this).find(':selected').val();
      let office_id = $('#office_id');

      if( status === 'permanent' || status === "" ){
        if( ! $(office_id).hasClass('required') ){
          $(office_id).addClass('required');
        }
        if( ! $(office_id).closest('DIV').find('LABEL').hasClass('required') ){
          $(office_id).closest('DIV').find('LABEL').addClass('required');
        }
      } else{
        if( $(office_id).hasClass('required') ){
          $(office_id).removeClass('required');
        }
        if( $(office_id).closest('DIV').find('LABEL').hasClass('required') ){
          $(office_id).closest('DIV').find('LABEL').removeClass('required');
        }
      }
    });
  }
  

</script>
@endsection