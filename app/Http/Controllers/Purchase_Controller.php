<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Bill_Model;
use App\Rules\ValidAmount;
use App\Models\Parts_Model;
use Illuminate\Support\Str;
use App\Rules\ValidQuantity;
use Illuminate\Http\Request;
use App\Models\Vehicle_Model;
use App\Models\Employee_Model;
use App\Models\Purchase_Model;
use App\Models\Settings_Model;
use App\Models\Supplier_Model;
use Illuminate\Validation\Rule;
use App\Models\Requisition_Model;
use App\Models\PartsCategory_Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Models\PurchaseDetails_Model;
use App\Models\VehicleCategory_Model;
use Illuminate\Support\Facades\Validator;


class Purchase_Controller extends Controller
{
  // Vehicle-Parts Purchase Unique-Number
  protected function VehiclePartsPurchaseNo(): string
  {
    $type = 'vehicle-parts';
    $current_year = date('Y', strtotime(today()));
    $last_purchase = Purchase_Model::whereYear('created_at', $current_year)
      ->latest()->first();

    // VPPNoLastSerial = Vehicle Parts Purchase Number Last-Serial
    // VPPNoNewSerial  = Vehicle Parts Purchase Number New-Serial

    $serialWithZero = '';
    if( $last_purchase ){
      $purchaseNo_arr_1 = explode('-', $last_purchase->purchase_no);
      $purchaseNo_arr_2 = explode('/', $purchaseNo_arr_1[1]);
      // $lastPartsPurchaseNoArr = explode('-', $parts_last_purchase->purchase_no);
      $VPPNoLastSerial = (int) $purchaseNo_arr_2[1];
      $VPPNoNewSerial = $VPPNoLastSerial + 1;

      if( $VPPNoNewSerial < 10 ){
        $serialWithZero = '0000' . $VPPNoNewSerial;
      } elseif( $VPPNoNewSerial < 100 ){
        $serialWithZero = '000' . $VPPNoNewSerial;
      } elseif( $VPPNoNewSerial < 1000 ){
        $serialWithZero = '00' . $VPPNoNewSerial;
      } elseif( $VPPNoNewSerial < 10000 ){
        $serialWithZero = '0' . $VPPNoNewSerial;
      } else{
        $serialWithZero = $VPPNoNewSerial;
      }
    } else{
      $serialWithZero = '00001';
    }

    $newPurchaseNo = 'PR-' . $current_year . '/' . $serialWithZero;
    return $newPurchaseNo;
  }


