<?php 

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;
use App\Models\Point;
use App\Models\PostLike;
use App\Models\OauthGoogle;
use App\Models\OauthFacebook;
use App\Notifications\SendEmailVerification;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Image;
use Input;
use Password;
use Redirect;
use Session;
use Socialite;
use Validator;

class UserController extends Controller {

    // *********** USER LOGIN ********** //

	public function login(Request $request){
		
		if(!Auth::guest()){
			return redirect('/');
		}

		$redirect = $request->redirect;
		if(isset($redirect)){
			return redirect($redirect);
		}

		return view('theme::auth.login', compact('redirect'));

	}

	public function login_post(Request $request){

	    $email_login = ['email' => $request->email, 'password' => $request->password];
	    $uname_login = ['username' => $request->email, 'password' => $request->password];

	    if ( Auth::attempt($email_login) || Auth::attempt($uname_login) ){

	    	if(!Auth::user()->active && setting('site.user_email_verify')){
		    	Auth::logout();
		    	return back()->with(array('note' => 'Email has not been verified. Please make sure to verify your email address before logging in.', 'note_type' => 'danger'));
		    } else {
		    	$this->add_user_login_point();

		    	$redirect = $request->redirect;
				if($redirect == '') $redirect = '/';

		    	return back()->with(array('note' => trans('lang.signin_success'), 'note_type' => 'success'));
		    }
	    	
	    } else {
	        // auth failure! redirect to login with errors
	        return back()->with(array('note' => trans('lang.signin_error'), 'note_type' => 'danger'));
	    }

	}

    // *********** USER SIGNUP ********** //

    public function signup(Request $request){

    	if(!Auth::guest()){
			return redirect('/');
		}

		$redirect = $request->redirect;
		$seo_title = 'Signup';
		$seo_description = "Signup for a free account";

		return view('theme::auth.signup', compact('redirect', 'seo_title', 'seo_description'));
    }

	public function signup_post(Request $request){

		$validator = Validator::make($request->all(), [
			'username' => 'required|unique:users|alpha_num',
	        'email' => 'required|email|unique:users',
	        'password' => 'required|confirmed'
	    ]);

		if ($validator->fails()){
			return redirect('signup')->withErrors($validator);
		}

		$settings = Setting::first();

		if($settings->captcha){
			

			$privatekey = $settings->captcha_private_key;
			$resp = Recaptcha::recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $request->recaptcha_challenge_field, $request->recaptcha_response_field);

			if (!$resp->is_valid) {
			  // Incorrect Captcha
			  return redirect('signup')->with(array('note' => trans('lang.incorrect_captcha'), 'note_type' => 'danger'));
			} else {

			}
		}

		$token = str_random(64);

		$user = $this->new_user( $request->username, $request->email, Hash::make($request->password), NULL, false, $token ); 
    	$this->new_user_points($user->id);

		if(setting('site.user_email_verify')){
			$user->notify(new SendEmailVerification($token));
			return redirect('/login')->with(array('note' => 'Thanks for signing up! Please check your email address to verify your account', 'note_type' => 'success'));
		}

	    if($user){
	    	Auth::attempt(array('email' => $request->email, 'password' => $request->password));
	    }

	    $redirect = $request->redirect;

	    if($redirect == '') $redirect = '/';

