@extends('layouts.app')

{{--@section('title', 'Edit Vehicle-Parts Purchase')--}}

@section('site-content')
<div class="Page Vehicle-Parts-Purchase Edit">
  <div class="container-fluid">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-purple text-white">
          <h5 class="title mb-0">
            <span class="mr-20">Parts-Purchase</span>
            <span class="edit-mode color-red">Edit-Mode</span>
          </h5>
        </div>
        

        <div class="card-body page-body p-0">
          <div class="edit-parts-purchase-area overlay-scrollbar">
            <form method="post" action="{{ route('vehicle.parts.purchase.edit', $purchase) }}"
                  name="partsPurchaseForm" id="partsPurchaseForm" class="parts-purchase edit p-20 pb-0">
              @csrf
              {{--@method('PUT')--}}

              <div class="form-top-and-center">
                <div class="form-top">
                  <div class="row mb-sm-3">

                    {{--Purchase-Number-&-Type--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 purchase-no-date">
                      <div class="row gx-2">
                        {{--Purchase-Number--}}
                        <div class="col-6 purchase_no">
                          <label for="" class="required w-100 mr-15"><span>Purchase No.#</span></label>
                          <input readonly type="text" name="purchase_no" id="purchase_no" class="required form-control bg-dark text-warning fw-bold border-secondary brd-3 @error('purchase_no') is-invalid @enderror" value="{{$purchase->purchase_no}}" />

                          @if ( $errors->has('purchase_no') )
                            <div class="text-danger fz-14 fw-bold" role="alert">
                              {{ $errors->first('purchase_no') }}
                            </div>
                          @endif
                        </div>

                        {{--Purchase-Type--}}
                        <div class="col-6 purchase-type">
                          <label for="" class="required w-100 mr-15"><span>Type</span></label>
                          <select name="purchase_type" id="purchase_type" class="required form-select border-secondary brd-3 @error('purchase_type') is-invalid @enderror">
                            @foreach ( $purchase_types as $type )
                              <option value="{{$type}}" {{ $type == $purchase->purchase_type ? 'selected' : '' }}>
                                {{ ucwords(str_replace('-', ' ', $type)) }}
                              </option>
                            @endforeach
                          </select>

                          @if ( $errors->has('purchase_type') )
                            <div class="text-danger fz-14 fw-bold" role="alert">
                              {{ $errors->first('purchase_type') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{--Memo-Date-&-Number--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 memo-date-no">
                      <div class="row gx-2">
                        {{--Purchase/Memo-Date--}}
                        <div class="col-6 purchase_date">
                          <label for="" class="required w-100 mr-15"><span>Memo Date</span></label>
                          <div class="p-relative date-select">
                            <input type="text" name="date" id="purchase_date" class="input-date required form-control d-inline-block text-start border-secondary brd-3 z-index-9 @error('date') is-invalid @enderror" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ date($date_format, strtotime($purchase->date)) }}" />
                            <label for="purchase_date" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 lh-1-3 mr-1 p-5 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                          </div>

                          @if ( $errors->has('date') )
                            <div class="text-danger fz-14 fw-bold" role="alert">
                              {{ $errors->first('date') }}
                            </div>
                          @endif
                        </div>

                        {{--Memo-Number--}}
                        <div class="col-6 memo_no">
                          <label for="" class="required w-100 mr-15"><span>Memo No.#</span></label>
                          <input type="text" name="memo_no" id="memo_no" class="required form-control border-secondary brd-3 @error('memo_no') is-invalid @enderror" placeholder="0253" value="{{$purchase->memo_no}}" />

                          @if ( $errors->has('memo_no') )
                            <div class="text-danger fz-14 fw-bold" role="alert">
                              {{ $errors->first('memo_no') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{--Vehicle-Number--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 vehicle_id">
                      <label for="" class="required w-100 mr-15"><span>Vehicle No.#</span></label>
                      <select name="vehicle_id" id="vehicle_id" class="required form-select border-secondary brd-3 @error('type') is-invalid @enderror">
                        <option value="">Select Vehicle</option>
                        @if ( $vehicle_all )
                          @foreach ( $vehicle_all as $vehicle )
                            <option value="{{$vehicle->id}}" {{$vehicle->id == $purchase->vehicle_id ? 'selected' : ''}}>
                              {{ $vehicle->vehicle_no }}
                            </option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('vehicle_id') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('vehicle_id') }}
                        </div>
                      @endif
                    </div>

                    {{--Bill-Number--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 bill_no">
                      <label for="" class="w-100 mr-15">
                        <span>Bill No.#</span>
                        <span class="text-secondary fz-14">(If already bill done)</span>
                      </label>
                      <input type="text" name="bill_no" id="bill_no" class="form-control border-secondary brd-3 @error('bill_no') is-invalid @enderror" placeholder="BL-{{date('Y')}}/00246" value="{{ $purchase->bill_no }}" />

                      @if ( $errors->has('bill_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('bill_no') }}
                        </div>
                      @endif
                    </div>

                    {{--Purchaser-Name--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 purchaser_name">
                      <label for="" class="w-100 mr-15"><span>Purchaser Name</span></label>
                      <input type="text" name="purchaser_name" id="purchaser_name" class="form-control border-secondary brd-3 @error('purchaser_name') is-invalid @enderror" placeholder="John Doe" value="{{ $purchase->purchaser_name }}" />

                      @if ( $errors->has('purchaser_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('purchaser_name') }}
                        </div>
                      @endif
                    </div>--}}

                    {{--Requisition-Number--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 requisition_no">
                      <label for="" class="w-100 mr-15"><span>Requisition No.#</span></label>
                      <input type="text" name="requisition_no" id="requisition_no" class="form-control border-secondary brd-3 @error('requisition_no') is-invalid @enderror" placeholder="{{ 'RQ-' . date('Y') . '/0526' }}" value="{{ $purchase->requisition_no }}" />

                      @if ( $errors->has('requisition_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('requisition_no') }}
                        </div>
                      @endif
                    </div>--}}

                    {{--Registered-Supplier--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 supplier_id">
                      <label for="" class="w-100 mr-15"><span>Supplier</span></label>
                      <select name="supplier_id" id="supplier_id" class="form-select border-secondary brd-3 @error('supplier_id') is-invalid @enderror">
                        <option value="">Select Supplier</option>
                        @if ( $supplier_all )
                          @foreach ( $supplier_all as $supplier )
                            <option value="{{$supplier->id}}" {{$supplier->id == $purchase->supplier_id ? 'selected' : ''}}>
                              {{ $supplier->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('supplier_id') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('supplier_id') }}
                        </div>
                      @endif
                    </div>--}}

                    {{--Unregistered-Supplier-Name--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 supplier_name">
                      <label for="" class="w-100 mr-15"><span>Supplier Name</span></label>
                      <input type="text" name="supplier_name" id="supplier_name" class="form-control border-secondary brd-3 @error('supplier_name') is-invalid @enderror" placeholder="ABC Enterprise Ltd." value="{{ $purchase->supplier_name }}" />

                      @if ( $errors->has('supplier_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('supplier_name') }}
                        </div>
                      @endif
                    </div>--}}

                    {{--Shop-Name--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 shop_name">
                      <label for="" class="w-100 mr-15"><span>Shop Name</span></label>
                      <input type="text" name="shop_name" id="shop_name" class="form-control border-secondary brd-3 @error('shop_name') is-invalid @enderror" placeholder="Dhaka Traders" value="{{ $purchase->shop_name }}" />

                      @if ( $errors->has('shop_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('shop_name') }}
                        </div>
                      @endif
                    </div>

                    {{--Shop-Contact-Location--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 shop-contact-Location">
                      <div class="row gx-2">
                        {{--Shop-Contact--}}
                        <div class="col-6 shop_contact">
                          <label for="" class="w-100 mr-15"><span>Shop Contact</span></label>
                          <input type="text" name="shop_contact" id="shop_contact" class="form-control border-secondary brd-3 @error('shop_contact') is-invalid @enderror" placeholder="01712-445566" value="{{ $purchase->shop_contact }}" />

                          @if ( $errors->has('shop_contact') )
                            <div class="text-danger fz-14 fw-bold" role="alert">
                              {{ $errors->first('shop_contact') }}
                            </div>
                          @endif
                        </div>

                        {{--Shop-Location--}}
                        <div class="col-6 shop_location">
                          <label for="" class="w-100 mr-15"><span>Shop Location</span></label>
                          <input type="text" name="shop_location" id="shop_location" class="form-control border-secondary brd-3 @error('shop_location') is-invalid @enderror" placeholder="Mohakhali" value="{{ $purchase->shop_location }}" />

                          @if ( $errors->has('shop_location') )
                            <div class="text-danger fz-14 fw-bold" role="alert">
                              {{ $errors->first('shop_location') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>

                    {{--Purchased-By--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 purchased_by">
                      <label for="" class="required w-100 mr-15"><span>Purchased By</span></label>
                      <select name="purchased_by" id="purchased_by" class="required form-select border-secondary brd-3 @error('purchased_by') is-invalid @enderror">
                        <option value="">Select Purchaser</option>
                        @if ( $purchaser_all )
                          @foreach ( $purchaser_all as $purchaser )
                            <option value="{{$purchaser->id}}" {{$purchaser->id == $purchase->purchased_by ? 'selected' : ''}}>
                              {{ $purchaser->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('purchased_by') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('purchased_by') }}
                        </div>
                      @endif
                    </div>

                    {{--Authorized-By--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 authorized_by">
                      <label for="" class="w-100 mr-15"><span>Authorized By</span></label>
                      <select name="authorized_by" id="authorized_by" class="form-select border-secondary brd-3 @error('authorized_by') is-invalid @enderror">
                        <option value="">Select Authorizer</option>
                        @if ( $authorizer_all )
                          @foreach ( $authorizer_all as $authorizer )
                            <option value="{{$authorizer->id}}" {{$authorizer->id == $purchase->authorized_by ? 'selected' : ''}}>
                              {{ $authorizer->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('authorized_by') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('authorized_by') }}
                        </div>
                      @endif
                    </div>
                  </div> {{--/.row--}}
                </div> {{--/.form-top--}}


                {{--Purchase-Items-Details--}}
                <div class="form-center purchase-items-block py-20 px-15 mb-30 border-1 brd-3">
                  <h6 class="block-title bg-dark text-white text-center py-10 mb-20 brd-3">Purchase Items</h6>

                  <div id="Purchase-Items" class="p-relative mb-30">
                    <div class="accordion" id="Accordion-Parent">

                      @if ( $purchase->details )
                        @foreach ( $purchase->details as $index => $purchase_item )
                          @include( 'modules.vehicle-module.purchase-parts.accordion-item', [$purchase_item, $units] )
                        @endforeach
                      @else
                        <div class="accordion-item border-secondary-2" id="item_1">
                          <h2 class="accordion-header p-relative" id="accordionHeading_1">
                            <button class="accordion-button fw-bold p-15" type="button" data-bs-toggle="collapse" data-bs-target="#accordionCollapse_1" aria-expanded="true" aria-controls="accordionCollapse_1">
                              Item #<span class="item-count">1</span>
                            </button>
                            <span onclick="RemoveAccordionItem(this);"
                                  class="remove-accordion-item d-none before-shadow p-absolute pos-top-right w-30px h-30px bg-danger text-white fz-20 text-center lh-1-5 mt-10 mr-50 brd-50 cur-pointer z-index-11">
                              <i class="fa fa-close"></i>
                            </span>
                          </h2>

                          <input type="hidden" name="previousItem_id[]" value="" />
                          <input type="hidden" name="previousItem_uid[]" value="" />

                          <div id="accordionCollapse_1" class="accordion-collapse collapse show" aria-labelledby="accordionHeading_1" data-bs-parent="#Accordion-Parent">
                            <div class="accordion-body px-15 pb-5">
                              <div class="row gx-0 gx-sm-2 p-relative">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-name">
                                  <input type="text" name="item_name[]" id="item_name-1" class="item_name form-control border-secondary brd-3" autocomplete="off" placeholder="Item Name" value="" />
                                  <input type="hidden" name="item_id[]" id="item_id-1" class="item_id" value="" />
                                  <input type="hidden" name="item_uid[]" id="item_uid-1" class="item_uid" value="" />
                                  <input type="hidden" name="item_slug[]" id="item_slug-1" class="item_slug" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 size-and-origin">
                                  <div class="row g-2">
                                    <div class="col-sm-6 col-12 mb-15 item-origin">
                                      <select name="item_country[]" id="item_country-1" class="item_country form-select border-secondary brd-3">
                                        <option value="">Origin Country</option>
                                        @foreach ( $countries as $country )
                                          <option value="{{ $country['slug'] }}">
                                            {{ $country['name'] }}
                                          </option>
                                        @endforeach
                                      </select>
                                    </div>
  
                                    <div class="col-sm-6 col-12 mb-15 item-size">
                                      <input type="text" name="item_size[]" id="item_size-1" class="item_size form-control border-secondary brd-3" placeholder="Size" value="" />
                                    </div>
                                  </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-serials">
                                  <input type="text" name="item_serials[]" id="item_serials-1" class="item_serials form-control border-secondary brd-3" placeholder="Serials" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-qty">
                                  <input type="number" min="0" name="item_qty[]" id="item_qty-1" class="item_qty form-control border-secondary brd-3" placeholder="Quantity" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit">
                                  <select name="item_unit[]" id="item_unit-1" class="item_unit form-select border-secondary brd-3">
                                    @foreach ( $units as $unit )
                                      <option value="{{$unit}}" {{$unit == 'pcs' ? 'selected' : ''}}>
                                        {{ ucwords($unit) }}
                                      </option>
                                    @endforeach
                                  </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit-price">
                                  <input type="number" min="0" step="0.10" name="item_unit_price[]" id="item_unit_price-1" class="item_unit_price form-control border-secondary brd-3" placeholder="Unit Price" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-amount">
                                  <input type="number" min="0" name="item_amount[]" id="item_amount-1" class="item_amount form-control border-secondary brd-3" placeholder="Item Amount" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-remarks">
                                  <input type="text" name="item_remarks[]" id="item_remarks-1" class="item_remarks form-control border-secondary brd-3" placeholder="Remarks" value="" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> {{--/.accordion-item--}}
                      @endif

                    </div> {{--/#Accordion-Parent .accordion--}}

                    {{--Vehicle-Parts-List Hidden--}}
                    <div id="Vehicle-Parts-List" class="d-none overlay-scrollbar p-absolute pos-top-left h-250px fw-bold ml-15 z-index-1100">
                      <ul class="parts-list list-style-none bg-off-white border-1 z-index-1100" data-id="">
                        @if ( $parts_all )
                          @foreach ( $parts_all as $index => $parts )
                            <li data-name="{{$parts->name}}" data-id="{{$parts->id}}" 
                                data-uid="{{$parts->uid}}" data-slug="{{$parts->slug}}" 
                                data-category="{{$parts->category_id}}"
                                data-description="{{$parts->description}}" 
                                data-unit="{{$parts->unit}}" data-origin="{{$parts->origin}}"
                            class="parts-item py-10 px-15 bb-1 cur-pointer">{{$parts->name}}</li>
                          @endforeach
                        @endif
                      </ul> {{--/.parts-list--}}
                    </div> {{--/#Vehicle-Parts-List--}}
                  </div> {{--/#Purchase-Items--}}

                  <div class="accordion-actions d-flex justify-content-between">
                    <a href="#" id="removeAccordionItem-btn" class="btn btn-danger p-relative before-shadow z-index-11">
                      <i class="fa fa-minus mr-5"></i>
                      Remove Item
                    </a>

                    <a href="#" id="addMoreAccordionItem-btn" class="btn btn-dark">
                      <i class="fa fa-plus mr-5"></i>
                      Add Item
                    </a>
                  </div>
                </div> {{--/.form-center--}}
              </div> {{--/.form-top-and-center--}}


              <div class="form-bottom bg-secondary-5 ml--20 mr--20 p-15 border-1 border-secondary-3">
                <div class="row">
                  {{--Total-Quantity-&-Amount--}}
                  <div class="order-lg-3 order-sm-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-10 total-qty-amount">
                    {{--Total-Quantity--}}
                    <div class="total-qty mb-5">
                      <div class="d-flex justify-content-between">
                        <label for="" class="fw-bold"><span>Total Qty.</span></label>
                        <div id="item_total_qty" class="d-inline-block h-30px bg-dark text-warning text-center lh-1-8 border-secondary brd-3 @error('total_qty') is-invalid @enderror">{{$purchase->total_qty}}</div>
                        <input type="hidden" name="total_qty" id="total_qty" class="total_qty form-control border-secondary brd-3" value="{{$purchase->total_qty}}" />
                      </div>
                      
                      @if ( $errors->has('total_qty') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('total_qty') }}
                        </div>
                      @endif
                    </div>

                    {{--Total-Amount--}}
                    <div class="total-amount mb-5">
                      <div class="d-flex justify-content-between">
                        <label for="" class="fw-bold"><span>Total Amount</span></label>
                        <div id="item_total_amount" class="d-inline-block h-30px bg-dark text-warning text-center lh-1-8 border-secondary brd-3 @error('total_amount') is-invalid @enderror">{{$purchase->total_amount}}</div>
                        <input type="hidden" name="total_amount" id="total_amount" class="total_amount form-control border-secondary brd-3" value="{{$purchase->total_amount}}" />
                      </div>

                      @if ( $errors->has('total_amount') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('total_amount') }}
                        </div>
                      @endif
                    </div>
                  </div>

                  {{--Payment-Status--}}
                  <div class="order-lg-2 order-sm-1 col-lg-3 col-md-4 col-sm-6 col-12 mb-10 payment-status">
                    <label for="" class="fw-bold mr-15 mb-5"><span>Payment Status</span></label>
                    <div class="d-flex flex-row flex-sm-column">
                      <div class="form-check me-4 me-sm-0 mb-5 full-paid">
                        <input type="checkbox" name="is_paid" id="is_paid" class="form-check-input border-secondary cur-pointer" value="full-paid" {{ $purchase->is_paid ? 'checked' : '' }} />
                        <label class="form-check-label cur-pointer" for="is_paid">Full Paid</label>
                      </div>

                      <div class="form-check partial-paid">
                        <input type="checkbox" name="is_partial_paid" id="is_partial_paid" class="form-check-input border-secondary cur-pointer" value="partial-paid" {{ $purchase->is_partial_paid ? 'checked' : '' }} />
                        <label class="form-check-label cur-pointer" for="is_partial_paid">Partial Paid</label>
                      </div>
                    </div>
                  </div>

                  {{--Paid-&-Due-Amount--}}
                  <div class="order-lg-4 order-md-3 order-sm-4 col-lg-3 col-md-4 col-sm-6 col-12 mb-10 paid-due-amount">
                    {{--Paid-Amount--}}
                    <div class="paid-amount d-flex justify-content-between mb-5">
                      <label for="" class="fw-bold"><span>Paid Amount</span></label>
                      <div class="amount">
                        <input type="number" min="0" step="1" name="paid_amount" id="paid_amount" class="form-control border-secondary brd-3 @error('paid_amount') is-invalid @enderror" value="{{ (int) $purchase->paid_amount }}" />

                        @if ( $errors->has('paid_amount') )
                          <div class="text-danger fz-14 fw-bold" role="alert">
                            {{ $errors->first('paid_amount') }}
                          </div>
                        @endif
                      </div>
                    </div>

                    {{--Due-Amount--}}
                    <div class="due-amount d-flex justify-content-between">
                      <label for="" class="fw-bold"><span>Due Amount</span></label>
                      <div class="amount">
                        <input type="number" min="0" step="1" name="due_amount" id="due_amount" class="form-control border-secondary brd-3 @error('due_amount') is-invalid @enderror" value="{{ (int) $purchase->due_amount }}" />

                        @if ( $errors->has('due_amount') )
                          <div class="text-danger fz-14 fw-bold" role="alert">
                            {{ $errors->first('due_amount') }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{--Notes--}}
                  <div class="order-lg-1 order-sm-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-10 lh-1 notes">
                    {{--<label for="" class="fw-bold mr-15"><span>Notes</span></label>--}}
                    <textarea name="notes" id="notes" class="h-100 form-control d-inline-block border-secondary brd-3" rows="3" placeholder="Notes">{{ $purchase->notes }}</textarea>
                  </div>

                  {{--Entry-By--}}
                  <div class="order-lg-5 order-sm-5 align-self-end col-lg-3 col-md-4 col-sm-6 col-12 mb-10 entry_by">
                    {{--<label for="" class="w-100 mr-15"><span>Entry By</span></label>--}}
                    <?php 
                      $entry_by = $purchase->user_id ?? $purchase->entry_by;
                    ?>
                    <select {{auth()->user() ? 'readonly' : ''}} name="entry_by" id="entry_by" class="form-select border-secondary brd-3 @error('entry_by') is-invalid @enderror">
                      <option value="">Entry By</option>
                      @if ( $employee_all )
                        @foreach ( $employee_all as $employee )
                          <option value="{{$employee->id}}" {{$employee->id == $entry_by ? 'selected' : ''}}>
                            {{ $employee->name }}
                          </option>
                        @endforeach
                      @endif
                    </select>

                    @if ( $errors->has('entry_by') )
                      <div class="text-danger fz-14 fw-bold" role="alert">
                        {{ $errors->first('entry_by') }}
                      </div>
                    @endif
                  </div>

                  {{--Submit--}}
                  <div class="order-last align-self-end offset-lg-6 col-lg-3 col-md-4 col-sm-6 col-12 mb-10 text-end">
                    <button class="btn btn-purple w-100 py-sm-1">Update</button>
                  </div>
                </div> {{--/.row--}}
              </div> {{--/.form-bottom--}}

              {{--Custom token using Purchase-uuid to make extra security layer--}}
              {{--<input type="hidden" name="token" value="{{$purchase->uid}}-68u1d" />--}}
              <input type="hidden" name="token" value="{{$securityToken}}" />
            </form>


            <div id="Clone-Accordion" class="d-none">
              <div class="accordion-item border-secondary-2" id="">
                <h2 class="accordion-header p-relative" id="accordionHeading">
                  <button class="accordion-button fw-bold p-15" type="button" data-bs-toggle="collapse" data-bs-target="#accordionCollapse" aria-expanded="true" aria-controls="accordionCollapse">
                    Item #<span class="item-count">#</span>
                  </button>
                  <span onclick="RemoveAccordionItem(this);"
                        class="remove-accordion-item d-none before-shadow p-absolute pos-top-right w-30px h-30px bg-danger text-white fz-20 text-center lh-1-5 mt-10 mr-50 brd-50 cur-pointer z-index-11">
                    <i class="fa fa-close"></i>
                  </span>
                </h2>

                <input type="hidden" name="previousItem_id[]" value="" />
                <input type="hidden" name="previousItem_uid[]" value="" />

                <div id="accordionCollapse" class="accordion-collapse collapse show" aria-labelledby="accordionHeading" data-bs-parent="#Accordion-Parent">
                  <div class="accordion-body px-15 pb-5">
                    <div class="row gx-0 gx-sm-2 p-relative">
                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-name">
                        <input type="text" name="item_name[]" id="item_name" class="item_name form-control border-secondary brd-3" autocomplete="off" placeholder="Item Name" value="" />
                        <input type="hidden" name="item_id[]" id="item_id" class="item_id" value="" />
                        <input type="hidden" name="item_uid[]" id="item_uid" class="item_uid" value="" />
                        <input type="hidden" name="item_slug[]" id="item_slug" class="item_slug" value="" />
                      </div>

                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 size-and-origin">
                        <div class="row g-2">
                          <div class="col-sm-6 col-12 mb-15 item-origin">
                            <select name="item_country[]" id="item_country" class="item_country form-select border-secondary brd-3">
                              <option value="">Origin Country</option>
                              @foreach ( $countries as $country )
                                <option value="{{ $country['slug'] }}">
                                  {{ $country['name'] }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-sm-6 col-12 mb-15 item-size">
                            <input type="text" name="item_size[]" id="item_size" class="item_size form-control border-secondary brd-3" placeholder="Size" value="" />
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-serials">
                        <input type="text" name="item_serials[]" id="item_serials" class="item_serials form-control border-secondary brd-3" placeholder="Serials" value="" />
                      </div>

                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-qty">
                        <input type="number" min="0" name="item_qty[]" id="item_qty" class="item_qty form-control border-secondary brd-3" placeholder="Quantity" value="" />
                      </div>

                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit">
                        <select name="item_unit[]" id="item_unit" class="item_unit form-select border-secondary brd-3">

                          @foreach ( $units as $unit )
                            <option value="{{$unit}}" {{$unit == 'pcs' ? 'selected' : ''}}>
                              {{ ucwords($unit) }}
                            </option>
                          @endforeach
                          
                        </select>
                      </div>

                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit-price">
                        <input type="number" min="0" step="0.10" name="item_unit_price[]" id="item_unit_price" class="item_unit_price form-control border-secondary brd-3" placeholder="Unit Price" value="" />
                      </div>

                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-amount">
                        <input type="number" min="0" name="item_amount[]" id="item_amount" class="item_amount form-control border-secondary brd-3" placeholder="Item Amount" value="" />
                      </div>

                      <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-remarks">
                        <input type="text" name="item_remarks[]" id="item_remarks" class="item_remarks form-control border-secondary brd-3" placeholder="Remarks" value="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> {{--/#Clone-Accordion .d-none--}}

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


  // Show Alert Message for Error
	function AlertErrorMessage(message, type = null){
		Swal.fire({
			icon: 'error',
			title: 'Oops! Sorry.',
			text: message + type,
		});
  }


  // Show Parts-List by click on item-name input field
	// And adjust the position of Parts-List block with input item-name
	ShowPartsLists();
	function ShowPartsLists(){
    $("#Accordion-Parent .accordion-body input.item_name").each(function(){
    	$(this).click(function(){
    		// Display-Block all parts-item
				if( $(this).val() === "" ){
					$("#Vehicle-Parts-List li.parts-item").each(function(){
						$(this).css("display", "block");
					});
				}

    		let thisParentId = $(this).closest(".accordion-item")[0].id;
    		// Get input element distance
				let thisRect = $(this)[0].getBoundingClientRect();
				// Get accordion's parent distance
				let accordionParentRect = $("#Accordion-Parent")[0].getBoundingClientRect();
        // Set Parts-List width & top length
    		let thisTop = ((thisRect.top - accordionParentRect.top) + (thisRect.height + 2)) + "px";
    		let styles = {
					"width": $(this).outerWidth() + "px",
					"top": thisTop
        };
				$("#Vehicle-Parts-List").css(styles);
				$("#Vehicle-Parts-List ul.parts-list").attr("data-id", thisParentId);

				$.fn.BlockVisible("#Vehicle-Parts-List");
      });
    });
  }


  // Select Parts name-ID-slug from Parts-List
	SelectPartsFromList();
	function SelectPartsFromList(){
    $("#Vehicle-Parts-List li.parts-item").each(function(){
    	$(this).click(function(){
    		let selectedInputParentId = $(this).closest("ul.parts-list").attr("data-id");
    		$(`#${selectedInputParentId} input.item_name`).val( $(this).attr('data-name') );
    		$(`#${selectedInputParentId} input.item_id`).val( $(this).attr("data-id") );
    		$(`#${selectedInputParentId} input.item_uid`).val( $(this).attr("data-uid") );
    		$(`#${selectedInputParentId} input.item_slug`).val( $(this).attr('data-slug') );

				$.fn.BlockHidden("#Vehicle-Parts-List");
      });
    });
  }


	// Filter the Parts-List
	FilterPartsList();
	function FilterPartsList(){
		$("#Accordion-Parent .accordion-body input.item_name").each(function(){
			$(this).keyup(function(){
				let filterText, parts_list, textValue;
				filterText = $(this).val().toUpperCase();
				parts_list = $("#Vehicle-Parts-List li.parts-item");

				for( let i = 0; i < parts_list.length; i++ ){
					textValue = parts_list[i].textContent || parts_list[i].innerText;
					if( textValue.toUpperCase().indexOf(filterText) > -1 ){
						parts_list[i].style.display = "block";
					} else{
						parts_list[i].style.display = "none";
					}
				}
			});
		});
  }


	// Get Total-Amount
	function GetTotalAmount(){
		return Number( $(".total-qty-amount #item_total_amount").text() );
	}
	// Print Total-Amount
  function PrintTotalAmount(){
		let item_total_amount = 0;
		$("#Accordion-Parent input.item_amount").each(function(){
			item_total_amount += Number( $(this).val() );
		});
		$(".total-qty-amount #item_total_amount").text( item_total_amount.toFixed(2) );
		$(".total-qty-amount input#total_amount").val( item_total_amount.toFixed(0) );
  }

	// Get Total-Quantity
	function GetTotalQuantity(){
		return Number( $(".total-qty-amount #item_total_qty").text() );
	}
	// Print Total-Quantity
  function PrintTotalQuantity(){
		let item_total_qty = 0;
		$("#Accordion-Parent input.item_qty").each(function(){
			item_total_qty += Number( $(this).val() );
		});
		$(".total-qty-amount #item_total_qty").text( item_total_qty );
		$(".total-qty-amount input#total_qty").val( item_total_qty );
  }

	// If Amount Is Full Paid
	function IsFullPaid(){
		return $(".payment-status #is_paid").prop("checked") === true;
  }
	// Check Full-Paid
	function CheckFullPaid(){
		$(".payment-status #is_paid").prop("checked", true);
	}
	// Uncheck Full-Paid
	function UncheckFullPaid(){
		$(".payment-status #is_paid").prop("checked", false);
	}

  // If Amount Is Partial Paid
	function IsPartialPaid(){
		return $(".payment-status #is_partial_paid").prop("checked") === true;
  }
	// Check Partial-Paid
	function CheckPartialPaid(){
		$(".payment-status #is_partial_paid").prop("checked", true);
	}
	// Uncheck Partial-Paid
	function UncheckPartialPaid(){
		$(".payment-status #is_partial_paid").prop("checked", false);
	}

	// Get Paid Amount
	function GetPaidAmount(){
		return Number( $(".paid-due-amount #paid_amount").val() );
	}
  // Print Paid Amount
  function PrintPaidAmount(getAmount){
		$(".paid-due-amount #paid_amount").val( getAmount.toFixed(0) );
  }

	// Get Due Amount
	function GetDueAmount(){
		return Number( $(".paid-due-amount #due_amount").val() );
	}
	// Print Due Amount
  function PrintDueAmount(getAmount){
		$(".paid-due-amount #due_amount").val( getAmount.toFixed(0) );
  }


  // Calculate Unit-Price Quantity & Amount
	Calculate_UnitPrice_Quantity_Amount();
	function Calculate_UnitPrice_Quantity_Amount(){
		// Calculate Item-Quantity-Amount & Total-Quantity-Amount
		$("#Accordion-Parent input.item_unit_price").each(function(){
			$(this).keyup(function(){
				let inputParentId = $(this).closest(".accordion-item")[0].id;
				let quantity = $(`#${inputParentId} input.item_qty`).val();

				if( $(this).val() !== "" && quantity !== "" ){
					let item_amount = Number($(this).val()) * Number(quantity);
					$(`#${inputParentId} input.item_amount`).val( item_amount.toFixed(0) );

				} else{
					$(`#${inputParentId} input.item_amount`).val("");
				}

        PrintTotalQuantity();
        PrintTotalAmount();
        if( IsFullPaid() ) PrintPaidAmount( GetTotalAmount() );
        if( IsPartialPaid() ) PrintDueAmount( GetTotalAmount() );
        if( !IsFullPaid() && !IsPartialPaid() ){
          PrintPaidAmount(0);
          PrintDueAmount( GetTotalAmount() );
        }
			});
    });

		// Calculate Item-Unit-Price-Amount & Total-Quantity-Amount
		$("#Accordion-Parent input.item_qty").each(function(){
			$(this).keyup(function(){
				let inputParentId = $(this).closest(".accordion-item")[0].id;
				let unit_price = $(`#${inputParentId} input.item_unit_price`).val();
				if( $(this).val() !== "" && unit_price !== "" ){
					let item_amount = Number($(this).val()) * Number(unit_price);
					$(`#${inputParentId} input.item_amount`).val( item_amount.toFixed(0) );

				} else{
					$(`#${inputParentId} input.item_amount`).val("");
				}

				PrintTotalQuantity();
				PrintTotalAmount();
				if( IsFullPaid() ) PrintPaidAmount( GetTotalAmount() );
				if( IsPartialPaid() ) PrintDueAmount( GetTotalAmount() );
				if( !IsFullPaid() && !IsPartialPaid() ){
					PrintPaidAmount(0);
					PrintDueAmount( GetTotalAmount() );
				}
			});
		});

		// Calculate Item-Quantity-Unit-Price & Total-Quantity-Amount
		$("#Accordion-Parent input.item_amount").each(function(){
			$(this).keyup(function(){
				let inputParentId = $(this).closest(".accordion-item")[0].id;
				let item_qty = $(`#${inputParentId} input.item_qty`);
				let item_unit_price = $(`#${inputParentId} input.item_unit_price`);

				if( Number($(item_qty).val()) === 0 ){
					$(this).val("");
					item_qty[0].focus();
          AlertErrorMessage("Please, first add quantity!", "");
        }

				if( $(item_qty).val() !== "" ){
					let unit_price = Number($(this).val()) / Number($(item_qty).val());
          $(item_unit_price).val( unit_price.toFixed(1) );
				}

				PrintTotalQuantity();
				PrintTotalAmount();
				if( IsFullPaid() ) PrintPaidAmount( GetTotalAmount() );
				if( IsPartialPaid() ) PrintDueAmount( GetTotalAmount() );
				if( !IsFullPaid() && !IsPartialPaid() ){
					PrintPaidAmount(0);
					PrintDueAmount( GetTotalAmount() );
				}
			});
		});
  }


  // New-Accordion-Item-Add
  function NewAccordionItemAdd(){
    let accordionParent = null, addAccordion = "", x = 0;
    let accordionTitleAttrs = {}, accordionCollapseAttrs = {};

    // Get Parent Accordion Wrapper
    accordionParent = $("#Accordion-Parent");
    // Edit Accordion unique number by counting previous items length
    x = accordionParent[0].childElementCount + 1;

    // Previous-Item re-serialized
    $("#Accordion-Parent .accordion-button span.item-count").each(function(key, val){
      $(this).text(key+1);
    });

    // Collapsed previous items
    if( $("#Accordion-Parent .accordion-button:not(.collapsed)") ){
      $("#Accordion-Parent .accordion-button").each(function(){
        if( ! $(this).hasClass("collapsed") ){
          $(this).addClass("collapsed");
          $(this).attr("aria-expanded", "false");
        }
      });
    }
    if( $("#Accordion-Parent .accordion-collapse.collapse.show") ){
      $("#Accordion-Parent .accordion-collapse.collapse.show").each(function(){
        $(this).removeClass("show");
      });
    }

    // Set Edit Item unique class & other numbers
    $("#Clone-Accordion .accordion-item").attr("id", `item_${x}`);
    $("#Clone-Accordion .accordion-header").attr("id", `accordionHeading_${x}`);
    accordionTitleAttrs = {
      "data-bs-target": "#accordionCollapse_" + x,
      "aria-controls": "accordionCollapse_" + x,
    };
    accordionCollapseAttrs = {
      "id": "accordionCollapse_" + x,
      "aria-labelledby": "accordionHeading_" + x,
    };
    $("#Clone-Accordion .accordion-button").attr(accordionTitleAttrs);
    $("#Clone-Accordion span.item-count").text(x);
    $("#Clone-Accordion .accordion-collapse").attr(accordionCollapseAttrs);
    $("#Clone-Accordion .accordion-body input.item_name").attr("id", `item_name-${x}`);
    $("#Clone-Accordion .accordion-body input.item_id").attr("id", `item_id-${x}`);
    $("#Clone-Accordion .accordion-body input.item_uid").attr("id", `item_uid-${x}`);
    $("#Clone-Accordion .accordion-body input.item_slug").attr("id", `item_slug-${x}`);
    $("#Clone-Accordion .accordion-body input.item_country").attr("id", `item_country-${x}`);
    $("#Clone-Accordion .accordion-body input.item_size").attr("id", `item_size-${x}`);
    $("#Clone-Accordion .accordion-body input.item_serials").attr("id", `item_serials-${x}`);
    $("#Clone-Accordion .accordion-body select.item_unit").attr("id", `item_unit-${x}`);
    $("#Clone-Accordion .accordion-body input.item_unit_price").attr("id", `item_unit_price-${x}`);
    $("#Clone-Accordion .accordion-body input.item_qty").attr("id", `item_qty-${x}`);
    $("#Clone-Accordion .accordion-body input.item_amount").attr("id", `item_amount-${x}`);
    $("#Clone-Accordion .accordion-body input.item_remarks").attr("id", `item_remarks-${x}`);

    // Append New Item to Parent-Accordion
    addAccordion = $("#Clone-Accordion").html();
    $(addAccordion).clone().appendTo(accordionParent);

    // Remove cloned accordion unique id
    $("#Clone-Accordion .accordion-item").attr("id", "");

    // Activate Last accordion-item if it is collapsed
    let lastItem = $(`#Accordion-Parent #item_${x}`);
    if( $(lastItem).find(".accordion-button").hasClass("collapsed") ){
      $(lastItem).find(".accordion-button").removeClass("collapsed");
    }
    if( $(lastItem).find(".accordion-button").attr("aria-expanded") === "false" ){
      $(lastItem).find(".accordion-button").attr("aria-expanded", "true");
    }
    if( ! $(lastItem).find(".accordion-collapse.collapse").hasClass("show") ){
      $(lastItem).find(".accordion-collapse.collapse").addClass("show");
    }
  }


  // Add-More-Accordion-Item
	AddMoreAccordionItem();
  function AddMoreAccordionItem(){
  	$("#addMoreAccordionItem-btn").click(function(){
			let notFilledItems = [];
			let message = "Fill-up previous item's name, quantity & amount!";

			// Check all accordions multiple input field has value
			$("#Accordion-Parent input.item_name, #Accordion-Parent input.item_qty, #Accordion-Parent input.item_amount").each(function(){
        if( ! $(this).val() ){
					AlertErrorMessage(message, "");
					notFilledItems.push( $(this) );
        }
      });

      // If accordion all items input has filled
			if( notFilledItems.length === 0 ){
        NewAccordionItemAdd();
      }
			ShowPartsLists();
			SelectPartsFromList();
			FilterPartsList();
			Calculate_UnitPrice_Quantity_Amount();
    });
  }


  // Check-Accordion-Item-Has-Value-Data
  function CheckAccordionItemHasData(parentDiv){
    let input_name = input_id = input_uid = input_slug = input_qty = input_amount = null;
    input_name   = $(parentDiv).find("input.item_name").val();
    input_id     = $(parentDiv).find("input.item_id").val();
    input_uid    = $(parentDiv).find("input.item_uid").val();
    input_slug   = $(parentDiv).find("input.item_slug").val();
    input_qty    = $(parentDiv).find("input.item_qty").val();
    input_amount = $(parentDiv).find("input.item_amount").val();

    if( !input_name && !input_id && !input_uid && !input_slug && !input_qty && !input_amount ){
      return false;
    } else{
      return true;
    }
  }


	// Activate-Remove-Icon-to-Accordion-Item
	ActivateRemoveIconToAccordionItem();
	function ActivateRemoveIconToAccordionItem(){
		$("#removeAccordionItem-btn").click(function(){
			if( $("#Accordion-Parent")[0].childElementCount > 1 ){
				$("#Accordion-Parent .accordion-item .remove-accordion-item").each(function(){
					$.fn.BlockVisible($(this));
				});
      } else if( $("#Accordion-Parent")[0].childElementCount === 1 ){
        let accordionItem = $("#Accordion-Parent .accordion-item");
        if( CheckAccordionItemHasData(accordionItem) ){
          $("#Accordion-Parent .accordion-item .remove-accordion-item").each(function(){
					  $.fn.BlockVisible($(this));
				  });
        } else{
          AlertErrorMessage("At least one item should be kept.", "");
        }
			} else{
        AlertErrorMessage("Please, first add one item.", "");
      }
		});
	}


  // Remove-Accordion-Item
  function RemoveAccordionItem(e){
    let parentDiv = purchaseUid = itemUid = url = null;
    parentDiv    = $(e).closest(".accordion-item");
    purchaseUid  = @json($purchase->uid);
    itemUid      = $(parentDiv).attr('data-uid');
    url          = `/module/vehicles/parts/purchase/${purchaseUid}/item/${itemUid}/delete`;
    
    if( ! CheckAccordionItemHasData(parentDiv) ){
      if( $("#Accordion-Parent")[0].childElementCount === 1 ){
        AlertErrorMessage("At least one item should be kept.", "");
      } else{
        $(e).closest(".accordion-item").remove();
      }
    } else{
      axios.get(url)
      .then( response => {
        Toast.fire({
          icon: 'success',
          text: 'Item "' + response.data.itemName + '" removed successfully!',
        });
        
        $(e).closest(".accordion-item").remove();

        // All-accordion-item re-serialized
        $("#Accordion-Parent .accordion-button span.item-count").each(function(key, val){
          $(this).text(key+1);
        });

        if( $("#Accordion-Parent")[0].childElementCount === 0 ){
          NewAccordionItemAdd();
        }

        ShowPartsLists();
        SelectPartsFromList();
        FilterPartsList();
        Calculate_UnitPrice_Quantity_Amount();
        PrintTotalAmount();
        PrintTotalQuantity();
        if( IsFullPaid() ) PrintPaidAmount( GetTotalAmount() ); PrintPaidAmount(0);
        if( IsPartialPaid() ) PrintPaidAmount(0); PrintPaidAmount( GetTotalAmount() );
      })
      .catch( err => {
        if( err.response.data.errors ){
          AlertErrorMessage( err.response.data.errors.message, "" );
        } else{
          console.log( err.response );
        }
      });
    }
  }


  // Payment Status Change to Full-Paid / Partial-Paid
	PaymentStatusChange();
	function PaymentStatusChange(){
		$(".payment-status #is_paid").click(function(){
			if( IsFullPaid() ){
				UncheckPartialPaid();
        PrintPaidAmount( GetTotalAmount() );
				PrintDueAmount(0);

      } else if( ! IsFullPaid() && ! IsPartialPaid() ){
				PrintPaidAmount(0);
				PrintDueAmount( GetTotalAmount() );
			}
    });

		$(".payment-status #is_partial_paid").click(function(){
			if( IsPartialPaid() ){
				UncheckFullPaid();
				PrintDueAmount( GetTotalAmount() );
				// PrintPaidAmount(0);
				$(".paid-due-amount #paid_amount").val("").focus();
			}
		});
  }


  // Change Paid-And-Due-Amount
	PaidAndDueAmount();
	function PaidAndDueAmount(){
    $(".paid-due-amount #paid_amount").keyup(function(){
			if( Number($(this).val()) === 0 ) {
				PrintDueAmount( GetTotalAmount() );
				UncheckFullPaid(); UncheckPartialPaid();

      } else if( Number($(this).val()) === GetTotalAmount() ) {
				PrintDueAmount(0);
				UncheckPartialPaid(); CheckFullPaid();

			} else if( Number($(this).val()) > GetTotalAmount() ) {
				PrintPaidAmount( GetTotalAmount() );
				PrintDueAmount(0);
				UncheckPartialPaid(); CheckFullPaid();
				AlertErrorMessage('Paid amount should be less than or equal to total amount!', '');

			} else{
				PrintDueAmount( GetTotalAmount() - Number($(this).val()) );
				if( ! IsPartialPaid() ) UncheckFullPaid(); CheckPartialPaid();
			}
    });

		$(".paid-due-amount #due_amount").keyup(function(){
			if( Number($(this).val()) === 0 ) {
				PrintPaidAmount( GetTotalAmount() );
				UncheckPartialPaid(); CheckFullPaid();

			} else if( Number($(this).val()) === GetTotalAmount() ) {
				PrintPaidAmount(0);
				UncheckPartialPaid(); UncheckFullPaid();

			} else if( Number($(this).val()) > GetTotalAmount() ) {
				PrintPaidAmount(0);
				PrintDueAmount( GetTotalAmount() );
				UncheckPartialPaid(); UncheckFullPaid();
				AlertErrorMessage('Due amount should be less than or equal to total amount!', '');

			} else{
				PrintPaidAmount( GetTotalAmount() - Number($(this).val()) );
				if( ! IsPartialPaid() ) UncheckFullPaid(); CheckPartialPaid();
			}
		});
  }


</script>
@endsection