  // Vehicle-Parts Purchase-Index
  public function VehiclePartsPurchase_Index( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'date_start' => [ 'nullable', 'date_format:d-m-Y' ],
      'date_end'   => [ 'nullable', 'date_format:d-m-Y' ],
    ], [
      'date_start.date_format' => 'The from-date does not match the format (' . date('d-m-Y') . ').',
      'date_end.date_format'   => 'The to-date does not match the format (' . date('d-m-Y') . ').',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $purchase_type  = 'vehicle-parts';
    $vehicleParts_purchase_all = null;

    $search_by         = $request->search_by ?? null;
    $date_start        = $request->date_start ?? null;
    $date_end          = $request->date_end ?? null;
    $parts_id          = $request->parts_id ?? null; // Filter in View
    // $parts_category    = $request->parts_category ?? null; // Filter in View
    $country_origin    = $request->country_origin ?? null; // Filter in View
    $vehicle_id        = $request->vehicle_id ?? null; // Filter in View
    // $vehicle_category  = $request->vehicle_category ?? null; // Filter in View
    // $supplier_by       = $request->supplier_by ?? null; // Not Filtered yet
    // $purchased_by      = $request->purchased_by ?? null;
    // $authorized_by     = $request->authorized_by ?? null;

    $start_date        = $date_start ? DateTime::createFromFormat('d-m-Y', $date_start)->format('Y-m-d') : null;
    $end_date          = $date_end ? DateTime::createFromFormat('d-m-Y', $date_end)->format('Y-m-d') : null;
    $parts_id          = $parts_id == 'all' || $parts_id == "" || $parts_id == null ? null : $parts_id;
    $country_origin    = $country_origin == 'all' || $country_origin == "" || $country_origin == null ? null : $country_origin;
    $vehicle_id        = $vehicle_id == 'all' || $vehicle_id == "" || $vehicle_id == null ? null : $vehicle_id;
    /* $parts_category    = $parts_category == 'all' || $parts_category == "" || $parts_category == null ? null : $parts_category;
    $vehicle_category  = $vehicle_category == 'all' || $vehicle_category == "" || $vehicle_category == null ? null : $vehicle_category;
    $supplier_by       = $supplier_by == 'all' || $supplier_by == "" || $supplier_by == null ? null : $supplier_by;
    $purchased_by      = $purchased_by == 'all' || $purchased_by == "" || $purchased_by == null ? null : $purchased_by;
    $authorized_by     = $authorized_by == 'all' || $authorized_by == "" || $authorized_by == null ? null : $authorized_by; */

    $searchColumns       = [ 'purchase_no', 'memo_no', 'requisition_no', 'shop_name', 'shop_contact', 'shop_location', 'bill_no' ];
    /* $purchasedBy_column  = [ ['purchased_by', '=', $purchased_by] ];
    $authorizedBy_column = [ ['authorized_by', '=', $authorized_by] ]; */


    /* supplier-by filter not applied yet */


    // Filter or Search using relation
    /* $purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
      ->whereDate('date', '>=', date($start_date))
      //->whereDate('date', '<=', date($end_date))
      ->orderBy('date', 'desc')
      //->with('details')->has('details')
      //->whereRelation('details', 'parts_id', '=', $parts_id)
      ->whereHas('details', function($query) use($parts_id){
        $query->where('parts_id', '=', $parts_id);
      })
      ->get()->all();*/
    
    
    // search criteria for start-date, end-date, search-by, purchased-by & authorized-by
    /* if( $start_date && $end_date && $search_by && $purchased_by && $authorized_by ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->where( $purchasedBy_column )
        ->where( $authorizedBy_column )
        ->orderBy('date', 'desc')->get()->all();
    } */


    // search criteria only for start-date
    if( $start_date && !$end_date && !$search_by && !$parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date & end-date
    elseif( $start_date && $end_date && !$search_by && !$parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date & search-by
    elseif( $start_date && !$end_date && $search_by && !$parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date & parts-id
    elseif( $start_date && !$end_date && !$search_by && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date & country-origin
    elseif( $start_date && !$end_date && !$search_by && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date & vehicle-id
    elseif( $start_date && !$end_date && !$search_by && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date & search-by
    elseif( $start_date && $end_date && $search_by && !$parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date & parts-id
    elseif( $start_date && $end_date && !$search_by && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date & country-origin
    elseif( $start_date && $end_date && !$search_by && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date & vehicle-id
    elseif( $start_date && $end_date && !$search_by && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, search-by & parts-id
    elseif( $start_date && !$end_date && $search_by && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, search-by & country-origin
    elseif( $start_date && !$end_date && $search_by && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, search-by & vehicle-id
    elseif( $start_date && !$end_date && $search_by && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, parts-id & country-origin
    elseif( $start_date && !$end_date && !$search_by && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, parts-id & vehicle-id
    elseif( $start_date && !$end_date && !$search_by && $parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, country-origin & vehicle-id
    elseif( $start_date && !$end_date && !$search_by && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, parts-id, country-origin & vehicle-id
    elseif( $start_date && !$end_date && !$search_by && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, search-by & parts-id
    elseif( $start_date && $end_date && $search_by && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, search-by & country-origin
    elseif( $start_date && $end_date && $search_by && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, search-by & vehicle-id
    elseif( $start_date && $end_date && $search_by && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, search-by, parts-id & country-origin
    elseif( $start_date && $end_date && $search_by && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, search-by, parts-id & vehicle-id
    elseif( $start_date && $end_date && $search_by && $parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, search-by, country-origin & vehicle-id
    elseif( $start_date && $end_date && $search_by && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, parts-id & country-origin
    elseif( $start_date && $end_date && !$search_by && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, parts-id & vehicle-id
    elseif( $start_date && $end_date && !$search_by && $parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, country-origin & vehicle-id
    elseif( $start_date && $end_date && !$search_by && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, end-date, parts-id, country-origin & vehicle-id
    elseif( $start_date && $end_date && !$search_by && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, search-by, parts-id & country-origin
    elseif( $start_date && !$end_date && $search_by && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, search-by, parts-id & vehicle-id
    elseif( $start_date && !$end_date && $search_by && $parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, search-by, country-origin & vehicle-id
    elseif( $start_date && !$end_date && $search_by && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for start-date, search-by, parts-id, country-origin & vehicle-id
    elseif( $start_date && !$end_date && $search_by && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for end-date
    elseif( $end_date && !$start_date && !$search_by && !$parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date & search-by
    elseif( $end_date && !$start_date && $search_by && !$parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date & parts-id
    elseif( $end_date && !$start_date && !$search_by && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date & country-origin
    elseif( $end_date && !$start_date && !$search_by && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date & vehicle-id
    elseif( $end_date && !$start_date && !$search_by && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, search-by & parts-id
    elseif( $end_date && !$start_date && $search_by && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, search-by & country-origin
    elseif( $end_date && !$start_date && $search_by && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, search-by & vehicle-id
    elseif( $end_date && !$start_date && $search_by && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, parts-id & country-origin
    elseif( $end_date && !$start_date && !$search_by && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, parts-id & vehicle-id
    elseif( $end_date && !$start_date && !$search_by && $parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, country-origin & vehicle-id
    elseif( $end_date && !$start_date && !$search_by && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, parts-id, country-origin & vehicle-id
    elseif( $end_date && !$start_date && !$search_by && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, search-by, parts-id & country-origin
    elseif( $end_date && !$start_date && $search_by && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, search-by, country-origin & vehicle-id
    elseif( $end_date && !$start_date && $search_by && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for end-date, search-by, parts-id, country-origin & vehicle-id
    elseif( $end_date && !$start_date && $search_by && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for search-by
    elseif( $search_by && !$start_date && !$end_date && !$parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for search-by & parts-id
    elseif( $search_by && !$start_date && !$end_date && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for search-by & country-origin
    elseif( $search_by && !$start_date && !$end_date && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for search-by & vehicle-id
    elseif( $search_by && !$start_date && !$end_date && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for search-by, parts-id & country-origin
    elseif( $search_by && !$start_date && !$end_date && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for search-by, parts-id & vehicle-id
    elseif( $search_by && !$start_date && !$end_date && $parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for search-by, country-origin & vehicle-id
    elseif( $search_by && !$start_date && !$end_date && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria for search-by, parts-id, country-origin & vehicle-id
    elseif( $search_by && !$start_date && !$end_date && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for parts-id
    elseif( !$start_date && !$end_date && !$search_by && $parts_id && !$country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for country-origin
    elseif( !$start_date && !$end_date && !$search_by && !$parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereRelation('details', 'origin', '=', $country_origin)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for vehicle-id
    elseif( !$start_date && !$end_date && !$search_by && !$parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for parts-id & country-origin
    elseif( !$start_date && !$end_date && !$search_by && $parts_id && $country_origin && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for parts-id & vehicle-id
    elseif( !$start_date && !$end_date && !$search_by && $parts_id && !$country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for country-origin & vehicle-id
    elseif( !$start_date && !$end_date && !$search_by && !$parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($country_origin, $vehicle_id){
          $query->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for parts-id, country-origin & vehicle-id
    elseif( !$start_date && !$end_date && !$search_by && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // search criteria only for start-date, end-date, search-by, parts-id, country-origin & vehicle-id
    elseif( $start_date && $end_date && $search_by && $parts_id && $country_origin && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->whereDate('date', '>=', date($start_date))
        ->whereDate('date', '<=', date($end_date))
        ->where( function($q) use( $searchColumns, $search_by ){
          foreach( $searchColumns as $column )
            $q->orWhere( $column, 'like', "%{$search_by}%" );
        })
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $country_origin, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('origin', '=', $country_origin)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy('date', 'desc')->get()->all();
    }
    // no-search criteria - get all
    else{
      $vehicleParts_purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
        ->orderBy('date', 'desc')->get()->all();
    }


    $parts_all            = Parts_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_all          = Vehicle_Model::orderBy('vehicle_no', 'asc')->get()->all();
    /* $parts_category_all   = PartsCategory_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_category_all = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();
    $supplier_all         = Supplier_Model::orderBy('name', 'asc')->get()->all();
    $purchaser_all        = Employee_Model::where('purchase_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all();
    $authorizer_all       = Employee_Model::where('authorize_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all(); */

    $settings      = Settings_Model::get()->first();
    $date_format   = $settings && $settings->date_format ? $settings->date_format : 'd-M-Y';
    $time_format   = $settings && $settings->time_format ? $settings->time_format : 'h:i A';

    /* supplier-by filter not applied yet */

    return view('modules.vehicle-module.purchase-parts.index')->with([
      'search_by'             => $search_by,
      'date_start'            => $date_start,
      'date_end'              => $date_end,
      'date_format'           => $date_format,
      'time_format'           => $time_format,
      'parts_id'              => $parts_id,
      'parts_all'             => $parts_all,
      'country_origin'        => $country_origin,
      'countries'             => Countries(),
      'vehicle_id'            => $vehicle_id,
      'vehicle_all'           => $vehicle_all,
      'purchases_all'         => $vehicleParts_purchase_all,
      /* 'purchase_type'         => $purchase_type,
      'purchase_type_all'     => PurchaseTypes(),
      'purchased_by'          => $purchased_by,
      'purchaser_all'         => $purchaser_all,
      'authorized_by'         => $authorized_by,
      'authorizer_all'        => $authorizer_all,
      'parts_category'        => $parts_category,
      'parts_category_all'    => $parts_category_all,
      'vehicle_category'      => $vehicle_category,
      'vehicle_category_all'  => $vehicle_category_all,
      'supplier_by'           => $supplier_by, */
    ]);
  }


  // Show Vehicle-Parts Purchase-Form
  public function VehiclePartsPurchase_Form( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $purchaseType = 'vehicle-parts';

    $parts_all            = Parts_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_all          = Vehicle_Model::orderBy('vehicle_no', 'asc')->get()->all();
    $parts_category_all   = PartsCategory_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_category_all = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();

    $purchaser_all        = Employee_Model::where('purchase_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all();
    $authorizer_all       = Employee_Model::where('authorize_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all();
    $employee_all         = Employee_Model::where('active', 1)
      ->orderBy('name', 'asc')->get()->all();

    $supplier_all         = Supplier_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.purchase-parts.new')->with([
      'newPurchaseNo'         => $this->VehiclePartsPurchaseNo(),
      'purchaseType'          => $purchaseType,
      'purchase_types'        => PurchaseTypes(),
      'units'                 => Units(),
      'countries'             => Countries(),
      'parts_all'             => $parts_all,
      'vehicle_all'           => $vehicle_all,
      'supplier_all'          => $supplier_all,
      'employee_all'          => $employee_all,
      'purchaser_all'         => $purchaser_all,
      'authorizer_all'        => $authorizer_all,
      'parts_category_all'    => $parts_category_all,
      'vehicle_category_all'  => $vehicle_category_all,
    ]);
  }


  // Store Newly Purchased Vehicle-Parts
  public function VehiclePartsPurchase_Store( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $session_id = null;
    if( $request->session()->has('session_id') ){
      $session_id = $request->session()->get('session_id');
    }

    $type           = 'vehicle-parts';
    $purchase_date  = $request->date ? DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d') : date('Y-m-d', strtotime(today()));
    $requisition    = Requisition_Model::where('requisition_no', $request->requisition_no)->get()->first();
    $billed         = Bill_Model::where('bill_no', $request->bill_no)->get()->first();

    /*$purchaser      = Employee_Model::where('id', $request->purchased_by)
      ->where('purchase_power', 1)->where('active', 1)->get()->first();
    $authorizer     = Employee_Model::where('id', $request->authorized_by)
      ->where('authorize_power', 1)->where('active', 1)->get()->first();
    $supplier       = Supplier_Model::find($request->supplier_id);
    $entry_by       = Employee_Model::where('id', $request->entry_by)
      ->where('active', 1)->get()->first();*/

    $total_qty = 0; $total_amount = 0; $paid_amount = 0; $due_amount = 0;
    $input_total_qty    = (int) $request->total_qty;
    $input_total_amount = (int) $request->total_amount;
    $input_paidAmount   = (int) $request->paid_amount;
    $input_dueAmount    = (int) $request->due_amount;
    $is_full_paid       = $request->has('is_paid') && $request->is_paid == 'full-paid';
    $is_partial_paid    = $request->has('is_partial_paid') && $request->is_partial_paid == 'partial-paid';

    $validator = Validator::make( $request->all(), [
      /*Rule::unique('employees')->where(function ($query) use($purchaser_id, $purchase_power) {
        return $query->where('purchase_power', $purchase_power)->where('id', $purchaser_id);
      }),*/
      'purchase_type'  => [ 'required', "in:$type", 'string', 'max:15' ],
      'date'           => [ 'required', 'date_format:d-m-Y' ],
      'memo_no'        => [ 'required', 'string', 'max:6' ],
      'vehicle_id'     => [ 'required', 'integer', 'exists:vehicles,id' ],
      'bill_no'        => [ 'nullable', 'string', 'max:15', 'exists:bills,bill_no' ],
      'shop_name'      => [ 'required', 'string', 'max:50' ],
      'shop_contact'   => [ 'required', 'digits:11' ],
      'shop_location'  => [ 'nullable', 'string', 'max:20' ],
      'purchased_by'   => [ 'required', 'integer', 'exists:employees,id,purchase_power,1,active,1' ],
      'authorized_by'  => [ 'nullable', 'integer', 'exists:employees,id,authorize_power,1,active,1' ],
      'notes'          => [ 'nullable', 'string', 'max:1000' ],
      'entry_by'       => [ Rule::requiredIf(!auth()->user()), 'integer', 'exists:employees,id,active,1' ],

      'total_qty'      => [ 'required', 'numeric', 'min:1', 'max:10000000' ],
      'total_amount'   => [ 'required', 'numeric', 'min:0', 'max:9000000000' ],

      /* 'total_qty'      => [ 'required', 'numeric', 'digits_between:1,8' ],
      'total_amount'   => [ 'required', 'numeric', 'digits_between:1,10' ],
      'total_qty'      => [ 'required', 'numeric', new ValidQuantity ],
      'total_amount'   => [ 'required', 'numeric', new ValidAmount ], */
      
      // 'purchaser_name' => [ 'required_unless:purchased_by,null', 'string', 'max:50' ],
      // 'checked_by'     => [ 'nullable', 'integer', 'exists:employees,id,active,1' ],
      // 'requisition_no' => [ 'nullable', 'string', 'max:15', 'exists:requisitions,requisition_no' ],
      // 'supplier_id'    => [ 'nullable', 'integer', 'exists:suppliers,id' ],
      // 'supplier_name'  => [ 'required_unless:supplier_id,null', 'string', 'max:50' ],
    ], [
      'purchase_type.in'    => 'Only vehicle-parts is allowed.',
      'memo_no.required'    => 'The memo-number is required.',
      'vehicle_id.required' => 'The vehicle-number is required.',
      'vehicle_id.exists'   => 'The vehicle-number does not exists.',
      'date.date_format'    => 'The date does not match the correct format (Day-Month-FullYear).',
      'total_qty.max'       => 'The total-qty must not be greater than 1,00,00,000',
      'total_amount.max'    => 'The total-amount must not be greater than 900,00,00,000',
    ]);
    if( $validator->fails() || $input_paidAmount > $input_total_amount || $input_dueAmount > $input_total_amount
      || (($input_paidAmount + $input_dueAmount) > $input_total_amount) ){
      if( $input_paidAmount > $input_total_amount ) $validator->errors()->add('paid_amount', 'Paid amount exceeds the total amount.');
      if( $input_dueAmount > $input_total_amount ) $validator->errors()->add('due_amount', 'Due amount exceeds the total amount.');
      if( ($input_paidAmount + $input_dueAmount) > $input_total_amount ){
        $validator->errors()->add('paid_amount', 'Paid & Due amount exceeds the total amount.');
        $validator->errors()->add('due_amount', 'Paid & Due amount exceeds the total amount.');
      }
      return back()->withErrors( $validator )->withInput();
    }


    // Get All Purchased Items
    $items_name       = $request->input('item_name');
    $items_id         = $request->input('item_id');
    $items_uid        = $request->input('item_uid');
    $items_slug       = $request->input('item_slug');
    $items_country    = $request->input('item_country');
    $items_size       = $request->input('item_size');
    $items_serials    = $request->input('item_serials');
    $items_quantity   = $request->input('item_qty');
    $items_unit       = $request->input('item_unit');
    $items_unit_price = $request->input('item_unit_price');
    $items_amount     = $request->input('item_amount');
    $items_remarks    = $request->input('item_remarks');
    
    $countries = [];
    foreach( Countries() as $country ){
      $countries[] = $country['slug'];
    }
    
    
    // Check item name, quantity & amount has value
    $has_item_name = []; $country_not_present = []; $qty_not_present = []; 
    $qty_too_much = []; $amount_not_present = []; $amount_too_much = []; 
    $has_country_without_item = []; $has_qty_without_item = []; 
    $has_amount_without_item = []; $remarks_too_long = [];
    foreach( $items_name as $key => $item_name ){
      if( $item_name ){
        $has_item_name[] = $item_name;
        if( ! in_array( $items_country[$key], $countries ) ){
          $country_not_present[] = ($key + 1);
        }
        if( ! $items_quantity[$key] || (int)$items_quantity[$key] == 0 ){
          $qty_not_present[] = ($key + 1);
        } elseif( $items_quantity[$key] > 10000000 ){
          // check item-qty length = Maximum 1 crore (1,00,00,000) allowed
          $qty_too_much[] = ($key + 1);
        }
        if( ! $items_amount[$key] ){
          $amount_not_present[] = ($key + 1);
        } elseif( $items_amount[$key] > 9000000000 ){
          // check item-amount length = Maximum 900 crore (900,00,00,000) allowed
          $amount_too_much[] = ($key + 1);
        }
        if( strlen($items_remarks[$key]) > 191 ){
          $remarks_too_long[] = ($key + 1);
        }
      } elseif( empty($item_name) ){
        if( in_array( $items_country[$key], $countries ) || empty($items_country[$key]) ){
          $has_country_without_item[] = ($key + 1);
        }
        if( $items_quantity[$key] ){
          $has_qty_without_item[] = ($key + 1);
        }
        if( $items_amount[$key] ){
          $has_amount_without_item[] = ($key + 1);
        }
      }
    }

    // Send error message if item name, quantity & amount has not value
    if( count($has_item_name) < 1 || count($country_not_present) > 0 || count($has_country_without_item) > 0 || count($qty_too_much) > 0 || count($qty_not_present) > 0 || count($amount_too_much) > 0 || count($amount_not_present) > 0 || count($has_qty_without_item) > 0 || count($has_amount_without_item) > 0 || count($remarks_too_long) > 0 ){
      if( count($has_item_name) < 1 ){
        session()->flash('error', 'Minimum 1 item required.');

      } elseif( count($country_not_present) > 0 ){
        $lineNumbers = implode(', ', $country_not_present);
        session()->flash('error', "Item country not present on line number ($lineNumbers).");

      } elseif( count($qty_too_much) > 0 ){
        $lineNumbers = implode(', ', $qty_too_much);
        session()->flash('error', "Item-qty exceeds maximum limit of 1,00,00,000 on line number ($lineNumbers).");

      } elseif( count($qty_not_present) > 0 ){
        $lineNumbers = implode(', ', $qty_not_present);
        session()->flash('error', "Item quantity not present on line number ($lineNumbers).");

      } elseif( count($amount_too_much) > 0 ){
        $lineNumbers = implode(', ', $amount_too_much);
        session()->flash('error', "Item-amount exceeds maximum limit of 900,00,00,000 on line number ($lineNumbers).");

      } elseif( count($amount_not_present) > 0 ){
        $lineNumbers = implode(', ', $amount_not_present);
        session()->flash('error', "Item amount not present on line number ($lineNumbers).");

      } elseif( count($has_country_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_country_without_item);
        session()->flash('error', "Item name not present on line number ($lineNumbers).");

      } elseif( count($has_qty_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_qty_without_item);
        session()->flash('error', "Item name not present on line number ($lineNumbers).");

      } elseif( count($has_amount_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_amount_without_item);
        session()->flash('error', "Item name not present on line number ($lineNumbers).");

      } elseif( count($remarks_too_long) > 0 ){
        $lineNumbers = implode(', ', $remarks_too_long);
        session()->flash('error', "Item remarks too long on line number ($lineNumbers).");
      }
      return back()->withInput();
    }


    // Purchased-Items Details Data
    $get_all_parts = Parts_Model::all();

    $purchasedItems_All = [];
    foreach( $items_name as $index => $name ){
      if( $name ){
        $id = $items_id[$index]; $uid = $items_uid[$index]; $slug = $items_slug[$index];
        $get_parts = $get_all_parts->first(function($item, $itemKey) use ($id, $uid, $name, $slug){
          // return $item->id == $id && $item->uid == $uid && $item->name == $item_name && $item->slug == $slug;
          return $item->id == $id && $item->name == $name;
        });

        if( ! $get_parts ){
          $lineNumbers = ($index + 1);
          session()->flash('error', "Item not matched on line number ($lineNumbers).");
          return back()->withInput();
        }

        $unit_price = (int) $items_amount[$index] / (int) $items_quantity[$index];

        $item_details = [
          // 'uid'           => Str::uuid(),
          // 'purchase_id'   => null,
          // 'purchase_no'   => null,
          'type'           => $type,
          'parts_id'       => $get_parts->id,
          'vehicle_id'     => $request->vehicle_id ?? null,
          'origin'         => $items_country[$index],
          'size'           => $items_size[$index],
          'serials'        => $items_serials[$index],
          'quantity'       => $items_quantity[$index],
          'unit'           => $items_unit[$index],
          'unit_price'     => $unit_price,
          'amount'         => $items_amount[$index],
          // 'amount'         => strval(number_format($item_price, 2)),
          // 'amount'         => strval(number_format($item_price, 2, '.', '')),
          'remarks'        => $items_remarks[$index],
        ];
        $total_qty    += (int)$items_quantity[$index];
        $total_amount += (int)$items_amount[$index];
        $purchasedItems_All[] = $item_details;
      }
    }

    if( $total_qty > 10000000 ){
      // check total-qty length = Maximum 1 crore (1,00,00,000) allowed
      session()->flash('error', 'The total-qty exceeds maximum limit of 1,00,00,000.');
      return back()->withInput();

    } elseif( $total_amount > 9000000000 ){
      // check total-amount length = Maximum 900 crore (900,00,00,000) allowed
      session()->flash('error', 'The total-amount exceeds maximum limit of 900,00,00,000.');
      return back()->withInput();

    } elseif( $input_total_qty != $total_qty || $input_total_amount != $total_amount ){
      session()->flash('error', 'Total-Qty or Total-Amount not matched.');
      return back()->withInput();
    }

    if( $is_full_paid && $input_paidAmount == $total_amount ){
      $paid_amount = $total_amount;
      $due_amount  = 0;
    } else{
      $paid_amount = $input_paidAmount;
      $due_amount  = $input_dueAmount;
    }

    $NewPurchase = [
      'uid'             => Str::uuid(),
      'purchase_no'     => $this->VehiclePartsPurchaseNo(),
      'purchase_type'   => $type,
      'date'            => $purchase_date,
      'memo_no'         => $request->memo_no,
      'vehicle_id'      => $request->vehicle_id ?? null,
      'requisition_id'  => $requisition ? $requisition->id : null,
      'requisition_no'  => $requisition ? $requisition->requisition_no : null,
      'purchased_by'    => $request->purchased_by ?? null,
      'purchaser_name'  => ! $request->purchased_by ? $request->purchaser_name : null,
      'authorized_by'   => $request->authorized_by ?? null,
      'checked_by'      => null,
      'supplier_id'     => $request->supplier_id ?? null,
      'supplier_name'   => ! $request->supplier_id ? ($request->supplier_name ?? null) : null,
      'shop_name'       => ucwords( strtolower($request->shop_name) ),
      'shop_slug'       => Str::slug( $request->shop_name ),
      'shop_contact'    => $request->shop_contact,
      'shop_location'   => ucwords( strtolower($request->shop_location) ),
      'total_qty'       => $total_qty,
      'total_amount'    => $total_amount,
      'is_paid'         => $is_full_paid,
      'is_partial_paid' => $is_partial_paid,
      'paid_amount'     => $paid_amount,
      'due_amount'      => $due_amount,
      'bill_id'         => $billed ? $billed->id : null,
      'bill_no'         => $billed ? $billed->bill_no : null,
      'user_id'         => Auth::check() ? Auth::id() : null,
      'entry_by'        => !Auth::check() && $request->entry_by ? $request->entry_by : null,
      'notes'           => (string) $request->notes,
      'device'          => null,
      'ip'              => request()->ip(),
      'ip_address'      => $request->ip(),
      'session_id'      => $session_id,
    ];
    $newPurchase_Created = Purchase_Model::create( $NewPurchase );

    // Create Purchase-Items-Details
    foreach( $purchasedItems_All as $purchasedItemDetails ){
      $purchasedItemDetails['uid']         = Str::uuid();
      $purchasedItemDetails['purchase_id'] = $newPurchase_Created->id;
      $purchasedItemDetails['purchase_no'] = $newPurchase_Created->purchase_no;

      PurchaseDetails_Model::create( $purchasedItemDetails );
    }

    return back()->with('success', "Purchase No.# ($newPurchase_Created->purchase_no) saved successfully!");
  }
  
  
  // Show Vehicle-Parts-Purchase-Edit-Form
  public function VehiclePartsPurchase_EditForm( Purchase_Model $purchase, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $purchase ){
      return back()->with('error', 'Selected purchase not found in system.');
    }

    $purchaseType  = 'vehicle-parts';
    $securityToken = $purchase->uid . '-68u1d';

    $parts_all            = Parts_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_all          = Vehicle_Model::orderBy('vehicle_no', 'asc')->get()->all();
    $parts_category_all   = PartsCategory_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_category_all = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();

    $purchaser_all        = Employee_Model::where('purchase_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all();
    $authorizer_all       = Employee_Model::where('authorize_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all();
    $employee_all         = Employee_Model::where('active', 1)
      ->orderBy('name', 'asc')->get()->all();

    $supplier_all         = Supplier_Model::orderBy('name', 'asc')->get()->all();

    /* $settings      = Settings_Model::get()->first();
    $date_format   = $settings && $settings->date_format ? $settings->date_format : 'd-m-Y'; */

    $date_format = 'd-m-Y';

    return view('modules.vehicle-module.purchase-parts.edit')->with([
      'purchase'              => $purchase,
      'date_format'           => $date_format,
      'securityToken'         => $securityToken,
      'units'                 => Units(),
      'countries'             => Countries(),
      'purchase_types'        => PurchaseTypes(),
      'parts_all'             => $parts_all,
      'vehicle_all'           => $vehicle_all,
      'supplier_all'          => $supplier_all,
      'employee_all'          => $employee_all,
      'purchaser_all'         => $purchaser_all,
      'authorizer_all'        => $authorizer_all,
      'parts_category_all'    => $parts_category_all,
      'vehicle_category_all'  => $vehicle_category_all,
    ]);
  }


  // Update Vehicle-Parts-Purchase
  public function VehiclePartsPurchase_Update( Purchase_Model $purchase, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/
    
    $securityToken = $purchase->uid . '-68u1d';
    if( ! $purchase || $request->input('token') != $securityToken ){
      return back()->with('error', 'Selected purchase not found in system.');
    }
    
    $session_id = null;
    if( $request->session()->has('session_id') ){
      $session_id = $request->session()->get('session_id');
    }

    $type           = 'vehicle-parts';
    $purchase_date  = $request->date ? DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d') : date('Y-m-d', strtotime(today()));
    $requisition    = Requisition_Model::where('requisition_no', $request->requisition_no)->first();
    $billed         = Bill_Model::where('bill_no', $request->bill_no)->first();

    /*$purchaser      = Employee_Model::where('id', $request->purchased_by)
      ->where('purchase_power', 1)->where('active', 1)->get()->first();
    $authorizer     = Employee_Model::where('id', $request->authorized_by)
      ->where('authorize_power', 1)->where('active', 1)->get()->first();
    $supplier       = Supplier_Model::find($request->supplier_id);
    $entry_by       = Employee_Model::where('id', $request->entry_by)
      ->where('active', 1)->get()->first();*/

    $total_qty = 0; $total_amount = 0; $paid_amount = 0; $due_amount = 0;
    $input_total_qty    = (int) $request->total_qty;
    $input_total_amount = (int) $request->total_amount;
    $input_paidAmount   = (int) $request->paid_amount;
    $input_dueAmount    = (int) $request->due_amount;
    $is_full_paid       = $request->has('is_paid') && $request->is_paid == 'full-paid';
    $is_partial_paid    = $request->has('is_partial_paid') && $request->is_partial_paid == 'partial-paid';

    $validator = Validator::make( $request->all(), [
      /*Rule::unique('employees')->where(function ($query) use($purchaser_id, $purchase_power) {
        return $query->where('purchase_power', $purchase_power)->where('id', $purchaser_id);
      }),*/
      'purchase_no'    => [ 'required', "in:$purchase->purchase_no", 'string' ],
      'purchase_type'  => [ 'required', "in:$type", 'string' ],
      'date'           => [ 'required', 'date_format:d-m-Y' ],
      'memo_no'        => [ 'required', 'string', 'max:6' ],
      'vehicle_id'     => [ 'required', 'integer', 'exists:vehicles,id' ],
      'bill_no'        => [ 'nullable', 'string', 'max:15', 'exists:bills,bill_no' ],
      'shop_name'      => [ 'required', 'string', 'max:50' ],
      'shop_contact'   => [ 'required', 'digits:11' ],
      'shop_location'  => [ 'nullable', 'string', 'max:20' ],
      'purchased_by'   => [ 'required', 'integer', 'exists:employees,id,purchase_power,1,active,1' ],
      'authorized_by'  => [ 'nullable', 'integer', 'exists:employees,id,authorize_power,1,active,1' ],
      'notes'          => [ 'nullable', 'string', 'max:1000' ],
      'entry_by'       => [ Rule::requiredIf(!auth()->user()), 'integer', 'exists:employees,id,active,1' ],

      'total_qty'      => [ 'required', 'numeric', 'min:1', 'max:10000000' ],
      'total_amount'   => [ 'required', 'numeric', 'min:0', 'max:9000000000' ],

      /* 'total_qty'      => [ 'required', 'numeric', 'digits_between:1,8' ],
      'total_amount'   => [ 'required', 'numeric', 'digits_between:1,10' ],
      'total_qty'      => [ 'required', 'numeric', new ValidQuantity ],
      'total_amount'   => [ 'required', 'numeric', new ValidAmount ], */

      // 'purchaser_name' => [ 'required_unless:purchased_by,null', 'string', 'max:50' ],
      // 'checked_by'     => [ 'nullable', 'integer', 'exists:employees,id,active,1' ],
      // 'requisition_no' => [ 'nullable', 'string', 'max:15', 'exists:requisitions,requisition_no' ],
      // 'supplier_id'    => [ 'nullable', 'integer', 'exists:suppliers,id' ],
      // 'supplier_name'  => [ 'required_unless:supplier_id,null', 'string', 'max:50' ],
    ], [
      'purchase_no.in'      => "The purchase-no can't be changed.",
      'purchase_type.in'    => 'Only vehicle-parts is allowed.',
      'memo_no.required'    => 'The memo-number is required.',
      'vehicle_id.required' => 'The vehicle-number is required.',
      'vehicle_id.exists'   => 'The vehicle-number does not exists.',
      'date.date_format'    => 'The date does not match the correct format (Day-Month-FullYear).',
      'total_qty.max'       => 'The total-qty must not be greater than 1,00,00,000',
      'total_amount.max'    => 'The total-amount must not be greater than 900,00,00,000',
    ]);
    if( $validator->fails() || $input_paidAmount > $input_total_amount || $input_dueAmount > $input_total_amount
      || (($input_paidAmount + $input_dueAmount) > $input_total_amount) ){
      if( $input_paidAmount > $input_total_amount ) $validator->errors()->add('paid_amount', 'Paid amount exceeds the total amount.');
      if( $input_dueAmount > $input_total_amount ) $validator->errors()->add('due_amount', 'Due amount exceeds the total amount.');
      if( ($input_paidAmount + $input_dueAmount) > $input_total_amount ){
        $validator->errors()->add('paid_amount', 'Paid & Due amount exceeds the total amount.');
        $validator->errors()->add('due_amount', 'Paid & Due amount exceeds the total amount.');
      }
      return back()->withErrors( $validator )->withInput();
    }
    
    
    // Get All Purchased Items
    $previousItems_id  = $request->input('previousItem_id');
    $previousItems_uid = $request->input('previousItem_uid');
    
    $items_name        = $request->input('item_name');
    $items_id          = $request->input('item_id');
    $items_uid         = $request->input('item_uid');
    $items_slug        = $request->input('item_slug');
    $items_country     = $request->input('item_country');
    $items_size        = $request->input('item_size');
    $items_serials     = $request->input('item_serials');
    $items_quantity    = $request->input('item_qty');
    $items_unit        = $request->input('item_unit');
    $items_unit_price  = $request->input('item_unit_price');
    $items_amount      = $request->input('item_amount');
    $items_remarks     = $request->input('item_remarks');
    
    $countries = [];
    foreach( Countries() as $country ){
      $countries[] = $country['slug'];
    }

    
    // Check item name, quantity & amount has value
    $has_item_name = []; $country_not_present = []; $qty_not_present = []; $amount_not_present = []; $qty_too_much = []; $amount_too_much = [];
    $has_country_without_item = []; $has_qty_without_item = []; 
    $has_amount_without_item = []; $remarks_too_long = [];
    foreach( $items_name as $key => $item_name ){
      if( $item_name ){
        $has_item_name[] = $item_name;
        if( ! in_array( $items_country[$key], $countries ) ){
          $country_not_present[] = ($key + 1);
        }
        if( ! $items_quantity[$key] || (int)$items_quantity[$key] == 0 ){
          $qty_not_present[] = ($key + 1);
        } elseif( $items_quantity[$key] > 10000000 ){
          // check item-qty length = Maximum 1 crore (1,00,00,000) allowed
          $qty_too_much[] = ($key + 1);
        }
        if( ! $items_amount[$key] ){
          $amount_not_present[] = ($key + 1);
        } elseif( $items_amount[$key] > 9000000000 ){
          // check item-amount length = Maximum 900 crore (900,00,00,000) allowed
          $amount_too_much[] = ($key + 1);
        }
        if( strlen($items_remarks[$key]) > 191 ){
          $remarks_too_long[] = ($key + 1);
        }
      } elseif( empty($item_name) ){
        if( in_array( $items_country[$key], $countries ) || empty($items_country[$key]) ){
          $has_country_without_item[] = ($key + 1);
        }
        if( $items_quantity[$key] ){
          $has_qty_without_item[] = ($key + 1);
        }
        if( $items_amount[$key] ){
          $has_amount_without_item[] = ($key + 1);
        }
      }
    }

    // Send error message if item name, quantity & amount has not value
    if( count($has_item_name) < 1 || count($country_not_present) > 0 || count($qty_too_much) > 0 || count($qty_not_present) > 0 || count($amount_too_much) > 0 || count($amount_not_present) > 0 || count($has_country_without_item) > 0 || count($has_qty_without_item) > 0 || count($has_amount_without_item) > 0 || count($remarks_too_long) > 0 ){
      if( count($has_item_name) < 1 ){
        session()->flash('error', 'Minimum 1 item required.');

      } elseif( count($country_not_present) > 0 ){
        $lineNumbers = implode(', ', $country_not_present);
        session()->flash('error', "Item country not present on line number ($lineNumbers).");

      } elseif( count($qty_too_much) > 0 ){
        $lineNumbers = implode(', ', $qty_too_much);
        session()->flash('error', "Item-qty exceeds maximum limit of 1,00,00,000 on line number ($lineNumbers).");

      } elseif( count($qty_not_present) > 0 ){
        $lineNumbers = implode(', ', $qty_not_present);
        session()->flash('error', "Item-qty not present on line number ($lineNumbers).");

      } elseif( count($amount_too_much) > 0 ){
        $lineNumbers = implode(', ', $amount_too_much);
        session()->flash('error', "Item-amount exceeds maximum limit of 900,00,00,000 on line number ($lineNumbers).");

      } elseif( count($amount_not_present) > 0 ){
        $lineNumbers = implode(', ', $amount_not_present);
        session()->flash('error', "Item-amount not present on line number ($lineNumbers).");

      } elseif( count($has_country_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_country_without_item);
        session()->flash('error', "Item-name not present on line number ($lineNumbers).");

      } elseif( count($has_qty_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_qty_without_item);
        session()->flash('error', "Item-name not present on line number ($lineNumbers).");

      } elseif( count($has_amount_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_amount_without_item);
        session()->flash('error', "Item-name not present on line number ($lineNumbers).");

      } elseif( count($remarks_too_long) > 0 ){
        $lineNumbers = implode(', ', $remarks_too_long);
        session()->flash('error', "Item-remarks too long on line number ($lineNumbers).");
      }
      return back()->withInput();
    }

    // Purchased-Items Details Data
    $get_all_parts = Parts_Model::all();
    $previousItems_All = []; $previousItemsToUpdate = []; $newPurchasedItems_All = [];

    foreach( $previousItems_uid as $index => $previousUid ){
      $item_id = null; $item_uid = null; $name = null; $item_slug = null;
      $get_parts = null; $unit_price = null; $item_details = null;

      // Proceed to Old Purchase Items
      if( ! empty($previousUid) ){
        $previousItem = PurchaseDetails_Model::where('uid', $previousUid)->where('purchase_no', $purchase->purchase_no)->first();
        if( $previousItem ){
          $item_id = $items_id[$index]; $item_uid = $items_uid[$index];
          $name = $items_name[$index]; $item_slug = $items_slug[$index];
          $get_parts = $get_all_parts->first(function($item, $itemKey) use ($item_uid, $name){
            // return $item->id == $item_id && $item->uid == $item_uid && $item->name == $name && $item->slug == $item_slug;
            return $item->uid == $item_uid && $item->name == $name;
          });

          if( ! $get_parts ){
            $lineNumbers = ($index + 1);
            session()->flash('error', "Item not matched on line number ($lineNumbers).");
            return back()->withInput();
          }

          $unit_price = (int) $items_amount[$index] / (int) $items_quantity[$index];

          $item_details = [
            'parts_id'   => $get_parts->id,
            'vehicle_id' => $request->vehicle_id ?? null,
            'origin'     => $items_country[$index],
            'size'       => $items_size[$index],
            'serials'    => $items_serials[$index],
            'quantity'   => $items_quantity[$index],
            'unit'       => $items_unit[$index],
            'unit_price' => $unit_price,
            'amount'     => $items_amount[$index],
            // 'amount'    => strval(number_format($item_price, 2)),
            // 'amount'    => strval(number_format($item_price, 2, '.', '')),
            'remarks'    => $items_remarks[$index],
          ];
          $total_qty     += (int) $items_quantity[$index];
          $total_amount  += (int) $items_amount[$index];
          
          $previousItems_All[]     = $previousItem;
          $previousItemsToUpdate[] = $item_details;
        } else{
          session()->flash('error', 'Previous item not matched with records.');
          return back()->withInput();
        }

      } else{
        // Proceed to New Purchase Items
        $item_id = $items_id[$index]; $item_uid = $items_uid[$index];
        $name = $items_name[$index]; $item_slug = $items_slug[$index];
        $get_parts = $get_all_parts->first(function($item, $itemKey) use ($item_uid, $name){
          // return $item->id == $item_id && $item->uid == $item_uid && $item->name == $name && $item->slug == $item_slug;
          return $item->uid == $item_uid && $item->name == $name;
        });

        if( ! $get_parts ){
          $lineNumbers = ($index + 1);
          session()->flash('error', "Item not matched on line number ($lineNumbers).");
          return back()->withInput();
        }

        $unit_price = (int) $items_amount[$index] / (int) $items_quantity[$index];

        $item_details = [
          // 'uid'         => Str::uuid(),
          // 'purchase_id' => null,
          // 'purchase_no' => null,
          'type'       => $type,
          'parts_id'   => $get_parts->id,
          'vehicle_id' => $request->vehicle_id ?? null,
          'origin'     => $items_country[$index],
          'size'       => $items_size[$index],
          'serials'    => $items_serials[$index],
          'quantity'   => $items_quantity[$index],
          'unit'       => $items_unit[$index],
          'unit_price' => $unit_price,
          'amount'     => $items_amount[$index],
          // 'amount'     => strval(number_format($item_price, 2)),
          // 'amount'     => strval(number_format($item_price, 2, '.', '')),
          'remarks'    => $items_remarks[$index],
        ];
        $total_qty     += (int) $items_quantity[$index];
        $total_amount  += (int) $items_amount[$index];
        $newPurchasedItems_All[] = $item_details;
      }
    }
    
    if( count($previousItems_All) != count($previousItemsToUpdate) ){
      return back()->with('error', 'Something went wrong.');
    }


    if( $total_qty > 10000000 ){
      // check total-qty length = Maximum 1 crore (1,00,00,000) allowed
      session()->flash('error', 'The total-qty exceeds maximum limit of 1,00,00,000.');
      return back()->withInput();

    } elseif( $total_amount > 9000000000 ){
      // check total-amount length = Maximum 900 crore (900,00,00,000) allowed
      session()->flash('error', 'The total-amount exceeds maximum limit of 900,00,00,000.');
      return back()->withInput();

    } elseif( $input_total_qty != $total_qty || $input_total_amount != $total_amount ){
      session()->flash('error', 'Total-Qty or Total-Amount not matched.');
      return back()->withInput();
    }

    if( $is_full_paid && $input_paidAmount == $total_amount ){
      $paid_amount = $total_amount;
      $due_amount  = 0;
    } else{
      $paid_amount = $input_paidAmount;
      $due_amount  = $input_dueAmount;
    }

    $purchaseUpdateData = [
      'date'            => $purchase_date,
      'memo_no'         => $request->memo_no,
      'vehicle_id'      => $request->vehicle_id ?? null,
      'requisition_id'  => $requisition ? $requisition->id : null,
      'requisition_no'  => $requisition ? $requisition->requisition_no : null,
      'purchased_by'    => $request->purchased_by ?? null,
      'purchaser_name'  => ! $request->purchased_by ? $request->purchaser_name : null,
      'authorized_by'   => $request->authorized_by ?? null,
      'checked_by'      => null,
      'supplier_id'     => $request->supplier_id ?? null,
      'supplier_name'   => ! $request->supplier_id ? ($request->supplier_name ?? null) : null,
      'shop_name'       => ucwords( strtolower($request->shop_name) ),
      'shop_slug'       => Str::slug( $request->shop_name ),
      'shop_contact'    => $request->shop_contact,
      'shop_location'   => ucwords( strtolower($request->shop_location) ),
      'total_qty'       => $total_qty,
      'total_amount'    => $total_amount,
      'is_paid'         => $is_full_paid,
      'is_partial_paid' => $is_partial_paid,
      'paid_amount'     => $paid_amount,
      'due_amount'      => $due_amount,
      'bill_id'         => $billed ? $billed->id : null,
      'bill_no'         => $billed ? $billed->bill_no : null,
      'user_id'         => Auth::check() ? Auth::id() : null,
      'entry_by'        => !Auth::check() && $request->entry_by ? $request->entry_by : null,
      'notes'           => (string) $request->notes,
      'device'          => null,
      'ip'              => request()->ip(),
      'ip_address'      => $request->ip(),
      'session_id'      => $session_id,
    ];
    $purchase_updated = tap($purchase)->update( $purchaseUpdateData );


    // Update Old-Purchased-Item-Details
    if( $previousItems_All && count($previousItems_All) > 0 ){
      foreach( $previousItems_All as $item_key => $previous_item ){
        $previous_item->update( $previousItemsToUpdate[$item_key] );
      }
    }

    // Create New-Purchased-Item-Details
    if( $newPurchasedItems_All && count($newPurchasedItems_All) > 0 ){
      foreach( $newPurchasedItems_All as $purchasedItemDetails ){
        $purchasedItemDetails['uid']         = Str::uuid();
        $purchasedItemDetails['purchase_id'] = $purchase->id;
        $purchasedItemDetails['purchase_no'] = $purchase->purchase_no;
  
        PurchaseDetails_Model::create( $purchasedItemDetails );
      }
    }
    
    return redirect()->route('vehicle.parts.purchase.all')
    ->with('success', "Purchase No.# ($purchase_updated->purchase_no) updated successfully!");
  }


  // Search-Form Vehicle-Parts-Purchase
  public function SearchForm_VehiclePartsPurchase( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $parts_all   = Parts_Model::orderBy( 'name', 'asc' )->get()->all();
    $vehicle_all = Vehicle_Model::orderBy( 'vehicle_no', 'asc' )->get()->all();

    return view('modules.vehicle-module.purchase-parts.searchForm')->with([
      'parts_all'     => $parts_all,
      'vehicle_all'   => $vehicle_all,
    ]);
  }


  // Search-Result Vehicle-Parts-Purchase
  public function Search_VehiclePartsPurchase( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator ::make( $request -> all(), [
      'date_start' => [ 'nullable', 'date_format:d-m-Y' ],
      'date_end'   => [ 'nullable', 'date_format:d-m-Y' ],
    ], [
      'date_start.date_format' => 'The from-date does not match the format (' . date( 'd-m-Y' ) . ').',
      'date_end.date_format'   => 'The to-date does not match the format (' . date( 'd-m-Y' ) . ').',
    ]);
    if( $validator->fails() ) return back()->withErrors($validator)->withInput();

    $purchase_type = 'vehicle-parts';
    $vehicleParts_purchase_all = null;

    $date_start = $request -> date_start ?? null;
    $date_end   = $request -> date_end ?? null;
    $parts_id   = $request -> parts_id ?? null; // Filter in View
    $vehicle_id = $request -> vehicle_id ?? null; // Filter in View

    $start_date = $date_start ? DateTime ::createFromFormat( 'd-m-Y', $date_start ) -> format( 'Y-m-d' ) : null;
    $end_date   = $date_end ? DateTime ::createFromFormat( 'd-m-Y', $date_end ) -> format( 'Y-m-d' ) : null;
    $parts_id   = $parts_id == 'all' || $parts_id == '' || $parts_id == null ? null : $parts_id;
    $vehicle_id = $vehicle_id == 'all' || $vehicle_id == '' || $vehicle_id == null ? null : $vehicle_id;


    // Filter or Search using relation
    /*$purchase_all = Purchase_Model::where('purchase_type', $purchase_type)
      ->whereDate('date', '>=', date($start_date))
      //->whereDate('date', '<=', date($end_date))
      ->orderBy('date', 'desc')
      //->with('details')->has('details')
      //->whereRelation('details', 'parts_id', '=', $parts_id)
      ->whereHas('details', function($query) use($parts_id){
        $query->where('parts_id', '=', $parts_id);
      })
      ->get()->all();

    return $purchase_all;*/


    // search criteria only for start-date
    if( $start_date && !$end_date && !$parts_id && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for start-date & end-date
    elseif( $start_date && $end_date && !$parts_id && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        ->whereDate( 'date', '<=', date( $end_date ) )
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for start-date & parts-id
    elseif( $start_date && !$end_date && $parts_id && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for start-date & vehicle-id
    elseif( $start_date && !$end_date && !$parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for start-date, end-date & parts-id
    elseif( $start_date && $end_date && $parts_id && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        ->whereDate( 'date', '<=', date( $end_date ) )
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for start-date, end-date & vehicle-id
    elseif( $start_date && $end_date && !$parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        ->whereDate( 'date', '<=', date( $end_date ) )
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for start-date, parts-id & vehicle-id
    elseif( $start_date && !$end_date && $parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria only for end-date
    elseif( !$start_date && $end_date && !$parts_id && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '<=', date( $end_date ) )
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for end-date & parts-id
    elseif( !$start_date && $end_date && $parts_id && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
      ->whereDate( 'date', '<=', date( $end_date ) )
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for end-date & vehicle-id
    elseif( !$start_date && $end_date && !$parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
      ->whereDate( 'date', '<=', date( $end_date ) )
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for end-date, parts-id & vehicle-id
    elseif( !$start_date && $end_date && $parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '<=', date( $end_date ) )
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for parts-id
    elseif( !$start_date && !$end_date && $parts_id && !$vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereRelation('details', 'parts_id', '=', $parts_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for parts-id & vehicle-id
    elseif( !$start_date && !$end_date && $parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for vehicle-id
    elseif( !$start_date && !$end_date && !$parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        /* ->whereHas('details', function($query) use($parts_id){
          $query->where('parts_id', '=', $parts_id);
        }) */
        ->orderBy( 'date', 'desc' )->get()->all();
    }
    // search criteria for start-date, end-date, parts-id & vehicle-id
    elseif( $start_date && $end_date && $parts_id && $vehicle_id ){
      $vehicleParts_purchase_all = Purchase_Model::where( 'purchase_type', $purchase_type )
        ->whereDate( 'date', '>=', date( $start_date ) )
        ->whereDate( 'date', '<=', date( $end_date ) )
        // ->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
        ->whereHas('details', function($query) use($parts_id, $vehicle_id){
          $query->where('parts_id', '=', $parts_id)
            ->where('vehicle_id', '=', $vehicle_id);
        })
        ->orderBy( 'date', 'desc' )->get()->all();
    }


    $parts_all   = Parts_Model::orderBy( 'name', 'asc' )->get()->all();
    $vehicle_all = Vehicle_Model::orderBy( 'vehicle_no', 'asc' )->get()->all();

    $settings    = Settings_Model::get()->first();
    $date_format = $settings && $settings->date_format ? $settings->date_format : 'd-M-Y';

    return view('modules.vehicle-module.purchase-parts.searchResult')->with([
      'date_start'    => $date_start,
      'date_end'      => $date_end,
      'date_format'   => $date_format,
      'parts_id'      => $parts_id,
      'parts_all'     => $parts_all,
      'vehicle_id'    => $vehicle_id,
      'vehicle_all'   => $vehicle_all,
      'purchases_all' => $vehicleParts_purchase_all,
    ]);
  }
  
  
  // Delete Vehicle-Parts-Purchase with Items
  public function VehiclePartsPurchaseDelete( $purchase_uid, Request $request )
  {
    $purchase     = Purchase_Model::where('uid', $purchase_uid)->first();

    if( ! $purchase ){
      return back()->with('error', 'Purchase not found!');
    }

    $purchase_no = $purchase->purchase_no;

    $purchaseItemsDeleted = $purchase->details()->delete();

    if( $purchaseItemsDeleted ){
      $purchase->delete();

      return back()->with('success', "Purchase no.# $purchase_no deleted successfully!");
      // return response()->json(['purchase_no' => $purchase_no], 200);

    } else{
      return back()->with('error', 'Something went wrong!');
    }
  }
    
  
  // Delete Single-Item of Vehicle-Parts-Purchase
  public function VehiclePartsPurchaseItem_Delete( $purchase_uid, $item_uid, Request $request ): \Illuminate\Http\JsonResponse
  {
    $purchase     = Purchase_Model::where('uid', $purchase_uid)->first();
    $purchaseItem = PurchaseDetails_Model::where('uid', $item_uid)->first();

    if( ! $purchase || ! $purchaseItem ){
      return response()->json( ['errors' => [
        'message' => 'Purchase item not found!'
      ] ], 404);
    }
    elseif( $purchase->id != $purchaseItem->purchase_id || $purchase->purchase_no != $purchaseItem->purchase_no ){
      return response()->json( ['errors' => [
        'message' => 'Purchase item not matched with records!'
      ] ], 404);
    }

    $itemName     = $purchaseItem->parts->name;
    $total_qty    = $purchase->total_qty - $purchaseItem->quantity;
    $total_amount = $purchase->total_amount - $purchaseItem->amount;
    $paid_amount  = $purchase->is_paid ? ($purchase->paid_amount - $purchaseItem->amount) : $purchase->paid_amount;
    $due_amount   = ! $purchase->is_paid ? 0 : $purchase->due_amount;

    $purchaseItem->delete();
    
    $purchase->update([
      'total_qty'    => $total_qty,
      'total_amount' => $total_amount,
      'paid_amount'  => $paid_amount,
      'due_amount'   => $due_amount,
    ]);

    return response()->json(['itemName' => $itemName], 200);
  }


}
