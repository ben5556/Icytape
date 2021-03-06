<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model {

	protected $table = 'post_likes';
	protected $guarded = array();
	public static $rules = array();

	public function user(){
		return $this->belongsTo('App\Models\User')->first();
	}

	public function post(){
		return $this->belongsTo('App\Models\Post')->first();
	}

}
