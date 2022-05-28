<tr class="table-row content align-middle">
  <td class="serial w-30px-min text-center">{{ $index+1 }}</td>
  <td class="parts-name">{{ $parts->name }}</td>
  <td class="parts-status text-center">
    @if ( $parts->enabled )
      <span class="bg-success text-white py-1 px-5 brd-3">Enabled</span>
    @else
      <span class="bg-danger text-white py-1 px-5 brd-3">Disabled</span>
    @endif
  </td>
  <td class="parts-category">{{ $parts->category->name ?? '- - -' }}</td>
  <td class="parts-origin">
    {{ $parts->origin ? ucwords(str_replace('-', ' ', $parts->origin)) : '- - -' }}
  </td>
  <td class="parts-unit">{{ $parts->unit ? ucwords($parts->unit) : '- - -' }}</td>
  <td class="parts-sizes">{{ $parts->sizes ?? '- - -' }}</td>
  <td class="parts-description">{{ $parts->description ?? '- - -' }}</td>
  <td class="parts-metals">{{ $parts->metals ?? '- - -' }}</td>
  <td class="parts-materials">{{ $parts->materials ?? '- - -' }}</td>
  <td class="action text-center">
    <a href="#" 
      {{-- {{ route('vehicle.parts.single.show', $parts->uid) }} --}}
       class="parts-single btn btn-primary fz-20 p-0 px-6 brd-3">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show Parts Details">
        <i class="fa fa-eye"></i>
      </span>
    </a>

    <a href="{{ route('vehicle.parts.single.edit', $parts->uid) }}" 
       class="parts-edit btn btn-success fz-20 p-0 px-7 brd-3 ml-5">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Parts">
        <i class="fa fa-pencil"></i>
      </span>
    </a>

    {{--@if ( Auth::user()->can('isAdmins') && Auth::user()->can('entryDelete') )
    
    @endif--}}

    {{-- <a href="{{ route('vehicle.parts.single.delete', $parts->uid) }}"
        onclick="return confirm('Are you sure to delete this parts?');"
        class="delete-parts btn btn-danger fz-20 p-0 px-7 brd-3 ml-5">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Parts">
        <i class="fa fa-trash"></i>
      </span>
    </a> --}}
  </td>
</tr>