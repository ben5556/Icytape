<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Comment;
use \App\Models\Point;
use \App\Models\Notification;
use \App\Models\Post;
use \App\Models\CommentVote;
use \App\Models\CommentFlag;
use Input;
use Validator;
use Auth;
use DB;


class CommentsController extends \App\Http\Controllers\Controller {


	/**
	 * Comment Repository
	 *
	 * @var Comment
	 */
	protected $comment;

	public function __construct(\App\Models\Comment $comment)
	{
		$this->comment = $comment;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Comment::$rules);

		if ($validation->passes())
		{
			$last_comment = Comment::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->first();
			$current_date = new \DateTime(date("Y-m-d H:i:s"));

			if(empty($last_comment)){
				$interval = 5;
			} else {
				$interval = $current_date->diff($last_comment->created_at);
				$interval = intval($interval->format('%i'));
			}
			/*if($interval >= 3){*/
			
				$this->add_daily_comment_points();

				$comment = new Comment;
				$comment->post_id = $input['post_id'];
				$comment->comment = htmlspecialchars($input['comment']);
				$comment->user_id = Auth::user()->id;
				//echo $comment;

				if ($comment->save()) {
					$notification = new Notification;
					$post = Post::find($comment->post_id);
					$notification->user_id = $post->user_id;
					$user_comment = $comment->user()->username;
					$notification->url = '/' . $post->slug;
					if ($post->user_id == Auth::user()->id) {
						$notification->is_read = 1;
					} else{
						$notification->is_read = 0;
						$notification->content = $user_comment . " commented on " .'"'. $comment->post()->title .'"';
					}
					$notification->save();
				}
				echo $comment;
			/*} else {
				echo 0;
			}*/
		} else {

			echo 0;

		}
	}
	public function ajax_notification()
	{
		$notice = Notification::where('user_id', '=', Auth::user()->id)->where('is_read', '=' , 0)->get();
		foreach ($notice as $value) {			
			$value->is_read = 1;
			$value->save();
		}
	}

	// ADD Daily Points for commenting max 5 per day //

	private function add_daily_comment_points(){
		$user_id = Auth::user()->id;

		$LastCommentPoints = Point::where('user_id', '=', $user_id)->where('description', '=', __('lang.daily_comment'))->orderBy('created_at', 'desc')->take(5)->get();
		
		$total_daily_comments = 0;
		foreach($LastCommentPoints as $CommentPoint){
			if( date('Ymd') ==  date('Ymd', strtotime($CommentPoint->created_at)) ){
				$total_daily_comments += 1;
			}
		}

		if($total_daily_comments < 5){
			$point = new Point;
			$point->user_id = $user_id;
			$point->description = __('lang.daily_comment');
			$point->points = 1;
			$point->save();
			return true;
		} else {
			return false;
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		if ($request->ajax())
		{
			$comment = Comment::find($id);
			if(Auth::user()->id == $comment->user_id){
				$comment->comment = htmlspecialchars(Input::get('comment'));
				$comment->save();
			}
		}
	}

	// Vote Up for comment

	public function vote_up(){
		$id = Input::get('comment_id');
		$comment_vote = CommentVote::where('user_id', '=', Auth::user()->id)->where('comment_id', '=', $id)->first();

		if(isset($comment_vote->id)){ 
			$comment_vote->up = 1;
			$comment_vote->down = 0;
			$comment_vote->save();
			echo $comment_vote;
		} else { 
			$vote = new CommentVote;
			$vote->user_id = Auth::user()->id;
			$vote->comment_id = $id;
			$vote->up = 1;
			$vote->save();
			echo $vote;
		}
	}

	// Vote Flag for comment

	public function add_flag(){
		$id = Input::get('comment_id');
		$comment_flag = CommentFlag::where('user_id', '=', Auth::user()->id)->where('comment_id', '=', $id)->first();

		if(isset($comment_flag->id)){ 
			$comment_flag->delete();
		} else {
			$flag = new CommentFlag;
			$flag->user_id = Auth::user()->id;
			$flag->comment_id = $id;
			$flag->save();
			echo $flag;
		}
	}

	// Vote Down for comment

	public function vote_down(){
		$id = Input::get('comment_id');
		$comment_vote = CommentVote::where('user_id', '=', Auth::user()->id)->where('comment_id', '=', $id)->first();

		if(isset($comment_vote->id)){ 
			$comment_vote->up = 0;
			$comment_vote->down = 1;
			$comment_vote->save();
			echo $comment_vote;
		} else { 
			$vote = new CommentVote;
			$vote->user_id = Auth::user()->id;
			$vote->comment_id = $id;
			$vote->down = 1;
			$vote->save();
			echo $vote;
		}
	}

	// Admin Delete Comment

	public function delete($id){
		if($this->delete_comment($id) == 1){
			return Redirect::to('admin#comments')->with(array('note' => __('lang.delete_comment_success'), 'note_type' => 'success') );
		} else {
			return Redirect::to('admin#comments')->with(array('note' => 'Sorry there seems to have been a problem when deleting this comment', 'note_type' => 'error') );
		}
		
	}

	public function getCommentVotes($id){
		$upVotes = DB::table('comment_votes')->where('comment_id', '=', $id)->sum('up');
		$downVotes = DB::table('comment_votes')->where('comment_id', '=', $id)->sum('down');
		$totalVotes = $upVotes - $downVotes;
		return response()->json($totalVotes);
	}

	public function getCommentFlags($id){
		$num_flags = DB::table('comment_flags')->where('comment_id', '=', $id)->count();
		return response()->json($num_flags);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
		if ($request->ajax())
		{
			$this->delete_comment($id);
		}
	}

	// Delete Comment from single media page

	public function delete_comment($id){
		$comment = Comment::find($id);
		if(Auth::user()->id == $comment->user_id || Auth::user()->admin == 1){

			$comment_votes = CommentVote::where('comment_id', '=', $id)->get();
			foreach($comment_votes as $votes){
				$votes->delete();
			}

			$comment_flags = CommentFlag::where('comment_id', '=', $id)->get();
			foreach($comment_flags as $flag){
				$flag->delete();
			}

			$comment->delete();
			echo 1;
		} else {
			echo 0;
		}
	}

}