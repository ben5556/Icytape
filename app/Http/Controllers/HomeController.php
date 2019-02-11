<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(Request $request){
                
        $search = $request->search;
        if(isset($search)){
            $posts = Post::where('active', '=', 1)->where('title', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate(config('site.num_results_per_page'));
        } else {
            $posts = Post::with('post_likes', 'comments')->where('active', '=', 1)->orderBy('created_at', 'desc')->paginate(config('site.num_results_per_page'));
        }

        $categories = Category::orderBy('order', 'ASC')->get();
        $pages = Page::all();
        $data = array(
            'posts' => $posts,
            'search' => $search,
            'categories' => $categories,
            'pages' => $pages,
            'settings' => Setting::first(),
            'show_random_bar' => true,
            'seo_title' => setting('site.title') . ' - ' . setting('site.description'),
            'seo_description' => setting('site.description'),
            'seo_image' => url(theme('social_share_image'))
        );

        return view('theme::home', $data);
    }
}
