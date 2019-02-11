@extends('theme::app')

@section('css')
	<style type="text/css">

		.navbar.gallery-sub-header{
			display:none;
		}

		div.pagination{
			padding-left:90px;
			padding-right:80px;
		}

		.alert{
			margin-top:0px;
			position:relative;
			top:-6px;
		}

		@media (max-width:767px) {
			.alert{
				top:110px;
			}
		}

	</style>
@stop

@section('above_alert')

	@include('theme::user.profile')

@stop

@section('content')

	<div class="container main_home_container">

		<div class="col-md-12">

			<?php if(isset($points)): ?>

				@include('theme::user.points')

			<?php else: ?>

				<div id="posts" class="col-md-8 col-lg-8" style="display:block; clear:both; margin:0px auto; padding:0px; padding-bottom:70px;">

					<?php if(count($posts) == 0): ?>
						<h2 style="padding:10px 0px;"><i class="fa-meh-o fa"></i> <?php if(isset($likes)): ?><?= Lang::get('lang.no_likes_yet') ?><?php else: ?><?= Lang::get('lang.no_uploads_yet') ?><?php endif; ?></h2>
					<?php endif; ?>

					<?php foreach($posts as $post): ?>

						<?php
						if(isset($likes)){
						 	$post = $post->post();
						} 
						?>

						  
						<div class="col-sm-12 item animated single-left" data-href="/{{ $post->id }}">

							@include('theme::includes.post-item')

						</div>
						  

					<?php endforeach; ?>	
					
					<div style="clear:both"></div>
					@include('theme::includes.pagination')	

				</div><!-- #media -->

			<?php endif; ?>

			<div class="col-md-4 col-lg-4" style="padding-top:15px; padding-right:5px;">

				@include('theme::ads.sidebar-ad')
				@include('theme::includes.posts-sidebar')

			</div>

	</div>

		</div>

	</div>

	<?php if(!Auth::guest() && Auth::user()->id == $user->id): ?>

		@include('theme::user.edit')

	<?php endif; ?>

	@include('theme::user.aboutpoints')

@stop

@section('javascript')

	<script>

		$(document).ready(function(){

			$('.hover_tooltip').tooltip({ placement: 'bottom' });

			$('.user_profile_view').click(function(){
				window.location = $(this).data('href');
			});

			$('points-question').tooltip('show')

			$('points-question').tooltip('show');

			$('.flag-user').click(function(){
					this_object = $(this);
					$.post("<?= URL::to('user') . '/add_flag' ?>", { user_id: $(this).data('id') }, function(data){
						
						$.getJSON("<?= URL::to('api') . '/commentflags/' ?>" + String($(this_object).data('id')), function(data){
							flagged_user = "<?= Lang::get('lang.flagged_this_user') ?>";
							flag_user = "<?= Lang::get('lang.flag_user') ?>";
							if($(this_object).find('.flag-message').text() == flagged_user)
							{	
								$(this_object).find('.flag-message').text(flag_user);
							} else {
								$(this_object).find('.flag-message').text(flagged_user);
							}
						});
					});
				});
		});

	</script>

@stop