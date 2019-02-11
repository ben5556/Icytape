<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $update_rules = array(
        'username' => 'required|alpha_dash|min:3',
        'email' => 'required|email'
    );  

    public function totalPosts(){
        return DB::table('post')->where('user_id', '=', $this->id)->count();
    }

    public function totalPoints(){
        return DB::table('points')->where('user_id', '=', $this->id)->sum('points');
    }

    public function totalComments(){
        return DB::table('comments')->where('user_id', '=', $this->id)->count();
    }

    public function totalVotes(){
        return DB::table('user_flags')->where('user_flagged_id', '=', $this->id)->count();
    }

    public function totalFlagged(){
        return DB::table('post_flags')->where('user_id', '=', $this->id)->count();
    }

    public function totalLikes(){
        return DB::table('post_likes')->where('user_id', '=', $this->id)->count();
    }

    public function totalFlags(){
        return DB::table('user_flags')->where('user_flagged_id', '=', $this->id)->count();
    }

    public function getFbID(){
        return DB::table('oauth_facebook')->where('user_id', '=', $this->id)->first()->oauth_userid;
    }
}
