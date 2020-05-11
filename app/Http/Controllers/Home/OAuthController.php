<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OAuthClient;
use Auth;
use Socialite;
use App\Models\OAuth as OAuth;
use URL;
use Exception;

            
class OAuthController extends Controller
{


	public function __construct()
	{}

	public function index()
	{

		return view('home/test');
	}

	public function login($action = 'github')
	{
		$action = $action;

		$res = OAuthClient::where('name', $action)->first();

		if (!$res) return '404';

		return Socialite::driver('github')->redirect();
	}

	public function handleProviderCallback(Request $request)
	{
		if (!$request->has('code')) {
		    return '404';
		}

		try {
			 $github_user = Socialite::driver('github')->user();
		} catch (Exception $e) {
			 $github_user = Socialite::driver('github')->stateless()->user();
		}

		$user = OAuth::where('name',$github_user->name)->first();

		if (!$user) {
			 $userId = OAuth::create([
			     'name'         => $github_user->name,
			     'email'        => (string) $github_user->email,
			     'openId'       => $github_user->id,
			     'access_token' => $github_user->token,
		  	])->id;
		} else {
			$userId = $user->id;
		}
		Auth::guard('oauth')->loginUsingId($userId);

    	if (!Auth::guard('oauth')->check()) return -1;

		return redirect('/');
	}

	public function logout()
	{
		Auth::guard('oauth')->logout();

		return redirect('/');
	}
}
