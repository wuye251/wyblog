<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OAuthClient;
use Auth;
use Socialite;
use OAuth;

class OAuthController extends Controller
{

	public function __construct()
	{}

    public function index()
    {

    	return view('home/test');
    }

   	public function login($action)
   	{
   		$action = $action;

   		$res = OAuthClient::where('name', $action)->first();

   		if (!$res) return '404';

   		return Socialite::driver('github')->redirect();
   	}

   	 public function handleProviderCallback()
    {
        $github_user = Socialite::driver('github')->user();

        dd($github_user);
        $user=OAuth::where('name',$github_user->name)->first();
        if(empty($user)){
            $user = OAuth::create([
                'name'=>$github_user->name,
                'email'=>$github_user->email,
                'github_name'=>$github_user->name,
                // 'avatar'=>$github_user->avatar,
            ]);
        }
        return Redirect()->guest('/');
    }

    public function getAction()
    {}



    public function logout()
    {
    	Auth::guard('oauth')->logout();

    	return redirect('/');
    }
}
