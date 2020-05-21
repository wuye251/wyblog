<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // 注意这里要和User模型一样

class OAuth extends Authenticatable
{
    //
	protected $table = 'oauth_user';

	const CREATE_AT = 'created_time';
	const UPDATE_AT = 'updated_time';

	protected $fillable = [
      'name', 'access_token', 'openId', 'mail'
 	 ];
}
