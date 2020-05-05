<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthUser extends Model
{
    //
	protected $table = 'oauth_user';

	const CREATE_AT = 'created_time';
	const UPDATE_AT = 'updated_time';
}
