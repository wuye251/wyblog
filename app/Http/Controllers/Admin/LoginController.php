<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Auth;

class LoginController extends Controller
{

    public function index()
    {
    	return view('home');
    }

    public function logout()
    {
    	Auth::guard('admin')->logout();

    	return redirect('admin/login');
    }
}
