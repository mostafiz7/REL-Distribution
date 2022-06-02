@extends('layouts.app')

{{--@section('title', 'Add New Department')--}}

@section('site-content')
<div class="Page Departments New">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Departments</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="departments-new-area">
            <div class="row">
              <div class="col-md-6">
                <form method="post" action="{{ route('department.add.new') }}"
                      name="addDepartmentForm" id="addDepartmentForm" class="department-form new mx-md-3 p-20 pb-0">
                  @csrf

                  <div class="fz-20 fw-bold mb-30 pb-5 bb-1">
                    Add New Department:
                  </div>

                  {{--Department-Name--}}
                  <div class="mb-30 name">
                    <label for="" class="required w-100 mr-15"><span>Department Name</span></label>
                    <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" placeholder="Marketing" value="{{ old('name') }}" />

                    @if ( $errors->has('name') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('name') }}
                      </div>
                    @endif
                  </div>

                  {{--Short-Name--}}
                  <div class="mb-30 short_name">
                    <label for="" class="required w-100 mr-15"><span>Short Name</span></label>
                    <input type="text" name="short_name" id="short_name" class="required form-control border-secondary brd-3 @error('short_name') is-invalid @enderror" placeholder="MKT for Marketing" value="{{ old('short_name') }}" />

                    @if ( $errors->has('short_name') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('short_name') }}
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

              {{--Show All Departments--}}
              <div class="col-md-6">
                <div class="full-height-parent mx-md-3 p-20">
                  <div class="h-auto fz-20 fw-bold mb-30 pb-5 bb-1">
                    Department Lists:
                  </div>

                  <div class="departments-list overlay-scrollbar full-height-minus minus-110">
                    <table class="table table-bordered border-secondary-1 table-hover department-table">
                      <thead class="department-header text-center">
                        <tr class="department-row align-middle bb-0">
                          <th scope="col" class="serial bb-0">SL#</th>
                          <th scope="col" class="department-name bb-0">Name</th>
                          <th scope="col" class="department-origin bb-0">Short-Name</th>
                          <th scope="col" class="action text-center bb-0">---</th>
                        </tr>
                      </thead>

                      <tbody class="department-body">
                        @if ( $department_all )
                          @foreach ( $department_all as $index => $department )
                            <tr class="department-row align-middle">
                              <td class="serial text-center">{{ $index+1 }}</td>
                              <td class="department-name">{{ $department->name }}</td>
                              <td class="department-short_name">{{ $department->short_name }}</td>
                              <td class="action text-center">
                                <a href="{{ route('department.single.edit', $department) }}" 
                                  class="department-edit btn btn-success fz-20 p-0 px-7 brd-3 ml-5">
                                  <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Department">
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