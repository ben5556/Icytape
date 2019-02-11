<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model {

	protected $table = 'comment_votes';
	protected $guarded = array();

	public static $rules = array();
}
