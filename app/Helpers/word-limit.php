<?php 

use Illuminate\Support\Str;

// Word Limit
if( ! function_exists( 'WordLimit' ) ){
  function WordLimit( $value, $limit  ): string
  {
    if( ! $value ) return '';

    if( Str::wordCount( $value ) < $limit ) return $value;

    if( Str::wordCount( $value ) > $limit ) return Str::words( $value, $limit );
  }
}




