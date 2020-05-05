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
    	//调用第三方
    	return view('home');
    }

    public function logout()
    {
    	Auth::guard('oauth')->logout();

    	return redirect('admin/login');
    }
}