	    return redirect($redirect)->with(array('note' => trans('lang.signup_success'), 'note_type' => 'success'));


	}

	// *********** CREATE A NEW USERNAME WITH USERNAME EMAIL AND PASSWORD ********** //

	private function new_user($username, $email, $password, $filename = NULL, $social = false, $token = ''){
	    $user = new User;
	    $user->username = $username;
	    $user->name = $username;
	    $user->email = $email;
	    $user->password = $password;

	    if(setting('site.user_email_verify')){
	    	$user->activation_token = $token;
	    	$user->active = 0;
	    }
	    if($social){
	    	$user->active = 1;
	    }

	    if($filename){
	    	$user->avatar = $filename;
	    }

	    $user->save();

	    return $user;
	}

	// *********** WHEN USER SIGNS UP AWARD THEM WITH POINTS ********** //

	private function new_user_points($user_id){
		$point = new Point;
    	$point->user_id = $user_id;
    	$point->points = 200;
    	$point->description = trans('lang.registration');
    	$point->save();
	}

	// *********** ADD USER LOGIN POINT, ONE PER DAY ********** //

	private function add_user_login_point(){
		$user_id = Auth::user()->id;

		$LastLoginPoints = Point::where('user_id', '=', $user_id)->where('description', '=', trans('lang.daily_login'))->orderBy('created_at', 'desc')->first();
		if(!isset($LastLoginPoints) || date('Ymd') !=  date('Ymd', strtotime($LastLoginPoints->created_at)) ){
			$point = new Point;
			$point->user_id = $user_id;
			$point->description = trans('lang.daily_login');
			$point->points = 5;
			$point->save();
			return true;
		} else {
			return false;
		}
	}


	// *********** UPDATE USER ********** //

	public function update(Request $request, $id)
	{
		// Make sure the authenticated user is the correct user trying to update
		if(Auth::user()->id == $id){
			$input = array_except(Input::all(), '_method');
			$input['username'] = str_replace('.', '-', $input['username']);
			$validation = Validator::make($input, User::$update_rules);

			if ($validation->passes())
			{
				$user = User::find($id);

				$input['avatar'] = $user->avatar;
				if(Input::hasFile('avatar')){
					$file = $request->file('avatar');
					$filename_url = 'users/' . $user->username . '/avatar.' . $file->getClientOriginalExtension();
	            	if(Storage::disk(config('voyager.storage.disk'))->put($filename_url, file_get_contents($file), 'public')){
	            		$input['avatar'] = $filename_url;
	            	}
	            }

	            if($input['password'] == ''){
	            	$input['password'] = $user->password;
	            } else{ $input['password'] = Hash::make($input['password']); }

	            if($user->username != $input['username']){
	            	$username_exist = User::where('username', '=', $input['username'])->first();
	            	if($username_exist){
	            		return Redirect::to('user/' .$user->username)->with(array('note' => trans('lang.username_in_use'), 'note_type' => 'danger') );
	            	}
	            }

				$user->update($input);

				return Redirect::to('user/' .$user->username)->with(array('note' => trans('lang.update_user'), 'note_type' => 'success') );
			}

			return Redirect::to('user/' . Auth::user()->username)->with(array('note' => trans('lang.validation_errors'), 'note_type' => 'danger') );
		} else {
			return Redirect::to('user/' . Auth::user()->username)->with(array('note' => 'Tisk Tisk Tisk... Why are you trying to update another user.', 'note_type' => 'danger') );
		}
		
	}


	// *********** SHOW USER PROFILE ********** //

	public function profile($username){

		$user = User::where('username', '=', $username)->first();
		$is_user_profile = false;
		if(!Auth::guest() && Auth::user()->id == $user->id){
			$is_user_profile = true;
			$posts = Post::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(10);
		} else {
			$posts = Post::where('user_id', '=', $user->id)->where('active', '=', 1)->orderBy('created_at', 'desc')->paginate(10);
		}
		$user_points = DB::table('points')->where('user_id', '=', $user->id)->sum('points');

		$data = array(
				'user' => $user,
				'posts' => $posts,
				'is_user_profile' => $is_user_profile,
				'user_points' => $user_points,
				'seo_title' => $user->username . '\'s profile',
	            'seo_description' => $user->username . '\'s profile',
				);

		return view('theme::user.index', $data);
	}

	// *********** SHOW USER PROFILE LIKES ********** //

	public function profile_likes($username){

		$user = User::where('username', '=', $username)->first();
		$posts = PostLike::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(10);
		$is_user_profile = false;
		if(!Auth::guest() && Auth::user()->id == $user->id){
			$is_user_profile = true;
		}
		$user_points = DB::table('points')->where('user_id', '=', $user->id)->sum('points');

		$data = array(
				'user' => $user,
				'posts' => $posts,
				'likes' => true,
				'is_user_profile' => $is_user_profile,
				'user_points' => $user_points,
				'seo_title' => $user->username . '\'s likes',
	            'seo_description' => $user->username . '\'s likes',
				);

		return view('theme::user.index', $data);
	}

	// ********** USER POINTS PAGE **********  //

	public function points($username){

		$user = User::where('username', '=', $username)->first();
		$is_user_profile = false;
		if(!Auth::guest() && Auth::user()->id == $user->id){
			$is_user_profile = true;
		}
		$user_points = DB::table('points')->where('user_id', '=', $user->id)->sum('points');
		

		$data = array(
			'user' => $user,
			'points' => Point::where('user_id', '=', $user->id)->get(),
			'is_user_profile' => $is_user_profile,
			'user_points' => $user_points,
			'seo_title' => $user->username . '\'s points',
	        'seo_description' => $user->username . '\'s points',
			);

		return view('theme::user.index', $data);
	}

	public function leaderboard(){
		$leaders = DB::table('users')->join('points', 'users.id', '=', 'points.user_id')->groupBy('points.user_id')->orderBy(DB::raw('SUM(points.points)'), 'DESC')->select('users.*', DB::raw('SUM(points.points) as total_points'))->take(50)->get();
		$seo_title = 'Leaderboard';
		return view('theme::leaderboard', compact('leaders', 'seo_title'));
	}

	public function verify($token){

		$user = User::where('activation_token', '=', $token)->first();

		// Valid Token
		if(isset($user->id)){
			if ($user->active) {
				return redirect('/')->with(array('note' => 'Your email has already been verified.', 'note_type' => 'success'));
			}
			if($user->activation_token == $token){
				$user->active = 1;
				$user->activation_token = NULL;
				$user->save();
				return redirect('/login')->with(array('note' => 'Your email has been successfully verified. You can now login.', 'note_type' => 'success'));
			} else {
				return redirect('/login')->with(array('note' => 'Invalid or expired email verification token.', 'note_type' => 'danger'));
			}
		} else {
			return redirect('/')->with(array('note' => 'Invalid Token', 'note_type' => 'danger'));
		}

	}

	public function logout(Request $request){
		Auth::logout();
		return back()->with( array('note' => 'Successfully Logged out', 'note_type' => 'success') );
	}


	public function facebookRedirect(){

    	config(['services.facebook.client_id' => setting('social-auth.facebook_client_id')]);
    	config(['services.facebook.client_secret' => setting('social-auth.facebook_client_secret')]);
    	//dd(config('services.facebook.client_id'));
	    return Socialite::driver('facebook')->redirect();
    
    }

    public function facebookCallback(){
    	config(['services.facebook.client_id' => setting('social-auth.facebook_client_id')]);
    	config(['services.facebook.client_secret' => setting('social-auth.facebook_client_secret')]);
    	$socialUser = Socialite::driver('facebook')->user();
    	

    	$fb_auth = OauthFacebook::where('oauth_userid', '=', $socialUser->id)->first();
		
        if(isset($fb_auth->id)){
        	$user = User::find($fb_auth->user_id);
        } else {
        	// Execute Add or Login Oauth User
        	$user = User::where('email', '=', $socialUser->email)->first();
        	if(!isset($user->id)){
        		$username = $this->increment_username_if_exists(strtolower(str_slug($socialUser->name)));
        		$email = $socialUser->email;
        		$password = Hash::make(str_random(15));

        		if($socialUser->avatar != NULL){
        			$filename_url = 'users/' . $username . '/avatar.jpg';
        			$jpgImg = Image::make($socialUser->avatar)->encode('jpg', 75);
            		Storage::disk(config('voyager.storage.disk'))->put($filename_url, $jpgImg, 'public');
            		$avatar = $filename_url;
            	} else {
            		$avatar = NULL;
            	}
        	
        		$user = $this->new_user($username, $email, $password, $avatar, true);
        		$this->new_user_points($user->id);

        		$new_oauth_user = new OauthFacebook;
        		$new_oauth_user->user_id = $user->id;
        		$new_oauth_user->oauth_userid = $socialUser->id;
        		$new_oauth_user->save();
        	} else {
        		// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
        		return redirect('/')->with(array('note' => __('lang.oauth_email_used'), 'note_type' => 'danger'));
        	}
        }
    	// Redirect to new User Login;
    	Auth::login($user);
    	$this->add_user_login_point();
    	return redirect('/')->with(array('note' => __('lang.facebook_success'), 'note_type' => 'success'));

    }

    public function googleRedirect(){

    	config(['services.google.client_id' => setting('social-auth.google_client_id')]);
    	config(['services.google.client_secret' => setting('social-auth.google_client_secret')]);
	    return Socialite::driver('google')->redirect();
    
    }

    public function googleCallback(){
    	config(['services.google.client_id' => setting('social-auth.google_client_id')]);
    	config(['services.google.client_secret' => setting('social-auth.google_client_secret')]);
    	$socialUser = Socialite::driver('google')->user();

    	$google_auth = OauthGoogle::where('oauth_userid', '=', $socialUser->id)->first();
			        	
        if(isset($google_auth->id)){
        	$user = User::find($google_auth->user_id);
        } else {
        	// Execute Add or Login Oauth User
        	$user = User::where('email', '=', $socialUser->email)->first();
        	if(!isset($user->id)){
        		$username = $this->increment_username_if_exists(strtolower(str_slug($socialUser->name)));
        		$email = $socialUser->email;
        		$password = Hash::make(str_random(15));

        		if($socialUser->avatar_original != NULL){
        			$filename_url = 'users/' . $username . '/avatar.' . pathinfo($socialUser->avatar_original, PATHINFO_EXTENSION);
            		Storage::disk(config('voyager.storage.disk'))->put($filename_url, file_get_contents($socialUser->avatar_original), 'public');
            		$avatar = $filename_url;
            	} else {
            		$avatar = NULL;
            	}
        	
        		$user = $this->new_user($username, $email, $password, $avatar, true);
        		$this->new_user_points($user->id);

        		$new_oauth_user = new OauthGoogle;
        		$new_oauth_user->user_id = $user->id;
        		$new_oauth_user->oauth_userid = $socialUser->id;
        		$new_oauth_user->save();
        	} else {
        		// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
        		return redirect('/')->with(array('note' => __('lang.oauth_email_used'), 'note_type' => 'danger'));
        	}
        }
    	
    	// Redirect to new User Login;
    	Auth::login($user);
    	$this->add_user_login_point();
    	return redirect('/')->with('success', __('lang.google_success'));
    }

    private function increment_username_if_exists($username){
		$user = User::where('username', '=', $username)->first();
		$original = $username;
		$counter = 2;
		while (isset($user->id)) {
			$username = $original . (string)$counter;
			$user = User::where('username', '=', $username)->first();
			$counter += 1;
		}
		return $username;
	}

}