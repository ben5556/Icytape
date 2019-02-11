<?php

if($post_display == 'grid_large' || $post_display == 'grid'):

	if($post_display == 'grid'){ $column = 'col-sm-4'; } else { $column = 'col-sm-6'; } ?>

	<!-- GRID -->

		<div id="posts">

		<style>
			.item .container{
				padding:0px;
				margin:0px 12px;
			}

			.item img{
				-webkit-border-top-left-radius: 3px;
				-webkit-border-top-right-radius: 3px;
				-moz-border-radius-topleft: 3px;
				-moz-border-radius-topright: 3px;
				border-top-left-radius: 3px;
				border-top-right-radius: 3px;
			}
			#posts{
				margin-top:15px;
			}

			p.home-like-count, p.home-comment-count, p.home-view-count{
				float:none;
				display:inline-block;
				margin-top:0px;
				margin-bottom:0px;
				line-height:32px;
			}

			.home-post-like{
				position: absolute;
				right: 0px;
				top: 0px;
				font-size: 18px;
				width: 40px;
				height: 32px;
				border: 0px solid #eee;
				line-height: 30px;
				background: #ddd;
				color: #fff;
				z-index: 999;
				-webkit-border-radius: 0px;
				-moz-border-radius: 0px;
				border-radius: 0px;
				-webkit-border-bottom-right-radius: 3px;
				-moz-border-radius-bottomright: 3px;
				border-bottom-right-radius: 3px;
			}

			.grid_details{
				position:relative;
			}

			.grid_item_title{
				background:#f9f9f9;
				text-align:center;
				padding-top:20px;
			}

			.grid_item_title a{
				margin:0px;
				padding:5px;
				text-align:center;
				display:block;
				color:#333;
			}

			.grid_item_title a:hover{
				text-decoration:none;
			}


			.grid_item_details{
				position:relative;
				background:#eee;
				-webkit-border-bottom-left-radius: 3px;
				-webkit-border-bottom-right-radius: 3px;
				-moz-border-radius-bottomleft: 3px;
				-moz-border-radius-bottomright: 3px;
				border-bottom-left-radius: 3px;
				border-bottom-right-radius: 3px;
				line-height:20px;
				text-align:center;
			}

			.single-left img.user-avatar-medium{
				width: 40px;
				height: 40px;
				position: absolute;
				left: 50%;
				margin-left:-20px;
				border:2px solid #fff;
				top: -20px;
				-webkit-border-radius: 20px;
				-moz-border-radius: 20px;
				border-radius: 20px;
			}

			.pagination-outter{
				bottom: 0px;
				position: absolute;
				display:block;
			}
			.pagination-outter.load_more{
				display:block;
			}
			.container.main_home_container{
				padding-left:10px !important;
			}
			/*#posts .grid-sizer { width: 33.33333333333333%; }*/

		</style>


		<?php $count = 1; ?>
		<?php foreach($posts as $post): ?>


				<div class="item animated single-left <?= $column ?>" data-href="<?= URL::to('post') . '/' . $post->id ?>" data-id="<?= $post->id ?>">

				<div class="container">
				  	<div class="single-title" style="display:none">
				  		<?php if($post->user()): ?>
				  			<?php $user_url = URL::to('user') . '/' . $post->user()->username;
				  				  $username = $post->user()->username;
				  			?>
				  		<?php else: ?>
				  			<?php $user_url = '#_';
				  				  $username = Lang::get('lang.anonymous');
				  			?>
				  		<?php endif; ?>

							<a href="<?= $user_url ?>"><img src="{{ Voyager::image( $post->user()->avatar ) }}?version={{ uniqid() }}" class="img-circle user-avatar-medium" /></a><h2 class="item-title"><a href="/{{ $post->slug }}" @if(theme('open_posts')) target="_blank" @endif alt="<?= $post->title ?>"><?= stripslashes($post->title) ?></a></h2>
							<div class="item-details">
								<p class="details"><?= Lang::get('lang.submitted_by') ?>: <a href="<?= $user_url ?>"><?= $username ?></a> <?= Lang::get('lang.submitted_on') ?> <?= date("F j, Y", strtotime($post->created_at)) ?></p>
								<p class="home-like-count"><i class="fa {{ setting('site.like_icon') }}"></i> <span><?= $post->totalLikes() ?></span></p>
								<p class="home-comment-count"><i class="fa fa-comments"></i> <?= $post->totalComments() ?></p>
								<p class="home-view-count"><i class="fa fa-eye"></i> <?php if(isset($view_increment) && $view_increment == true ){ ?><?= $post->views + 1 ?><?php } else { ?><?= $post->views ?><?php } ?> </p>
							</div>
							<?php if(!Auth::guest()): ?>
								<?php $liked = App\Models\PostLike::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $post->id)->first(); ?> 
							<?php endif; ?>
							<div class="home-post-like <?php if(isset($liked->id)){ echo 'active'; } ?>" data-authenticated="<?php if(Auth::guest()){ ?><?= 'false' ?><?php } else { ?><?= 'true' ?><?php } ?>" data-id="<?= $post->id ?>"><i class="fa {{ setting('site.like_icon') }}"></i></div>
						
					</div>

					<div class="clear"></div>

					
						<?php if($post->vid != 1): ?>
							<?php if(strpos($post->pic_url, '.gif') > 0): ?>
								<div class="animated-gif">
									<img class="single-post animation" alt="..." src="{{ Voyager::image( $post->pic_url ) }}" data-animation="{{ Voyager::image( str_replace('.gif', '-animation.gif', $post->pic_url) ) }}" data-original="{{ Voyager::image( $post->pic_url ) }}" data-state="0" />
									<img style="display:none" src="{{ Voyager::image( str_replace('.gif', '-animation.gif', $post->pic_url) ) }}" />
									<p class="gif-play"><i class="fa fa-play-circle-o"></i></p>
								</div>
							<?php else: ?>
								<a href="/{{ $post->slug }}" @if(theme('open_posts')) target="_blank" @endif alt="<?= $post->title ?>"><img class="single-post" alt="{{ $post->title }}" src="{{ Voyager::image( $post->pic_url ) }}" /></a>
							<?php endif; ?>
						<?php else: ?>
							
							<div class="video_container">

								<!-- YOUTUBE VIDEO -->
								<?php if (strpos($post->vid_url, 'youtube') > 0 || strpos($post->vid_url, 'youtu.be') > 0): ?>
							        
									<iframe title="YouTube video player" class="youtube-player" type="text/html" width="640"
					height="360" src="http://www.youtube.com/embed/{{ $post->youtubeVideoId() }}?theme=light&rel=0" frameborder="0"
					allowFullScreen></iframe>

							   

							    <!-- VIMEO VIDEO -->
							    <?php elseif (strpos($post->vid_url, 'vimeo') > 0): ?>
							        <?php $vimeo_id = (int)substr(parse_url($post->vid_url, PHP_URL_PATH), 1); ?>
							        <iframe src="//player.vimeo.com/video/<?= $vimeo_id; ?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							    
							
							    <?php endif; ?>

								


							</div>
						<?php endif; ?>

					<div class="grid_details">
						<a href="<?= $user_url ?>"><img src="<?= Voyager::image( $post->user()->avatar ) ?>?version={{ uniqid() }}" class="img-circle user-avatar-medium" /></a>
						<div class="grid_item_title"><a href="<?= url($post->slug); ?>" @if(theme('open_posts')) target="_blank" @endif><?= $post->title ?></a></div>
						<div class="grid_item_details">
							
							<p class="home-like-count"><i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}"></i> <span><?= $post->totalLikes() ?></span></p>
							<p class="home-comment-count"><i class="fa fa-comments"></i> <?= $post->totalComments() ?></p>
							<p class="home-view-count"><i class="fa fa-eye"></i> <?php if(isset($view_increment) && $view_increment == true ){ ?><?= $post->views + 1 ?><?php } else { ?><?= $post->views ?><?php } ?> </p>
							
							<?php if(!Auth::guest()): ?>
								<?php $liked = App\Models\PostLike::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $post->id)->first(); ?> 
							<?php endif; ?>
							<div class="home-post-like <?php if(isset($liked->id)){ echo 'active'; } ?>" data-authenticated="<?php if(Auth::guest()){ ?><?= 'false' ?><?php } else { ?><?= 'true' ?><?php } ?>" data-id="<?= $post->id ?>"><i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}"></i></div>
							

							<div class="clear"></div>
						</div>
					</div>



				</div><!-- item-large -->

				</div>
			<?php endforeach; ?>

			

		</div><!-- #posts -->

	<!-- END GRID LAYOUT -->

<?php else: ?>


	<div id="posts" style="padding-bottom:70px;">

		<?php foreach($posts as $post): ?>

			<div class="col-sm-12 item animated single-left" data-href="<?= URL::to('post') . '/' . $post->id ?>" data-id="<?= $post->id ?>">

			<?php $view = ''; ?>
			@include('theme::includes.post-item')


			<div style="clear:both"></div>
			<div class="post-separator"></div>

			</div>

		<?php endforeach; ?>

	</div><!-- #post -->



<?php endif; ?>

<div style="clear:both"></div>

<div class="page-load-status">
	<div class="infinite-scroll-request"><div class='la-ball-clip-rotate la-color'><div></div></div> <p>Loading More Posts</p></div>
	<p class="infinite-scroll-last">No More Posts to Load</p>
</div>

@include('theme::includes.pagination')

