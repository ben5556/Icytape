<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentFlag extends Model {

	protected $table = 'comment_flags';
	protected $guarded = array();
	public static $rules = array();

	public function comment(){
		return $this->belongsTo('App\Models\Comment')->first();
	}

}
