<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class Admin_Controller extends Controller
{
  public function AdminDashboard()
  {
    return view('admin.dashboard');
    // return redirect()->route('login');
  }



}
