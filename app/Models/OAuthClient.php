<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthClient extends Model
{
    //
	protected $table = 'oauth_clients';

	const CREATE_AT = 'created_time';
	const UPDATE_AT = 'updated_time';
}
