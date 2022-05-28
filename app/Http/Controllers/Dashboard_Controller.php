<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Dashboard_Controller extends Controller
{
  
  public function AdminDashboard()
  {
    return view('admin.dashboard');
    // return redirect()->route('homepage');
  }



}
