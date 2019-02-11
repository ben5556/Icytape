<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Page;
use App\Models\PostLike;
use App\Models\Point;
use App\Models\PostFlag;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Auth;
use \Session;
use Input;
use Validator;
use Voyager;
use Image;


class PostController extends \App\Http\Controllers\Controller {

	/**
	 * Post Repository
	 *
	 * @var Meda
	 */
	protected $posts;

	public function __construct(Post $posts)
	{
		$this->posts = $posts;
	}

	public function tags($tag){
		$posts = Post::where('active', '=', 1)->where('tags', 'LIKE', $tag.',%')->orWhere('tags', 'LIKE', '%,'.$tag.',%')->orWhere('tags', 'LIKE', '%,'.$tag)->orWhere('tags', '=', $tag)->orderBy('created_at', 'desc')->paginate(10);
        
        $data = array(
                'posts' => $posts,
                'tag' => $tag,
                'seo_title' => "Posts tagged with " . $tag,
                'seo_description' => "Posts tagged with the word " . $tag,
                'seo_image' => url(theme('social_share_image'))
            );

        return view('theme::home', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::guest()){
			return redirect('login')->with(array('note' => __('lang.login_to_upload'), 'note_type' => 'danger'));
		}

		$data = array(
			'categories' => Category::orderBy('order', 'ASC')->get(),
			'settings' => Setting::first(),
			);

		return view('theme::upload', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		if(!Auth::guest()){

			if(!Auth::user()->active && setting('site.user_email_verify', false)){
				return redirect('/')->with(array('note' => __('lang.activate_to_upload'), 'note_type' => 'danger') );
			}

			$input = \Input::all();
			$validation = Validator::make($input, Post::$rules);

			$valid_post = false;
			if(isset($input['pic_url']) && !empty($input['pic_url'])){
				$valid_post = true;
			} else if(isset($input['img_url']) && $input['img_url'] != ''){
				$valid_post = true;
			} else if(isset($input['vid']) && $input['vid'] != ''){
				$valid_post = true;
			}

			if ($validation->passes() && $valid_post)
			{
				if(isset($input['pic'])){

					if(isset($input['img_url']) && $input['img_url'] != ''){
						$file = Input::get('img_url');
						$ext = pathinfo($file, PATHINFO_EXTENSION);
						$filename = basename(str_replace('.' . $ext, '', $file));
       					$input['pic_url'] = $this->uploadPostImage($file, $filename, $ext);

					} else if(isset($input['pic_url'])){
						$file = Input::file('pic_url');
						$filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
						$input['pic_url'] = $this->uploadPostImage($file, $filename, $file->getClientOriginalExtension());

						$input['pic'] = 1;
					}
				}
				
				unset($input['img_url']);

				if(isset($input['vid'])){

					unset($input['pic_url_multi']);

					if(isset($input['vid_url'])){
						unset($input['vid']);
						
						if (strpos($input['vid_url'], 'youtube') > 0 || strpos($input['vid_url'], 'youtu.be') > 0) {
							$video_id = $this->extractUTubeVidId($input['vid_url']);
							if(isset($video_id[1])){
								$img_url = 'http://img.youtube.com/vi/'. $video_id . '/0.jpg';
								$input['pic_url'] = $this->uploadPostImage($img_url, str_slug($input['title']), 'jpg');
							} else {
								unset($input['vid_url']);
							}
							$input['vid'] = 1;
						} elseif(strpos($input['vid_url'], 'vimeo') > 0) {
							$vimeo_id = (int)substr(parse_url($input['vid_url'], PHP_URL_PATH), 1);
							$link = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo_id.php"));
							$image = $link[0]['thumbnail_large'];  
							
							$input['pic_url'] = $this->uploadPostImage($image, str_slug($input['title']), 'jpg');
							$input['vid'] = 1;
						}
					}
				}

				$this->add_daily_post_points();

				if(!setting('site.auto_approve_posts')){
					$input['active'] = 0;
				}

				if(isset($input['nsfw'])){
					$input['nsfw'] = 1;
				} else {
					$input['nsfw'] = 0;
				}

				$input['title'] = htmlspecialchars(stripslashes($input['title']));

				$input['slug'] = str_slug($input['title']);

				if(isset($input['body'])){
					$input['body'] = htmlspecialchars(stripslashes($input['body']));
				}
				
				$slugexist = Post::where('slug', '=', $input['slug'])->first();
				$increment = 1;
				while(isset($slugexist->id)){
					$slugexist = Post::where('slug', '=', $input['slug'].$increment)->first();
					if(!isset($slugexist->id)){
						$input['slug'] = $input['slug'] . $increment;
					}
					$increment += 1;
				}

				$new_post = $this->posts->create($input);

				return redirect($new_post->slug)->with(array('note' => __('lang.upload_success'), 'note_type' => 'success') );
			}

			return redirect('/upload')->with(array('note' => __('lang.error_uploading'), 'note_type' => 'danger') );

		} else {
			return redirect('/')->with(array('note' => __('lang.login_to_upload'), 'note_type' => 'danger') );
		}
	}

	public function random()
	{
		if(Post::count() > 0){
			$random = Post::where('active', '=', 1)->orderBy(\DB::raw('RAND()'))->first();
			return redirect($random->slug);
		} else {
			return redirect('/');
		}
	}

	// When user submits post award them 1 point, max 5 per day

	private function add_daily_post_points(){
		$user_id = Auth::user()->id;

		$LastQuestionPoints = Point::where('user_id', '=', $user_id)->where('description', '=', __('lang.daily_upload'))->orderBy('created_at', 'desc')->take(5)->get();
		
		$total_daily_questions = 0;
		foreach($LastQuestionPoints as $QuestionPoint){
			if( date('Ymd') ==  date('Ymd', strtotime($QuestionPoint->created_at)) ){
				$total_daily_questions += 1;
			}
		}

		if($total_daily_questions < 5){
			$point = new Point;
			$point->user_id = $user_id;
			$point->description = __('lang.daily_upload');
			$point->points = 1;
			$point->save();
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($slug)
	{
		$post = Post::with('post_likes', 'comments')->where('slug', '=', $slug)->firstOrFail();

		$view_increment = $this->handleViewCount($post->id);

		$previous = Post::where('active', '=', 1)->where('created_at', '>', date("Y-m-d H:i:s", strtotime($post->created_at)) )->first();
		$next = Post::where('active', '=', 1)->where('created_at', '<', date("Y-m-d H:i:s", strtotime($post->created_at)) )->orderBy('created_at', 'desc')->first();
		$post_next = Post::where('active', '=', 1)->where('created_at', '<=', date("Y-m-d H:i:s", strtotime($post->created_at)) )->orderBy('created_at', 'DESC')->take(6)->get();

		list($img_width, $img_height) = @getimagesize(url($post->pic_url));

		$data = array(
			'item' => $post,
			'post_next' => $post_next,
			'next' => $next,
			'previous' => $previous,
			'view_increment' => $view_increment,
			'settings' => Setting::first(),
			'categories' => Category::all(),
			'pages' => Page::all(),
			'single' => true,
			'seo_title' => stripslashes($post->title) . ' - ' . setting('site.title'),
            'seo_description' => substr(strip_tags($post->body), 0, 160),
            'seo_image' => url(Voyager::image($post->pic_url)),
            'seo_image_w' => $img_width,
            'seo_image_h' => $img_height
			);

		return view('theme::post', $data);
	}


	public function category($slug)
	{
		$category = Category::where('slug', '=', $slug)->firstOrFail();

		$data = array(
			'posts' => Post::where('active', '=', 1)->where('category_id', '=', $category->id)->orderBy('created_at', 'desc')->paginate(10),
    		'categories' => Category::all(),
    		'seo_title' => $category->name . ' - ' . setting('site.title'),
            'seo_description' => "Posts categorized in the " . $category->name . ' category.',
            'seo_image' => url(theme('social_share_image')),
            'title' => $category->name . ' Category'
    	);

		return view('theme::home', $data);
	}

	public function handleViewCount($id){

		// check if this key already exists in the view_post session
		$blank_array = array();
		if (! array_key_exists($id, Session::get('viewed_post', $blank_array) ) ) {
            
            try{
	            // increment view
				$post = Post::find($id);
				$post->views = $post->views + 1;
				$post->save();

	            // Add key to the view_post session
	        	Session::put('viewed_post.'.$id, time());
	        	return true;

	        } catch (Exception $e){
	        	return false;
	        }
        } else {
        	return false;
        }

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = $this->posts->find($id);

		if (is_null($post))
		{
			return redirect()->route('post.index');
		}

		return view('theme::post.edit', compact('post'));
	}

	// Add Post Flag

	public function add_flag(){
		$id = Input::get('post_id');
		$post_flag = PostFlag::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $id)->first();

		if(isset($post_flag->id)){ 
			$post_flag->delete();
		} else {
			$flag = new PostFlag;
			$flag->user_id = Auth::user()->id;
			$flag->post_id = $id;
			$flag->save();
			echo $flag;
		}
	}


	// Add Post Like

	public function add_like(Request $request){
		$id = $request->post_id;
		$post_like = PostLike::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $id)->first();

		if(isset($post_like->id)){ 
			$post_like->delete();
		} else {
			$like = new PostLike;
			$like->user_id = Auth::user()->id;
			$like->post_id = $id;
			$like->save();
			echo $like;
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::find($id);
		if(Auth::user()->admin == 1 || Auth::user()->id == $post->user_id){
			
			$settings = Setting::first();

			try{
				$input = Input::all();

				$post->body = htmlspecialchars($input['body']);
				
				if(isset($input['nsfw'])){
					$input['nsfw'] = 1;
				} else {
					$input['nsfw'] = 0;
				}

				$post->nsfw = $input['nsfw'];

				$post->title = htmlspecialchars($input['title']);
				$post->category_id = $input['category'];
				$post->link_url = htmlspecialchars($input['source']);
				$post->tags = htmlspecialchars($input['tags']);
				$post->save();
				return redirect($input['redirect'])->with(array('note' => __('lang.update_success'), 'note_type' => 'success') );
			} catch(Exception $e){
				return redirect($input['redirect'])->with(array('note' => __('lang.update_error') . ': ' . $e->getMessage(), 'note_type' => 'danger') );
			}

		} else {
			return redirect('/');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$post = Post::find($id);

		if($post->user_id == Auth::user()->id || Auth::user()->admin == 1){

			$post_flags = PostFlag::where('post_id', '=', $id)->get();
			foreach($post_flags as $post_flag){
				$post_flag->delete();
			}

			$post_likes = PostLike::where('post_id', '=', $id)->get();
			foreach($post_likes as $post_like){
				$post_like->delete();
			}

			$comments = Comment::where('post_id', '=', $id)->get();
			foreach($comments as $comment){
				$comment_votes = CommentVote::where('comment_id', '=', $comment->id)->get();
				foreach($comment_votes as $comment_vote){
					$comment_vote->delete();
				}

				$comment_flags = CommentFlag::where('comment_id', '=', $comment->id)->get();
				foreach($comment_flags as $comment_flag){
					$comment_flag->delete();
				}

				$comment->delete();
			}

			// if the post type is a gif we need to remove the animation file too.
			if(strpos($post->pic_url, '.gif') > 0){
				if(Storage::disk(config('voyager.storage.disk'))->exists( str_replace(".gif", "-animation.gif", $post->pic_url))){
					Storage::disk(config('voyager.storage.disk'))->delete( str_replace(".gif", "-animation.gif", $post->pic_url));
				}
			}

			// remove the image
			if( Storage::disk(config('voyager.storage.disk'))->exists( $post->pic_url ) ){
				Storage::disk(config('voyager.storage.disk'))->delete( $post->pic_url );
			}


			$post->delete();

		}

		return redirect('/')->with(array('note' => __('lang.delete_success'), 'note_type' => 'success') );
	}


	private function extractUTubeVidId($url){
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

	private function uploadPostImage($file, $filename, $ext){
		$path = 'posts/' . date('FY') . '/';

        $filename_counter = 1;

        if($ext == 'gif'){

        	// Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
	        while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'-animation.'.$ext) || Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$ext)) {
	            $filename = $filename . (string)($filename_counter++);
	        }

        	$gifImg = Image::make($file)->encode('gif', 75);
        	Storage::disk(config('voyager.storage.disk'))->put($path.$filename.'.'.$ext, $gifImg, 'public');
        	if(Storage::disk(config('voyager.storage.disk'))->put($path.$filename.'-animation.'.$ext, file_get_contents($file), 'public')){
	    		return $path.$filename.'.'.$ext;
	    	}
        } else {
        	// Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
	        while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$ext)) {
	            $filename = $filename . (string)($filename_counter++);
	        }

	        if(Storage::disk(config('voyager.storage.disk'))->put($path.$filename.'.'.$ext, file_get_contents($file), 'public')){
	    		return $path.$filename.'.'.$ext;
	    	}

        }

