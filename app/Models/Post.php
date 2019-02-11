<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\Glide\Urls\UrlBuilderFactory;

class Post extends Model {

	protected $table = 'posts';
	
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'pic_url' => 'image'
	);

	public function category(){
		return $this->belongsTo('App\Models\Category');
	}

	public function comments(){
		return $this->hasMany('App\Models\Comment');
	}

	public function setPicAttribute($value){
		if($value == "on"){
			$this->attributes['pic'] = 1;
		} else {
			$this->attributes['pic'] = 0;
		}
	}

	public function user(){
		return $this->belongsTo('App\Models\User')->first();
	}

	public function totalFlags(){
		return \DB::table('post_flags')->where('post_id', '=', $this->id)->count();
	}

	public function totalLikes(){
		return \DB::table('post_likes')->where('post_id', '=', $this->id)->count();
	}

	public function post_likes(){
		return $this->hasMany('App\Models\PostLike');
	}

	public function sidebarImage(){
		$signkey = env('APP_KEY');

		// Create an instance of the URL builder
		$urlBuilder = UrlBuilderFactory::create('/images/', $signkey);

		// Generate a URL
		return $urlBuilder->getUrl($this->pic_url, ['q' => 70, 'w' => '300', 'h' => '150', 'dpr' => '2', 'fit' => 'crop']);
	}

	public function totalComments(){
		return \DB::table('comments')->where('post_id', '=', $this->id)->count();
	}

	public function youtubeVideoId(){
		$url = $this->vid_url;
		$vid_id = "";
		$flag = false;
		if(isset($url) && !empty($url)){
			/*case1 and 2*/
			$parts = explode("?", $url);
			if(isset($parts) && !empty($parts) && is_array($parts) && count($parts)>1){
				$params = explode("&", $parts[1]);
				if(isset($params) && !empty($params) && is_array($params)){
					foreach($params as $param){
						$kv = explode("=", $param);
						if(isset($kv) && !empty($kv) && is_array($kv) && count($kv)>1){
							if($kv[0]=='v'){
								$vid_id = $kv[1];
								$flag = true;
								break;
							}
						}
					}
				}
			}
			
			/*case 3*/
			if(!$flag){
				$needle = "youtu.be/";
				$pos = null;
				$pos = strpos($url, $needle);
				if ($pos !== false) {
					$start = $pos + strlen($needle);
					$vid_id = substr($url, $start, 11);
					$flag = true;
				}
			}
		}
		return $vid_id;
	}
}
