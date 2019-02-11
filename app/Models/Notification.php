<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'notifications';

	protected $fillable = array('user_id','content','is_read','url_comment');
	
 	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}