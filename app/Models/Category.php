<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'order' => 'required'
	);

	public function totalMedia(){
		return DB::table('post')->where('category_id', '=', $this->id)->count();
	}
}
