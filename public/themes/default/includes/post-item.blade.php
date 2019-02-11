<?php $post_url = url('/') . '/' . $post->slug; ?>

@if(!isset($single))
	<div class="social_container">
		 <ul class="socialcount socialcount-large" data-url="<?= $post_url ?>">
			<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $post_url ?>" target="_blank" title="<?= Lang::get('lang.share_facebook') ?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-facebook"></span><p class="count">Share</p></a></li>
			<li class="twitter"><a href="https://twitter.com/intent/tweet?url=<?= $post_url ?>&text=<?= $post->title ?>" data-url="<?= $post_url ?>" title="<?= Lang::get('lang.share_twitter') ?>"><span class="fa fa-twitter" data-url="<?= $post_url ?>"></span><p class="count">Tweet</p></a></li>
			<li class="googleplus"><a href="https://plus.google.com/share?url=<?= $post_url ?>" target="_blank" title="<?= Lang::get('lang.share_google') ?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-google-plus"></span><p class="count">+1</p></a></li>
			<li class="pinterest"><a href="//www.pinterest.com/pin/create/button/?url=<?= $post_url ?>&media={{ $post->pic_url }}&description=<?= $post->title ?>" title="<?= Lang::get('lang.share_pinit') ?>" target="_blank" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-pinterest"></span><p class="count">Pin It</p></a></li>						
		</ul>
	</div>
@endif

