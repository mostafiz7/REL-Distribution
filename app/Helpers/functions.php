<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


// Error message for denies for route access
if( ! function_exists( 'RouteNotAuthorized' ) ){
  function RouteNotAuthorized(): string
  {
    return 'You are not authorized to perform this action!';
  }
}


// Make any number as decimal number
if( ! function_exists( 'FormatedFloat' ) ){
  function FormatedFloat( $value ): string
  {
    return number_format( $value, 2, '.', '' );
  }
}


// Make slug from string
if( ! function_exists( 'slug' ) ){
  function slug( $search, $replace, $value )
  {
    if( ! $value ) return '';
    return str_ireplace( $search, $replace, strtolower( $value ) );
  }
}


// unslug the sluged string
if( ! function_exists( 'unslug' ) ){
  function unslug( $search, $replace, $value )
  {
    if( ! $value ) return '';
    return ucwords( str_ireplace( $search, $replace, strtolower( $value ) ) );
  }
}


// Word Limit
if( ! function_exists( 'WordLimit' ) ){
  function WordLimit( $value, $limit  ): string
  {
    if( ! $value ) return '';

    if( Str::wordCount( $value ) < $limit ) return $value;

    if( Str::wordCount( $value ) > $limit ) return Str::words( $value, $limit );
  }
}


// Drop-DB-Table-Column-If-Exists
if( ! function_exists( 'dropColumnIfExists' ) ){
  function dropColumnIfExists( $tableName, $column )
  {
    if( Schema::hasColumn( $tableName, $column ) ) // check the column
    {
      Schema::table( $tableName, function( Blueprint $table, $column ){
        $table->dropColumn( $column );
      });
    }
  }
}


// Product Units
if( ! function_exists('Units') ){
  function Units(){
    return [ 'feet', 'inch', 'litre', 'mitre', 'pcs', 'set' ];
  }
}


// Product Units
if( ! function_exists('PurchaseTypes') ){
  function PurchaseTypes(){
    return [ 'vehicle', 'vehicle-parts', 'electrical', 'electronics', 'stationary', 'furniture' ];
  }
}


// Employment Statuses
if( ! function_exists('EmploymentStatus') ){
  function EmploymentStatus(){
    return [ 'casual', 'contractual', 'daily-basis', 'permanent', 'probation' ];
  }
}


// Country Lists
if( ! function_exists('Countries') ){
  function Countries(){
    return [
      [ 'name' => 'Bangladesh',      'slug' => 'bangladesh',      'short_name' => 'BD' ],
      [ 'name' => 'China',           'slug' => 'china',           'short_name' => 'CH' ],
      [ 'name' => 'Germany',         'slug' => 'germany',         'short_name' => 'DE' ],
      [ 'name' => 'India',           'slug' => 'india',           'short_name' => 'IN' ],
      [ 'name' => 'Indonesia',       'slug' => 'indonesia',       'short_name' => 'ID' ],
      [ 'name' => 'Italy',           'slug' => 'italy',           'short_name' => 'IT' ],
      [ 'name' => 'Japan',           'slug' => 'japan',           'short_name' => 'JP' ],
      [ 'name' => 'South Korea',     'slug' => 'south-korea',     'short_name' => 'KOR' ],
      [ 'name' => 'Thailand',        'slug' => 'thailand',        'short_name' => 'TH' ],
      [ 'name' => 'Taiwan',          'slug' => 'taiwan',          'short_name' => 'TW' ],
      [ 'name' => 'United Kingdom',  'slug' => 'united-kingdom',  'short_name' => 'UK' ],
      [ 'name' => 'United States',   'slug' => 'united-states',   'short_name' => 'US' ]
    ];
  }
}


