<div class="table-row content d-flex justify-content-around align-items-center">
  <div class="serial w-30px-min">{{ $index+1 }}</div>
  <div class="purchase-number text-primary">{{ $purchase->purchase_no }}</div>
  <div class="purchase-date">{{ date($date_format, strtotime($purchase->date)) }}</div>
  <div class="vehicle-number">{{ $purchase->vehicle_id }}</div>
  <div class="parts-list">{{ $purchase->vehicle_id }}</div>
  <div class="shop-name">{{ $purchase->shop_name }}</div>
  <div class="total-qty">{{ $purchase->total_qty }}</div>
  <div class="total-amount">{{ number_format($purchase->total_amount, 2) }}</div>

  <div class="action">
    {{--onclick="$(`#${this.id}`).printPage();"--}}
    <a href="#" id="purchasePrint_{{ $purchase->id }}" data-id="{{ $purchase->uid }}"
       class="purchasePrint-from-history btn btn-primary btn-sm brd-3">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print Purchase">
        <i class="fa fa-print"></i>
      </span>
    </a>

    {{--{{ route('transaction.receive.details.modal-View', $receive->id) }}--}}
    {{--onclick="ReceiveDetailsModalView(this);"--}}
    <a href="#" id="{{ $purchase->id }}" data-id="{{$purchase->id}}"
       class="singlePurchase-modalView btn btn-success btn-sm brd-3 ml-5"
       data-bs-toggle="modal" data-bs-target="#SinglePurchaseModalView">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Purchase Details">
        <i class="fa fa-eye"></i>
      </span>
    </a>

    {{--@if ( Auth::user()->can('isAdmins') && Auth::user()->can('entryDelete') )
      <a href="{{ route('transaction.receive.delete.single', $purchase->uid) }}"
         onclick="return confirm('Are you sure to delete this receive?');"
         class="delete-receive btn btn-danger btn-sm brd-3 ml-5">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Receive">
          <i class="far fa-trash-alt"></i>
        </span>
      </a>
    @endif--}}
  </div>
</div>