<div class="item-large">
  	<div class="single-title">
  		
  		<?php if($post->user()): ?>
  			<?php $user_url = URL::to('user') . '/' . $post->user()->username;
  				  $username = $post->user()->username;
  				  $user_avatar = Voyager::image($post->user()->avatar);
  			?>
  		<?php else: ?>
  			<?php $user_url = '#_';
  				  $username = Lang::get('lang.anonymous');
  				  $user_avatar = Voyager::image('users/default.png');
  			?>
  		<?php endif; ?>

		<a href="<?= $user_url ?>" target="_blank"><img src="<?= $user_avatar ?>?version={{ uniqid() }}" class="img-circle user-avatar-medium" /></a><h2 class="item-title"><a class="post_link" href="/<?= $post->slug; ?>" @if(theme('open_posts')) target="_blank" @endif alt="<?= $post->title ?>"><?= stripslashes($post->title) ?></a></h2>
		<div class="item-details">
			<p class="details"><?= Lang::get('lang.submitted_by') ?>: <a href="<?= $user_url ?>" target="_blank"><?= $username?></a> <?= Lang::get('lang.submitted_on') ?> <?= date("F j, Y", strtotime($post->created_at)) ?></p>
			<p class="home-like-count"><i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}"></i> <span><?= $post->totalLikes() ?></span></p>
			<p class="home-comment-count"><i class="fa fa-comments"></i> <?= count($post->comments) ?></p>
			<p class="home-view-count"><i class="fa fa-eye"></i> <?php if(isset($view_increment) && $view_increment == true ): ?><?= $post->views + 1 ?><?php else: ?><?= $post->views ?><?php endif; ?> </p>
		</div>
		
		<?php if(!Auth::guest()): ?>
			<?php $liked = App\Models\PostLike::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $post->id)->first(); ?> 
		<?php endif; ?>
		
		<div class="home-post-like <?php if(isset($liked->id)){ echo 'active'; } ?>" data-authenticated="<?php if(Auth::guest()): ?><?= 'false' ?><?php else: ?><?= 'true' ?><?php endif; ?>" data-id="<?= $post->id ?>"><i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}"></i></div>
		
	</div>

	<div class="clear"></div>

	<?php if($post->nsfw != 0 && Auth::guest()): ?>

		<div class="nsfw-container">
			<h1>NSFW!</h1>
			<p>This content has been marked as Not Safe For Work, login to view this content</p>
			<div class="nsfw-login-signup">
				<a href="<?= URL::to('login') ?>?redirect=<?= url($post->slug); ?>" class="btn btn-color nsfw-login">login</a>
				<span>or</span>
				<a href="<?= URL::to('signup') ?>?redirect=<?= url($post->slug); ?>" class="btn btn-color">signup</a>
			</div>
		</div>
	
	<?php else: ?>
	
		<?php if($post->vid != 1): ?>
			<?php if(strpos($post->pic_url, '.gif') > 0): ?>
				<div class="animated-gif">
					<img class="single-post animation" alt="..." src="{{ Voyager::image( $post->pic_url ) }}" data-animation="{{ Voyager::image( str_replace('.gif', '-animation.gif', $post->pic_url) ) }}" data-original="{{ Voyager::image( $post->pic_url ) }}" data-state="0" />
					<img style="display:none" src="{{ Voyager::image( str_replace('.gif', '-animation.gif', $post->pic_url) ) }}" />
					<p class="gif-play"><i class="fa fa-play-circle-o"></i></p>
				</div>
			<?php else:
					$str1 = $post->pic_url;
					$str2 = $post->pic_url_multi;
					$str = $str1 .";". $str2;
					$link1 =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$link2 = url($post->slug);
					if ($link1 == $link2) {
						$img = explode(";",$str);
					}
					else{
						$img = explode(";",$str1);
					}
					
					$img = array_filter($img);

					foreach ($img as $value) { ?>
						<?php if(isset($single) && $single): ?>
							<img class="single-post" alt="<?= stripslashes($post->title); ?>" src="{{ Voyager::image($value) }}" />
						<?php else: ?>
							<a href="<?= url($post->slug); ?>" alt="<?= $post->title ?>" @if(theme('open_posts')) target="_blank" @endif><img class="single-post" alt="<?= stripslashes($post->title); ?>" src="{{ Voyager::image($value) }}" /></a>
						<?php endif; ?>
			<?php 	} 
				endif; ?>
	
		<?php else: ?>

			<div class="video_container" <?php if(isset($single) && $single): ?>itemprop="video" itemscope itemtype="http://schema.org/VideoObject"<?php endif; ?>>
				
				@if(isset($single) && $single)
					<meta itemprop="thumbnailUrl" content="<?= Config::get('site.uploads_dir') . '/images/' . $post->pic_url ?>" />
					<meta itemprop="embedUrl" content="<?= $post->vid_url ?>" />
					<meta itemprop="name" content="<?= stripslashes($post->title) ?>" />
					<meta itemprop="description" content="<?= html_entity_decode($post->body); ?>" />
				@endif


				
				@if (strpos($post->vid_url, 'youtube') > 0 || strpos($post->vid_url, 'youtu.be') > 0)
			        
			        <!-- YOUTUBE VIDEO -->
					<iframe class="youtube-player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/{{ $post->youtubeVideoId() }}?theme=light&rel=0" frameborder="0" allowFullScreen></iframe>

			    @elseif (strpos($post->vid_url, 'vimeo') > 0)
			        
			        <!-- VIMEO VIDEO -->
			        <?php $vimeo_id = (int)substr(parse_url($post->vid_url, PHP_URL_PATH), 1); ?>
			        <iframe src="//player.vimeo.com/video/<?= $vimeo_id; ?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			    
			    @endif

			</div> <!-- .video_container -->

		<?php endif; ?>

	<?php endif; ?>

	@if(isset($single))
		<div class="social_container">
			 <ul class="socialcount socialcount-large" data-url="<?= $post_url ?>">
				<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $post_url ?>" target="_blank" title="<?= Lang::get('lang.share_facebook') ?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-facebook"></span><p class="count">Share</p></a></li>
				<li class="twitter"><a href="https://twitter.com/intent/tweet?url=<?= $post_url ?>&text=<?= $post->title ?>" data-url="<?= $post_url ?>" title="<?= Lang::get('lang.share_twitter') ?>"><span class="fa fa-twitter" data-url="<?= $post_url ?>"></span><p class="count">Tweet</p></a></li>
				<li class="googleplus"><a href="https://plus.google.com/share?url=<?= $post_url ?>" target="_blank" title="<?= Lang::get('lang.share_google') ?>" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-google-plus"></span><p class="count">+1</p></a></li>
				<li class="pinterest"><a href="//www.pinterest.com/pin/create/button/?url=<?= $post_url ?>&media={{ $post->pic_url }}&description=<?= $post->title ?>" title="<?= Lang::get('lang.share_pinit') ?>" target="_blank" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><span class="fa fa-pinterest"></span><p class="count">Pin It</p></a></li>						
			</ul>
		</div>
	@endif

	<!-- end NSFW IF -->

	@if(isset($item->body) && !empty(trim($item->body)))
		<p class="post_description"><?= html_entity_decode($post->body) ?></p>
	@endif

</div><!-- item-large -->