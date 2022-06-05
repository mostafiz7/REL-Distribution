<?php

namespace App\Http\Controllers;

use App\Models\Entity_Model;
use Illuminate\Http\Request;


class Entity_Controller extends Controller
{
  // Entity All Index
  public function EntityIndex( Request $request )
  {
    $entity_all = Entity_Model::with('children')->whereNull('parent_id');
    
    dd( $entity_all );

  }
  


}
