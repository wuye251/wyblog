<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OAuthClient;

class OAuthClientController extends Controller
{
	//第三方登陆 令牌 & 密钥存储
    public function index()
    {
    	$oauthClients   = OAuthClient::all();
        $assign         = compact('oauthClients');

    	return view('admin/oauth/client', $assign);
    }

    public function add()
    {
    	return view('admin/oauth/client');
    }

    public function store(Request $request)
    {
    	$param = $request->all();

    	$name     = $param['name'];
    	$ClientID = $param['ClientID'];
    	$ClientSecret = $param['ClientSecret'];
		
    	$bool = OAuthClient::insert(
    		['name' => $name,
    		'client_id' => $ClientID,
    		'client_secret'=>$ClientSecret
    	]);

    	if ($bool) return 'success';

    	return 'failed';
    }
    
    public function edit($id)
    {}

    public function destroy()
    {}

    public function update()
    {}


}
