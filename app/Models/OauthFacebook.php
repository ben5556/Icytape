<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthFacebook extends Model {

	protected $table = 'oauth_facebook';

	protected $guarded = array();

	public static $rules = array();

	public function user(){
		return $this->belongsTo('App\Models\User')->first();
	}
}
