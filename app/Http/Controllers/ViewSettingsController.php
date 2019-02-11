<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;

class ViewSettingsController extends Controller
{
    public function list(){
    	$cookie = Cookie::make('post_display', 'list', 0);
		return back()->withCookie($cookie);
    }

    public function grid(){
    	$cookie = Cookie::make('post_display', 'grid', 0);
		return back()->withCookie($cookie);
    }

    public function grid_large(){
    	$cookie = Cookie::make('post_display', 'grid_large', 0);
		return back()->withCookie($cookie);
	}

	public function sidebar_toggle(){
		$sidebar = Cookie::get('sidebar');
		if(isset($sidebar) && $sidebar){
			$cookie = Cookie::make('sidebar', false, 0);
		} else {
			$cookie = Cookie::make('sidebar', true, 0);
		}

		if(!isset($sidebar) && theme('sidebar', 1)){
			$cookie = Cookie::make('sidebar', false, 0);
		}
		
		return back()->withCookie($cookie);
	}
}
