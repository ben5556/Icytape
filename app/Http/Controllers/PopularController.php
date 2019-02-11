<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Page;
use DB;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function index(){
    	$posts = Post::where('active', '=', '1')->join('post_likes', 'posts.id', '=', 'post_likes.post_id')->groupBy('post_likes.post_id')->orderBy(DB::raw('COUNT(post_likes.id)'), 'DESC')->select('posts.*')->paginate(30);
		
        $data = array(
                'posts' => $posts,
                'seo_title' => 'Popular Posts',
                'seo_description' => 'Checkout the latest Popular Posts',
                'seo_image' => url(theme('social_share_image')),
                'title' => 'Popular Posts of All Time'
            );

        return view('theme::home', $data);
    }

    public function week(){
    	$posts = Post::where('active', '=', '1')->join('post_likes', 'posts.id', '=', 'post_likes.post_id')->where('post_likes.created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 week')))->groupBy('post_likes.post_id')->orderBy(DB::raw('COUNT(post_likes.id)'), 'DESC')->select('posts.*')->paginate(30);
    	
        $data = array(
                'posts' => $posts,
                'seo_title' => 'Popular Posts for the Week',
                'seo_description' => 'Checkout the latest Popular Posts for the Week',
                'seo_image' => url(theme('social_share_image')),
                'title' => 'Popular Posts for the Week'
            );

        return view('theme::home', $data);
    }

    public function month(){
    	$posts = Post::where('active', '=', '1')->join('post_likes', 'posts.id', '=', 'post_likes.post_id')->where('post_likes.created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))->groupBy('post_likes.post_id')->orderBy(DB::raw('COUNT(post_likes.id)'), 'DESC')->select('posts.*')->paginate(30);
    	
        $data = array(
                'posts' => $posts,
                'seo_title' => 'Popular Posts for the Month',
                'seo_description' => 'Checkout the latest Popular Posts for the Month',
                'seo_image' => url(theme('social_share_image')),
                'title' => 'Popular Posts for the Month'
            );

        return view('theme::home', $data);
    }

    public function year(){
    	$posts = Post::where('active', '=', '1')->join('post_likes', 'posts.id', '=', 'post_likes.post_id')->where('post_likes.created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 year')))->groupBy('post_likes.post_id')->orderBy(DB::raw('COUNT(post_likes.id)'), 'DESC')->select('posts.*')->paginate(30);
    	
        $data = array(
                'posts' => $posts,
                'seo_title' => 'Popular Posts for the Year',
                'seo_description' => 'Checkout the latest Popular Posts for the Year',
                'seo_image' => url(theme('social_share_image')),
                'title' => 'Popular Posts for the Year'
            );

        return view('theme::home', $data);
    }
}
