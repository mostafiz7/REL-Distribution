@extends('layouts.app')

{{--@section('title', 'Employee Edit')--}}

@section('site-content')
<div class="Page Employee Edit">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-purple text-white">
          <h5 class="title mb-0">
            <span class="mr-20">Employee</span>
            <span class="edit-mode color-red">Edit-Mode</span>
          </h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="employee-edit-area overlay-scrollbar">
            <form method="post" action="{{ route('employee.single.edit', $employee->uid) }}"
                  name="employeeEditForm" id="employeeEditForm" class="employee-form edit p-20 pb-0">
              @csrf

              <div class="row">
                {{--Employee-Name--}}
                <div class="col-md-6 col-12 mb-30 name">
                  <label for="" class="required w-100 mr-15"><span>Employee Name</span></label>
                  <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" value="{{$employee->name}}" />

                  @if ( $errors->has('name') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>

                {{--Status--}}
                <div class="col-md-6 col-12 mb-30 status">
                  <label for="" class="required w-100 mr-15"><span>Status</span></label>
                  <div class="d-flex flex-wrap">
                    <span class="form-check ml-30">
                      <input type="radio" name="status" id="active" class="status form-check-input cur-pointer @error('status') is-invalid @enderror" value="active" {{ $employee->active ? 'checked' : '' }} />
                      <label for="active" class="form-check-label brd-3 cur-pointer {{ $employee->active ? 'bg-success text-white fw-bold py-1 px-10' : '' }}">Active</label>
                    </span>
                    <span class="form-check ml-30">
                      <input type="radio" name="status" id="not-active" class="status form-check-input cur-pointer @error('status') is-invalid @enderror" value="not-active" {{ $employee->active ? '' : 'checked' }} />
                      <label for="not-active" class="form-check-label brd-3 cur-pointer {{ $employee->active ? '' : 'bg-danger text-white fw-bold py-1 px-10' }}">Not-Active</label>
                    </span>
                  </div>

                  @if ( $errors->has('status') )
                    <div class="text-danger fw-bold" role="alert">
                      {{ $errors->first('status') }}
                    </div>
                  @endif
                </div>

                {{--Nickname--}}
                <div class="col-md-6 col-12 mb-30 nickname">
                  <label for="" class="w-100 mr-15"><span>Nickname</span></label>
                  <input type="text" name="nickname" id="nickname" class="form-control border-secondary brd-3 @error('nickname') is-invalid @enderror" placeholder="Nurullah" value="{{$employee->nickname}}" />

                  @if ( $errors->has('nickname') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('nickname') }}
                    </div>
                  @endif
                </div>

                {{--Employment-Status--}}
                <div class="col-md-6 col-12 mb-30 employment_status">
                  <label for="" class="required w-100 mr-15"><span>Employment Status</span></label>
                  <select name="employment_status" id="employment_status" class="required form-select border-secondary brd-3 @error('employment_status') is-invalid @enderror">
                    <option value="">Select Job Status</option>
                    @foreach ( EmploymentStatus() as $status )
                      <option value="{{$status}}" {{$status == $employee->employment_status ? 'selected' : ''}}>
                        {{ ucwords( str_replace('-', ' ', $status) ) }}
                      </option>
                    @endforeach
                  </select>
                  
                  @if ( $errors->has('employment_status') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('employment_status') }}
                    </div>
                  @endif

                  {{-- <div class="row employment_status">
                    <div class="col-lg-3 col-2 permanent">
                      <div class="form-check">
                        <input type="checkbox" name="employment_status" id="permanent" class="form-check-input border-secondary cur-pointer" value="permanent" />
                        <label class="form-check-label cur-pointer" for="permanent">Permanent</label>
                      </div>
                    </div>

                    <div class="col-lg-3 col-2 probation">
                      <div class="form-check">
                        <input type="checkbox" name="employment_status" id="probation" class="form-check-input border-secondary cur-pointer" value="probation" />
                        <label class="form-check-label cur-pointer" for="probation">Probation</label>
                      </div>
                    </div>

                    <div class="col-lg-3 col-2 daily_basis">
                      <div class="form-check">
                        <input type="checkbox" name="employment_status" id="daily_basis" class="form-check-input border-secondary cur-pointer" value="daily_basis" />
                        <label class="form-check-label cur-pointer" for="daily_basis">Daily Basis</label>
                      </div>
                    </div>

                    <div class="col-lg-3 col-2 casual">
                      <div class="form-check">
                        <input type="checkbox" name="employment_status" id="casual" class="form-check-input border-secondary cur-pointer" value="casual" />
                        <label class="form-check-label cur-pointer" for="casual">Casual</label>
                      </div>
                    </div>
                  </div> --}}
                </div>

                {{--Office-ID--}}
                <div class="col-md-6 col-12 mb-30 office_id">
                  <label for="" class="{{! $employee->employment_status || $employee->employment_status == 'permanent' || ! old('employment_status') || old('employment_status') == 'permanent' ? 'required' : ''}} w-100 mr-15"><span>Office ID</span></label>
                  <input type="text" name="office_id" id="office_id" class="{{! $employee->employment_status || $employee->employment_status == 'permanent' || ! old('employment_status') || old('employment_status') == 'permanent' ? 'required' : ''}} form-control border-secondary brd-3 @error('office_id') is-invalid @enderror" placeholder="010058" value="{{$employee->office_id}}" />

                  @if ( $errors->has('office_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('office_id') }}
                    </div>
                  @endif
                </div>

                {{--Birth-Date--}}
                {{--<div class="col-md-6 col-12 mb-30 birth_date">
                  <label for="" class="w-100 mr-15"><span>Birth Date</span></label>
                  <div class="p-relative date-select">
                    <input type="text" name="birth_date" id="birth_date" class="input-date form-control d-inline-block text-start border-secondary brd-3 z-index-9 @error('birth_date') is-invalid @enderror" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ old('birth_date') }}" />
                    <label for="birth_date" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mt-2 mr-1 px-5 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                  </div>

                  @if ( $errors->has('birth_date') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('birth_date') }}
                    </div>
                  @endif
                </div>--}}

                {{--Department-Name--}}
                <div class="col-md-6 col-12 mb-30 department_id">
                  <label for="" class="required w-100 mr-15"><span>Department</span></label>
                  <select name="department_id" id="department_id" class="required form-select border-secondary brd-3 @error('department_id') is-invalid @enderror">
                    <option value="">Select Department</option>
                    @if ( $department_all )
                      @foreach ( $department_all as $department )
                        <option value="{{$department->id}}" {{$department->id == $employee->department_id ? 'selected' : ''}}>
                          {{ $department->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('department_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('department_id') }}
                    </div>
                  @endif
                </div>

                {{--Designation--}}
                <div class="col-md-6 col-12 mb-30 designation_id">
                  <label for="" class="required w-100 mr-15"><span>Designation</span></label>
                  <select name="designation_id" id="designation_id" class="required form-select border-secondary brd-3 @error('designation_id') is-invalid @enderror">
                    <option value="">Select Designation</option>
                    @if ( $designation_all )
                      @foreach ( $designation_all as $designation )
                        <option value="{{$designation->id}}" {{$designation->id == $employee->designation_id ? 'selected' : ''}}>
                          {{ $designation->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('designation_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('designation_id') }}
                    </div>
                  @endif
                </div>

                {{--Authorize-and-Purchase-Power--}}
                <div class="col-md-6 col-12 mb-30 authorize-and-purchase-power">
                  <label for="" class="fw-bold w-100 mr-15"><span>Assigned Role</span></label>
                  <div class="d-flex flex-column flex-sm-row mt-3 pt-10 bt-1">
                    <div class="form-check me-0 me-sm-4 mb-10 authorize_power">
                      <input type="checkbox" name="authorize_power" id="authorize_power" class="form-check-input border-secondary cur-pointer" value="authorizer" {{$employee->authorize_power ? 'checked' : ''}} />
                      <label class="form-check-label cur-pointer" for="authorize_power">Authorize Power</label>
                    </div>

                    <div class="form-check mb-10 purchase_power">
                      <input type="checkbox" name="purchase_power" id="purchase_power" class="form-check-input border-secondary cur-pointer" value="purchaser" {{$employee->purchase_power ? 'checked' : ''}} />
                      <label class="form-check-label cur-pointer" for="purchase_power">Purchase Power</label>
                    </div>
                  </div>

                  @if ( $errors->has('authorize_power') || $errors->has('purchase_power') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      <div class="{{ $errors->has('authorize_power') ? 'mb-5' : 'd-none' }}">
                        {{ $errors->first('authorize_power') }}
                      </div>
                      <div class="{{ $errors->has('purchase_power') ? '' : 'd-none' }}">
                        {{ $errors->first('purchase_power') }}
                      </div>
                    </div>
                  @endif
                </div>


                {{--Submit--}}
                <div class="col-12 mt-20 mb-50 text-end submit">
                  <div class="">
                    <button class="btn btn-purple">Update</button>
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