    	return NULL;
	}


	// Sanitize Image URL's

	private function sanitize($string, $force_lowercase = true, $anal = false) {
	    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
	                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
	                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
	    $clean = trim(str_replace($strip, "", strip_tags($string)));
	    $clean = preg_replace('/\s+/', "-", $clean);
	    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
	    return ($force_lowercase) ?
	        (function_exists('mb_strtolower')) ?
	            mb_strtolower($clean, 'UTF-8') :
	            strtolower($clean) :
	        $clean;
	}

	public function sitemap(){
		$sitemap = \App::make("sitemap");
		// Add the Homepage and Popular Pages
		$sitemap->add(url('/'), date('Y-m-d H:i:s'), '1.0', 'daily');
		$sitemap->add(url('/popular'), date('Y-m-d H:i:s'),'1.0', 'daily');
		$sitemap->add(url('/popular/week'), date('Y-m-d H:i:s'),'1.0', 'daily');
		$sitemap->add(url('/popular/month'), date('Y-m-d H:i:s'),'1.0', 'daily');
		$sitemap->add(url('/popular/year'), date('Y-m-d H:i:s'),'1.0', 'daily');
		// Display all Media
		$items = Post::all();
		foreach($items as $item) {
		  $sitemap->add(url($item->slug), $item->created_at, '0.9', 'weekly');
		}
		$categories = Category::all();
		foreach($categories as $category) {
		  $sitemap->add(url('category' . '/' . $category->slug), $category->created_at, '0.9', 'weekly');
		}
		// Now, output the sitemap:
		return $sitemap->render('xml'); 

	}

}
