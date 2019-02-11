@extends('theme::app')

@section('content')

<style type="text/css">
	body{
		padding-top:65px;
	}

	.alert{
		margin-top: 0px;
    	margin-bottom: 20px;
	}
	.item-large{
		width:100%;
	}
	.main_home_container{
		padding-top:0px;
	}
</style>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php $post = $item; ?>

<div class="container main_home_container single">

	<div id="postTopAd">
		@if(theme('ad_post_top'))
			{!! theme('ad_post_top') !!}
		@else
			<a href="http://codecanyon.net/item/ninja-media-script-viral-fun-media-sharing-site/6822888" target="_blank"><img src="/themes/default/assets/img/top-advertisement.jpg" width="728" height="90"></a>
		@endif
	</div>

	<div id="postTopAdMobile">
		@if(theme('ad_post_top_mobile'))
			{!! theme('ad_post_top_mobile') !!}
		@else
			<a href="http://codecanyon.net/item/ninja-media-script-viral-fun-media-sharing-site/6822888" target="_blank"><img src="/themes/default/assets/img/mobile-advertisement.jpg" width="350" height="50"></a>
		@endif
	</div>

	<div class="single-left col-md-8 col-lg-8 col-sm-12">
		
		<div class="col-sm-12 item animated single-left" data-href="<?= '/' . $post->id ?>">

			@include('theme::includes.post-item')

			<div style="clear:both"></div>

			<?php $media_url = URL::to('media') . '/' . $item->slug; ?>
		
			<div id="below_media">

				<?php if(isset($item->link_url) && $item->link_url != ''): ?>
					<a href="<?= $item->link_url ?>" target="_blank" class="label label-success" style="margin-top:6px;"><i class="fa fa-globe"></i> <?= Lang::get('lang.source') ?></a>
				<?php endif; ?>

				<?php if(!Auth::guest() && (Auth::user()->admin == 1 || Auth::user()->id == $item->user_id)): ?>
				
					<div class="edit-delete">
						<a href="#_" data-href="{{ url('post/delete') . '/' . $item->id }}" data-id="{{ $item->id }}" onclick="confirm_delete(this)" class="label label-danger"><i class="icon-trash"></i> <?= Lang::get('lang.delete') ?></a>
						<a href="#_" data-toggle="modal" data-target="#edit-modal" class="label label-warning"><i class="icon-edit"></i> <?= Lang::get('lang.edit') ?></a>
					</div>
				<?php endif; ?>
			</div>
		

			<div style="clear:both"></div>

			<h3 class="comment-type site active" data-comments="#current_comments"><?= Lang::get('lang.site_comments') ?> (<span class="current_comment_count site_comments"><?= $post->comments()->get()->count() ?></span>)</h3>
			<h3 class="comment-type facebook" data-comments="#facebook_comments"><?= Lang::get('lang.facebook_comments') ?> (<span class="current_comment_count"><fb:comments-count href="<?= Request::url() ?>"></fb:comments-count></span>)</h3>

			<div id="facebook_comments">
				<div class="fb-comments" data-href="<?= Request::url() ?>" data-width="660" data-numposts="5" data-colorscheme="light"></div>
			</div>

			<div id="current_comments">

				<div class="comment-submit">
					<?php if(Auth::guest()): ?>
						<h2 style="padding-left:0px; text-align:center;"><?= Lang::get('lang.sign_in_to_comment', array('before_signin' => '<a href="' . URL::to("login") . '">', 'after_signin' => '</a>', 'before_signup' => '<a href="' . URL::to("signup") . '">', 'after_signup' => '</a>')) ?></h2>
					<?php else: ?>
						<h5><?= Lang::get('lang.add_a_comment') ?></h5>
						<img src="{{ Voyager::image( Auth::user()->avatar ) }}?version={{ uniqid() }}" class="user-avatar-small img-rounded" style="width:8.5%; margin-right:1.5%" /><textarea placeholder="<?= Lang::get('lang.write_comment_here') ?>" class="form-control" style="border-width:2px; width:90%;" id="comment"></textarea>
						<div class="btn pull-right btn-color" style="margin-top:15px;" id="comment-submit"><?= Lang::get('lang.post_comment_btn') ?></div><div style="clear:both"></div>
						<input type="hidden" name="post_id" id="post_id" value="<?= $post->id ?>" />
					<?php endif; ?>
				</div>
				<div style="clear:both"></div><br />
				<div class="comment-loop">
				<?php foreach($post->comments()->orderBy('created_at', 'desc')->get() as $comment): ?>

					<div class="comment comment-<?= $comment->id ?>">
						
						<?php if(!Auth::guest()): ?>
							<?php $user_vote = App\Models\CommentVote::where('user_id', '=', Auth::user()->id)->where('comment_id', '=', $comment->id)->first(); ?>
						<?php endif; ?>

						<div class="comment_vote pull-left">
							<i class="fa fa-chevron-up vote-up <?php if(isset($user_vote->up) && $user_vote->up): ?> active <?php endif; ?>" data-commentid="<?= $comment->id ?>"></i>
							<p><?= $comment->totalVotes() ?></p>
							<i class="fa fa-chevron-down vote-down <?php if(isset($user_vote->down) && $user_vote->down == 1): ?> active <?php endif; ?>" data-commentid="<?= $comment->id ?>"></i>
						</div>

						<?php if(!Auth::guest()): ?>
							
							<div class="flag_edit_delete_comment">
								<a class="flag_comment" data-id="<?= $comment->id ?>"><i class="fa fa-flag"></i> + <span class="num_flags"><?= $comment->totalFlags() ?></span></a><?php if(Auth::user()->id == $comment->user_id  || Auth::user()->admin == 1): ?><a class="edit_comment" data-id="<?= $comment->id ?>"><i class="fa fa-edit"></i></a><a class="delete_comment" data-id="<?= $comment->id ?>"><i class="fa fa-trash-o"></i></a><?php endif; ?>
							</div>

							<div class="delete_comment_confirm delete_comment_confirm_<?= $comment->id ?>">
								Confirm Delete?
								<button data-id="<?= $comment->id ?>" class="delete_comment_yes">Yes</button>
								<button class="delete_comment_no">No</button>
							</div>

						<?php endif; ?>

						<div class="comment_container border-radius" data-id="<?= $comment->id ?>">
							
							<a href="<?= URL::to('user') . '/' . $comment->user()->username ?>"><img src="{{ Voyager::image($comment->user()->avatar) }}?version={{ uniqid() }}" class="user-avatar-small img-circle" /></a>
							<div class="comment_info">
								<p class="timeago" title="<?= date('F j, Y, g:i a', strtotime($comment->updated_at)) ?>"><?= date('F j, Y, g:i a', strtotime($comment->created_at)) ?></p>
								<h4><a href="<?= URL::to('user') . '/' . $comment->user()->username ?>"><?= $comment->user()->username ?></a> <?= Lang::get('lang.wrote') ?>:</h4>
							</div>
							<p class="comment_data"><?= $comment->comment ?></p>

						</div>
					</div>

				<?php endforeach; ?>
				</div>

			</div><!-- #current_comments -->

		</div>

	</div>


	<input type="hidden" id="user_media" name="user_media" value="<?php if(!Auth::guest() && Auth::user()->id == $item->user_id): ?><?= 'true' ?><?php else: ?><?= 'false' ?><?php endif; ?>" />
	<input type="hidden" id="user_id" name="user_id" value="<?php if(!Auth::guest()): ?><?= Auth::user()->id ?><?php else: ?>0<?php endif; ?>" />
	
	@include('theme::includes.sidebar')

