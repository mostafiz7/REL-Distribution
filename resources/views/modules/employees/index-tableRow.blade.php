<tr class="table-row content align-middle">
  <td class="serial w-30px-min text-center">{{ $index+1 }}</td>
  <td class="employee-name">{{ $employee->name }}</td>
  <td class="employee-status text-center">
    @if ( $employee->active )
      <span class="bg-success text-white py-1 px-5 brd-3">Active</span>
    @else
      <span class="bg-danger text-white py-1 px-5 brd-3">Not-Active</span>
    @endif
  </td>
  <td class="employee-office_id">{{ $employee->office_id ?? '- - -' }}</td>
  <td class="employee-department">{{ $employee->department->short_name ?? '- - -' }}</td>
  <td class="employee-designation">{{ $employee->designation->short_name ?? '- - -' }}</td>
  <td class="employee-employment">
    {{ $employee->employment_status ? ucwords( str_replace('-', ' ', $employee->employment_status) ) : '- - -' }}
  </td>
  <td class="employee-assigned_role">
    <span class="authorize_power d-block">
      <span class="fz-18 lh-1 {{ $employee->authorize_power ? 'text-primary' : 'text-secondary-3' }}">
        <i class="fa fa-check-circle"></i>
      </span>
      <span class="ml-5 {{ $employee->authorize_power ? '' : 'text-secondary-3 text-decoration-line-through' }}">Authorizer</span>
    </span>
    <span class="purchase_power d-block mt-5">
      <span class="fz-18 lh-1 {{ $employee->purchase_power ? 'text-primary' : 'text-secondary-3' }}">
        <i class="fa fa-check-circle"></i>
      </span>
      <span class="ml-5 {{ $employee->purchase_power ? '' : 'text-secondary-3 text-decoration-line-through' }}">Purchaser</span>
    </span>
  </td>
  <td class="action text-center">
    <a href="#" 
      {{-- {{ route('employee.single.show', $employee->uid) }} --}}
      class="employee-single-show btn btn-primary fz-20 p-0 px-6 brd-3">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show Employee Details">
        <i class="fa fa-eye"></i>
      </span>
    </a>

    <a href="{{ route('employee.single.edit', $employee->uid) }}" 
       class="employee-edit btn btn-success fz-20 p-0 px-7 brd-3 ml-5">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Employee">
        <i class="fa fa-pencil"></i>
      </span>
    </a>

    {{--@if ( Auth::user()->can('isAdmins') && Auth::user()->can('entryDelete') )
    
    @endif--}}

    {{-- <a href="{{ route('employee.single.delete', $employee->uid) }}"
        onclick="return confirm('Are you sure to delete this employee?');"
        class="delete-employee btn btn-danger fz-20 p-0 px-7 brd-3 ml-5">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Employee">
        <i class="fa fa-trash"></i>
      </span>
    </a> --}}
  </td>
</tr>