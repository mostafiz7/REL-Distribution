<tr class="table-row content align-middle">
  <td class="serial w-30px-min text-center">{{ $index+1 }}</td>
  <td class="vehicle-no">{{ $vehicle->vehicle_no }}</td>
  <td class="vehicle-status text-center">
    @if ( $vehicle->enabled )
      <span class="bg-success text-white py-1 px-5 brd-3">Enabled</span>
    @else
      <span class="bg-danger text-white py-1 px-5 brd-3">Disabled</span>
    @endif
  </td>
  <td class="vehicle-brand">{{ $vehicle->brand->name ?? '- - -' }}</td>
  <td class="vehicle-category">{{ $vehicle->category->name ?? '- - -' }}</td>
  <td class="vehicle-cc">{{ $vehicle->engine_cc ?? '- - -' }}</td>
  <td class="vehicle-origin">
    {{ $vehicle->origin ? ucwords(str_replace('-', ' ', $vehicle->origin)) : '- - -' }}
  </td>
  <td class="vehicle-department">{{ $vehicle->department->short_name ?? '- - -' }}</td>
  <td class="vehicle-driver">{{ $vehicle->driver->name ?? '- - -' }}</td>
  <td class="vehicle-helper">{{ $vehicle->helper->name ?? ($vehicle->helper_name ?? '- - -') }}</td>
  <td class="action text-center">
    <a href="#" 
      {{-- {{ route('vehicle.single.show', $vehicle->uid) }} --}}
      class="parts-single btn btn-primary fz-20 p-0 px-6 brd-3">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show Vehicle Details">
        <i class="fa fa-eye"></i>
      </span>
    </a>

    <a href="{{ route('vehicle.single.edit', $vehicle->uid) }}" 
       class="parts-edit btn btn-success fz-20 p-0 px-7 brd-3 ml-5">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Vehicle">
        <i class="fa fa-pencil"></i>
      </span>
    </a>

    {{--@if ( Auth::user()->can('isAdmins') && Auth::user()->can('entryDelete') )
    
    @endif--}}

    {{-- <a href="{{ route('vehicle.single.delete', $vehicle->uid) }}"
        onclick="return confirm('Are you sure to delete this vehicle?');"
        class="delete-parts btn btn-danger fz-20 p-0 px-7 brd-3 ml-5">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Vehicle">
        <i class="fa fa-trash"></i>
      </span>
    </a> --}}
  </td>
</tr>