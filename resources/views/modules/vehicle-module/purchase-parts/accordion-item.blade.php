<div class="accordion-item border-secondary-2" id="item_{{$index+1}}"
  data-id="{{$purchase_item->id}}" data-uid="{{$purchase_item->uid}}" 
  data-purchase_no="{{$purchase_item->purchase_no}}">
  <h2 class="accordion-header p-relative" id="accordionHeading_{{$index+1}}">
    <button class="accordion-button fw-bold p-15 {{$loop->last ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#accordionCollapse_{{$index+1}}" aria-expanded="{{$loop->last ? 'true' : 'false'}}" aria-controls="accordionCollapse_{{$index+1}}">
      Item #<span class="item-count">{{$index+1}}</span>
    </button>
    <span onclick="RemoveAccordionItem(this);"
          class="remove-accordion-item d-none before-shadow p-absolute pos-top-right w-30px h-30px bg-danger text-white fz-20 text-center lh-1-5 mt-10 mr-50 brd-50 cur-pointer z-index-11">
    <i class="fa fa-close"></i>
  </span>
  </h2>

  <input type="hidden" name="previousItem_id[]" value="{{$purchase_item->id}}" />
  <input type="hidden" name="previousItem_uid[]" value="{{$purchase_item->uid}}" />

  <div id="accordionCollapse_{{$index+1}}" class="accordion-collapse collapse {{$loop->last ? 'show' : ''}}" aria-labelledby="accordionHeading_{{$index+1}}" data-bs-parent="#Accordion-Parent">
    <div class="accordion-body px-15 pb-5">
      <div class="row gx-0 gx-sm-2 p-relative">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-name">
          <input type="text" name="item_name[]" id="item_name-{{$index+1}}" class="item_name form-control border-secondary brd-3" autocomplete="off" placeholder="Item Name" value="{{$purchase_item->parts->name}}" />
          <input type="hidden" name="item_id[]" id="item_id-{{$index+1}}" class="item_id" value="{{$purchase_item->parts->id}}" />
          <input type="hidden" name="item_uid[]" id="item_uid-{{$index+1}}" class="item_uid" value="{{$purchase_item->parts->uid}}" />
          <input type="hidden" name="item_slug[]" id="item_slug-{{$index+1}}" class="item_slug" value="{{$purchase_item->parts->slug}}" />
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 size-and-origin">
          <div class="row g-2">
            <div class="col-sm-6 col-12 mb-15 item-origin">
              <select name="item_country[]" id="item_country-{{$index+1}}" class="item_country form-select border-secondary brd-3">
                <option value="">- - -</option>
                @foreach ( $countries as $country )
                  <option value="{{ $country['slug'] }}" {{ $purchase_item->origin == $country['slug'] ? 'selected' : '' }}>
                    {{ $country['name'] }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-sm-6 col-12 mb-15 item-size">
              <input type="text" name="item_size[]" id="item_size-{{$index+1}}" class="item_size form-control border-secondary brd-3" placeholder="Size" value="{{$purchase_item->size}}" />
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-serials">
          <input type="text" name="item_serials[]" id="item_serials-{{$index+1}}" class="item_serials form-control border-secondary brd-3" placeholder="Serials" value="{{$purchase_item->serials}}" />
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-qty">
          <input type="number" min="0" name="item_qty[]" id="item_qty-{{$index+1}}" class="item_qty form-control border-secondary brd-3" placeholder="Quantity" value="{{$purchase_item->quantity}}" />
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit">
          <select name="item_unit[]" id="item_unit-{{$index+1}}" class="item_unit form-select border-secondary brd-3">
            @foreach ( $units as $unit )
              <option value="{{$unit}}" {{$unit == $purchase_item->unit ? 'selected' : ''}}>
                {{ ucwords($unit) }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit-price">
          <input type="number" min="0" step="0.10" name="item_unit_price[]" id="item_unit_price-{{$index+1}}" class="item_unit_price form-control border-secondary brd-3" placeholder="Unit Price" value="{{$purchase_item->unit_price}}" />
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-amount">
          <input type="number" min="0" name="item_amount[]" id="item_amount-{{$index+1}}" class="item_amount form-control border-secondary brd-3" placeholder="Item Amount" value="{{(int)$purchase_item->amount}}" />
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-remarks">
          <input type="text" name="item_remarks[]" id="item_remarks-{{$index+1}}" class="item_remarks form-control border-secondary brd-3" placeholder="Remarks" value="{{$purchase_item->remarks}}" />
        </div>
      </div>
    </div>
  </div>
</div>
