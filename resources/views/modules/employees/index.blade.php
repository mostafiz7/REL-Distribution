@extends( 'layouts.app' )

{{--@section( 'title', 'View All Employee' )--}}

@section( 'content' )
<div class="Page Employee Index">
  <div class="container-fluid">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Employee Index</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="employee-all-area full-height-parent">
            {{--Employee-Search-Block--}}
            <div class="employee-search h-auto fz-14 p-15 pt-10 pb-5">
              <form method="GET" action="{{ route('employee.all.show') }}"
                    name="employeeSearchForm" id="employeeSearchForm" class="employee-search-form">

                <div class="row">
                  {{--Search-By--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 search_by">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Search By</span></label>
                      <input type="text" name="search_by" id="search_by" class="form-control d-inline-block fz-14 lh-1-8 border-secondary-1 brd-3" placeholder="Employee Name/ Office-ID" value="{{ $search_by ?? '' }}" />
                    </div>
                  </div>
                  
                  {{--Department--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 department_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Department</span></label>
                      <select name="department_id" id="department_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $department_all )
                          <option value="all">All</option>
                          @foreach ( $department_all as $department )
                            <option value="{{$department->id}}" {{ $department->id == $department_id ? 'selected' : '' }}>
                              {{ $department->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Designation--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 designation_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Designation</span></label>
                      <select name="designation_id" id="designation_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $designation_all )
                          <option value="all">All</option>
                          @foreach ( $designation_all as $designation )
                            <option value="{{$designation->id}}" {{ $designation->id == $designation_id ? 'selected' : '' }}>
                              {{ $designation->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Assigned-Role--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 assigned_role">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Assigned Role</span></label>
                      <select name="assigned_role" id="assigned_role" class="form-select d-inline-block border-secondary-1 brd-3">
                        <option value="all">All</option>
                        <option value="authorize_power" {{ $assigned_role == 'authorize_power' ? 'selected' : '' }}>Authorize Power</option>
                        <option value="purchase_power" {{ $assigned_role == 'purchase_power' ? 'selected' : '' }}>Purchase Power</option>
                      </select>
                    </div>
                  </div>
                  
                  {{--Employment-Status--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 employment_status">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Employment</span></label>
                      <select name="employment_status" id="employment_status" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $employment_statuses )
                          <option value="all">All</option>
                          @foreach ( $employment_statuses as $employment )
                            <option value="{{ $employment }}" {{ $employment == $employment_status ? 'selected' : '' }}>
                              {{ ucwords( str_replace('-', ' ', $employment) ) }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{--Status--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 status">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Status</span></label>
                      <select name="status" id="status" class="form-select d-inline-block border-secondary-1 brd-3">
                        <option value="all">All</option>
                        <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="not-active" {{ $status == 'not-active' ? 'selected' : '' }}>Not-Active</option>
                      </select>
                    </div>
                  </div>

                  {{--Action-Buttons--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 action-btns">
                    <div class="w-100 text-center">
                      <button class="btn btn-primary btn-sm fz-14 fw-bold lh-1-4 py-5 px-10">Search</button>

                      <input type="reset" value="Clear" id="clearEmployeeSearchForm" class="btn btn-secondary btn-sm bg-secondary fz-14 fw-bold lh-1-4 py-5 px-10 ml-5" />

                      <a href="{{ route('employee.all.show') }}" class="btn btn-dark btn-sm fz-14 fw-bold lh-1-4 py-5 px-10 ml-5">Refresh</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="blank h-auto bt-1 border-secondary-1"></div>

            <div class="employee-all-details overlay-scrollbar full-height-minus minus-120 p-10">
              <table class="table table-bordered table-hover border-secondary-3 employee-all-table">
                <thead class="table-header bg-dark text-white fz-14 text-center">
                  <tr class="table-row header align-middle">
                    <th scope="col" class="serial w-30px-min">S/L</th>
                    <th scope="col" class="employee-name">Employee Name</th>
                    <th scope="col" class="employee-status">Status</th>
                    <th scope="col" class="employee-office_id">Office-ID</th>
                    <th scope="col" class="employee-department">Department</th>
                    <th scope="col" class="employee-designation">Designation</th>
                    <th scope="col" class="employee-employment">Employment</th>
                    <th scope="col" class="employee-assigned_role">Assigned Role</th>
                    <th scope="col" class="action">---</th>
                  </tr>
                </thead>

                <tbody class="table-body fz-12 align-middle">
                  @if ( $employee_all && count($employee_all) > 0 )
                    @foreach ( $employee_all as $index => $employee )
                      @include('modules.employees.index-tableRow', $employee)
                    @endforeach
                  @else
                    <tr class="table-row content no-employee align-middle">
                      <td colspan="11" class="error text-danger fz-22 fw-bold text-center py-100">Sorry! Currently there are no employee available.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
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
