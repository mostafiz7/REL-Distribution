<tr class="entity-row align-middle {{ ($index+1) % 2 == 0 ? '' : 'bg-success-light color-black' }}">
  <td class="serial text-center">
    {{ $serial }}
  </td>

  <td class="entity-name">
    {{ $entity->name }}
  </td>

  <td class="entity-status text-center">
    <span class="{{ $entity->active ? 'bg-success' : 'bg-danger' }} text-white fz-14 fw-500 lh-1-6 py-2 px-8 brd-3">
      {{ $entity->active ? 'Active' : 'Not-Active' }}
    </span>
  </td>

  <td class="entity-address">
    @if ( $entity->address )
      {{ $entity->address }}
    @else
      <span class="d-block text-center">- - -</span>
    @endif
  </td>

  <td class="entity-type">
    {{ ucwords( str_replace('-', ' ', $entity->type) ) }}
  </td>

  <td class="entity-cat">
    {{ ucwords( str_replace('-', ' ', $entity->category) ) }}
  </td>

  <td class="entity-owner">
    {{ ucwords( str_replace('-', ' ', $entity->ownership) ) }}
  </td>

  <td class="entity-email">
    {{ $entity->email }}
  </td>

  <td class="entity-incharge">
    @if ( $entity->incharge->name )
      {{ $entity->incharge->name }}
    @else
      <span class="d-block text-center">- - -</span>
    @endif
  </td>

  <td class="entity-contact">
    {{ $entity->phone_primary ?? '' }}
    @if ( $entity->phone_secondary )
      @if ( $entity->phone_primary ) <br> @endif
        {{ $entity->phone_secondary }}
    @endif
    @if ( ! $entity->phone_primary && ! $entity->phone_secondary )
      <span class="d-block text-center">- - -</span>
    @endif
  </td>

  <td class="actions text-center">
    <a href="{{ route('entity.single.show', $entity->uid) }}"
      class="show-single-entity btn btn-primary fz-14 fw-500 py-3 px-10 brd-3">View</a>

    @if ( Auth::user()->can('isSuperAdmin') && Auth::user()->can('entryEdit') )
      <a href="{{ route('entity.single.edit', $entity->uid) }}"
        class="edit-entity btn btn-success fz-14 fw-500 py-3 px-10 brd-3 ms-1">Edit</a>
    @endif
  </td>
</tr>
  