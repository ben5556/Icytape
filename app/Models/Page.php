<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'body' => 'required'
	);

	public function totalPages(){
		return DB::table('pages')->count();
	}
}
