<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthGoogle extends Model {
	protected $table = 'oauth_google';

	protected $guarded = array();

	public static $rules = array();

	public function user(){
		return $this->belongsTo('App\Models\User')->first();
	}
}