</div>


@if(!Auth::guest() && (Auth::user()->admin == 1 || Auth::user()->id == $item->user_id))
	@include('theme::includes.media-show-edit')
@endif
	
@stop

@section('javascript')

	<script type="text/javascript">

	$(document).ready(function(){

		$('.comment-type').click(function(){
			var comment_type = $(this).data('comments');
			$('#current_comments, #facebook_comments').hide();
			$(comment_type).show();
			$('.comment-type').removeClass('active');
			$(this).addClass('active');
		});

		$(".timeago").timeago();
		
		$('.item-large').find('.video_container').fitVids();

		$('.delete_comment_yes').on('click', function(){ delete_comment($(this).data('id')); });
		$('.delete_comment').on('click', function(){
			$('.delete_comment_confirm_' + $(this).data('id')).slideDown();
		});

		$('.edit_comment').on('click', function(){ edit_comment($(this).data('id')); });

		$('.vote-up').click(function(){ vote_up($(this)); });
		$('.vote-down').click(function(){ vote_down($(this)); });

		$('.media-flag').click(function(){
			this_object = $(this);
			flag_this_text = "<?= Lang::get('lang.flag_this') ?>";
			flagged_text = "<?= Lang::get('lang.flagged') ?>";
			$.post("<?= URL::to('comments') . '/add_flag' ?>", { post_id: $(this).data('id'), _token: $('meta[name="csrf-token"]').attr('content')  }, function(data){
				$(this_object).toggleClass('active');
				if($(this_object).find('.media-flag-desc').text() == flag_this_text){
					$(this_object).find('.media-flag-desc').text(flagged_text);
				} else {
					$(this_object).find('.media-flag-desc').text(flag_this_text);
				}
			});
		});

		$('.animation').attr('src', $('.animation').data('animation'));
		$('.animation').data('state', 1);
		$('.animated-gif').find('.gif-play').hide();


		$('.home-media-like').click(function(){
			if($(this).data('authenticated') == false){
				window.location = '<?= URL::to("signup") ?>';
			}
			this_object = $(this);
			$(this).children('i').removeClass('animated').removeClass('rotateIn');
			$(this_object).toggleClass('active');
			var like_count = $(this_object).parent().find('.home-like-count span');
			if($(this_object).hasClass('active')){
				$(this_object).children('i').addClass('animated').addClass('bounceIn');
				like_count.text( parseInt(like_count.text()) + 1 );
			} else {
				like_count.text( parseInt(like_count.text()) - 1 );
			}
			$.post("<?= URL::to('media') . '/add_like' ?>", { post_id: $(this).data('id') }, function(data){
				
			});
		});

		$('.flag_comment').click(function(){
			flag_comment($(this));
		});

		$('#comment-submit').click(function(){

			if($('#comment').val().length >= 5){

				$('#comment-submit').prepend('<i class="fa fa-refresh fa-spin"></i> ');

				var newComment = {
					comment: $('#comment').val(),
					post_id: $('#post_id').val(),
					_token: $('meta[name="csrf-token"]').attr('content')
				};

				$.post("<?= URL::to('comments') ?>", newComment, function(data){
					
						comment = JSON.parse(data);
						if(comment){
							$('.comment-loop').prepend( comment_template( comment ) );
							$('.comment-' + comment.id).find('.delete_comment').click(function(){ $('.delete_comment_confirm_' + $(this).data('id')).slideDown(); });
							$('.comment-' + comment.id).find('.delete_comment_yes').click(function(){ delete_comment($(this).data('id')); });
							$('.comment-' + comment.id).find('.edit_comment').click(function(){ edit_comment($(this).data('id')); });
							$('.comment-' + comment.id).find('.flag_comment').click(function(){ flag_comment($(this)); });
							$('.comment-' + comment.id).find('.vote-up').click(function(){ vote_up($(this)); });
							$('.comment-' + comment.id).find('.vote-down').click(function(){ vote_down($(this)); });
							increment_comment_count();
							clear_comment_fields();
						} else {
							var no_spamming_text = "<?= Lang::get('lang.spam_warn_comments') ?>";
							var n = noty({text: no_spamming_text, layout: 'top', type: 'error', template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>', closeWith: ['button'], timeout:2000 });
						}
						$('#comment-submit').children('i').remove();
					});

				} else {
					var min_char_comment_text = "<?= Lang::get('lang.min_char_comments') ?>";
					var n = noty({text: min_char_comment_text, layout: 'top', type: 'error', template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>', closeWith: ['button'], timeout:2000 });
				}

			});

			img_vid_toggle();


		});

		function img_vid_toggle(){
			$('#vid_selected').click(function(){
				$(this).addClass('active');
				$('#img_selected').removeClass('active');
				$('#vid_container').show();
				$('#img_container').hide();
			});

			$('#img_selected').click(function(){
				$(this).addClass('active');
				$('#vid_selected').removeClass('active');
				$('#vid_container').hide();
				$('#img_container').show();
			});

		}

		function increment_comment_count(){
			cur_val = parseInt($('.current_comment_count.site_comments').text());
			$('.current_comment_count.site_comments').text(cur_val + 1);
		}

		function decrement_comment_count(){
			cur_val = $('.current_comment_count').text();
			$('.current_comment_count').text(parseInt(cur_val) - 1);
		}

		function update_comment_votes(this_object){
			$(this_object).parent().find('p').removeClass('animated').addClass('flip');
			$.getJSON("/comments/votes/" + String($(this_object).data('commentid')), function(data){
				$(this_object).parent().find('p').text(data);
				$(this_object).parent().find('p').addClass('animated').addClass('flip');
			});
		}

		function edit_comment(id){

			container = '.comment-'+ id + ' .comment_container';
			comment = $(container).find('p.comment_data');
			if($(container).find('p.comment_data').css('display') == 'block'){
				console.log('hit if');
				comment.hide();
				if($(container).find('.correct-comment-btn').length != 0){
					$(container).find('.correct-comment-btn').hide();
				}
				var cancel_text = "<?= Lang::get('lang.cancel') ?>";
				$(container).append('<div class="update-comment"><textarea class="form-control update-comment-' + id + '">'+ comment.html() + '</textarea><div class="btn btn-color pull-right comment-update-update" data-commentid="' + id + '">Update</div><div class="btn pull-right comment-update-cancel" data-commentid="' + id + '">'+cancel_text+'</div><div style="clear:both"></div></div>');
				$(container).find('.update-comment').focus();
				bind_update_buttons();
			} else {
				console.log('hit else');
				if($(container).find('.correct-comment-btn').length != 0){
					$(container).find('.correct-comment-btn').show();
				}
				comment.show();
				$('.update-comment').hide();
			}
		}

		function flag_comment(object){
			this_object = $(object);
			$.post("<?= URL::to('comments') . '/add_flag' ?>", { comment_id: $(this_object).data('id'), _token: $('meta[name="csrf-token"]').attr('content') }, function(data){
				$.getJSON("/comments/flags/" + String($(this_object).data('id')), function(data){
					$(this_object).parent().find('.num_flags').text(data);
				});
			});
		}

		function vote_up(object){
			this_object = $(object);
			$.post("<?= URL::to('comments') . '/vote_up' ?>", { comment_id: $(this_object).data('commentid'), _token: $('meta[name="csrf-token"]').attr('content')  }, function(data){
				update_comment_votes(this_object);
			});
			$(this_object).addClass('active');
			$(this_object).parent().find('.vote-down').removeClass('active');
		}

		function vote_down(object){
			this_object = $(object);
			$.post("<?= URL::to('comments') . '/vote_down' ?>", { comment_id: $(this_object).data('commentid'), _token: $('meta[name="csrf-token"]').attr('content') }, function(data){
				update_comment_votes(this_object);
			});
			$(this).addClass('active');
			$(this).parent().find('.vote-up').removeClass('active');
		}

		function bind_update_buttons(){
			$('.comment-update-cancel').bind('click', function(){
				comment_id = $(this).data('commentid');
				container = '.comment-'+ comment_id + ' .comment_container';
				$(container).find('p.comment_data').show();
				$(container).find('.update-comment').hide();
				if($(container).find('.correct-comment-btn').length != 0){
					$(container).find('.correct-comment-btn').show();
				}
			});

			$('.comment-update-update').bind('click', function(){
				comment_id = $(this).data('commentid');
				container = '.comment-'+ comment_id + ' .comment_container';
				var updateComment = {
					comment: $('.update-comment-'+comment_id).val(),
					_method: 'PATCH',
					_token: $('meta[name="csrf-token"]').attr('content')
				};

				$.post("<?= URL::to('comments') ?>/"+comment_id, updateComment, function(data){
					$(container).find('p.comment_data').html($('.update-comment-'+comment_id).val());
					$(container).find('p.comment_data').show();
					$(container).find('.update-comment').hide();
				});
			});
		}

		function comment_template(comment){
			if(comment.user_id == $('#user_id').val()){
				edit = '<div class="flag_edit_delete_comment"><a class="flag_comment" data-id="' + comment.id + '"><i class="fa fa-flag"></i> + <span class="num_flags">0</span></a><a class="edit_comment" data-id="' + comment.id + '"><i class="fa fa-edit"></i></a><a class="delete_comment" data-id="' + comment.id + '"><i class="fa fa-trash-o"></i></a></div><div class="delete_comment_confirm delete_comment_confirm_' + comment.id + '">Confirm Delete?<button data-id="' + comment.id + '" class="delete_comment_yes">Yes</button><button class="delete_comment_no">No</button></div>';
			} else {
				edit = '';
			}

			votes = '<div class="comment_vote pull-left"><i class="fa fa-chevron-up vote-up" data-commentid="' + comment.id + '"></i><p>0</p><i class="fa fa-chevron-down vote-down" data-commentid="' + comment.id + '"></i></div>';
			
			<?php if(Auth::guest()): ?>
				return false;
			<?php else: ?>
				few_seconds_ago = "<?= Lang::get('lang.few_seconds_ago') ?>";
				wrote_text = "<?= Lang::get('lang.wrote') ?>";
				comment_info = '<div class="comment_info"><p class="timeago">' + few_seconds_ago + '</p><h4><a href="<?= URL::to("user") . "/" . Auth::user()->username ?>"><?= Auth::user()->username ?></a> ' + wrote_text + ':</h4></div>';
				user_avatar = '<a href="<?= URL::to("user") . "/" . Auth::user()->username ?>"><img src="{{ Voyager::image( Auth::user()->avatar ) }}" class="user-avatar-small img-circle" /></a>';
				new_comment = '<div class="comment comment-' + comment.id + '">' + votes + edit + '<div class="comment_container" data-id="'+ comment.id +'">' + user_avatar + comment_info + '<p class="comment_data">' + comment.comment + '</p><div style="clear:both"></div></div></div>';
				console.log(comment);
				return new_comment;
			<?php endif; ?>
		}

		function clear_comment_fields(){
			console.log('testclear');
			$('#comment').val('');
			$('#file_upload').show();

			$('#preview_image').attr('src', '');
			$('#img_attached').text('');
			$('#video_link').val('');

		}

		function delete_comment(id){
			$.ajax({
				url:"<?= URL::to('comments') ?>/"+id, 
				type: 'POST',
			 	data: { _method:'DELETE', _token: $('meta[name="csrf-token"]').attr('content') }, 
			 	success: function(data){
			 		if(data){
			 			$('.comment-'+id).fadeOut();
			 			decrement_comment_count();
			 		}
				}
			});
		}

		$(document).ready(function(){
			$('.tags_input').tagsInput();
		});

		function confirm_delete(obj){
			var confirm_text = "{{ __('lang.confirm_delete_item') }}";
			var delete_link = $(obj).data('href');
			var delete_post_id = $(obj).data('id');
			var result = confirm(confirm_text);
			if(result){
				location.href=delete_link;
			}
		}

	</script>


@stop