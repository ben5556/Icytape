@extends('theme::app')

@section('content')

<div class="user-profile-outer">
	<div class="user-profile">

			<img src="{{ Voyager::image( $user->avatar ) }}" alt="<?= $user->username ?>">
			
			<h2><?= $user->username ?> <?php if($is_user_profile): ?> <i class="fa fa-edit edit-user-profile" data-toggle="modal" data-target="#edit-modal" style="cursor:pointer;"></i><?php endif; ?></h2>
			<p>Member Since: <?= date("F j, Y", strtotime($user->created_at)) ?></p>
			<p><i class="fa fa-star"></i> <a href="<?= URL::to('user/' . $user->username . '/points' ) ?>""><?= $user_points ?> <?= Lang::get('lang.points') ?></a></p>
			
			<ul>
				<li <?php if(Request::is('user/' . $user->username)): ?>class="active"<?php endif; ?>><a href="<?= URL::to('user') . '/' . $user->username ?>"><i class="fa fa-cloud-upload"></i> <?= $user->username ?>'s uploads</a></li>
				<li <?php if(Request::is('user/' . $user->username .'/likes')): ?>class="active"<?php endif; ?>><a href="<?= URL::to('user') . '/' . $user->username ?>/likes"><i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}"></i> <?= $user->username ?>'s likes</a></li>
			</ul>

	</div><!-- .user-profile -->
</div>


<div id="wrap" class="user">

<?php if($is_user_profile): ?>
	@include('theme::includes.edit-user-profile')
<?php endif; ?>

<?php if(isset($points)): ?>

	@include('theme::includes.user-points')
	
<?php else: ?>

	<div id="media" class="col-md-8 col-lg-8" style="display:block; clear:both; margin:0px auto; padding:0px; padding-bottom:70px;">

		<?php if(count($posts) == 0): ?>
			<h2 style="padding:10px 0px;"><i class="fa-meh-o fa"></i> <?php if(isset($likes)): ?>No Likes Yet <?php else: ?> No Uploads Yet <?php endif; ?></h2>
		<?php endif; ?>

		<?php foreach($posts as $item): ?>

			<?php
			if(isset($likes)){
			 	$item = $item->post();
			} 
			?>

			  
			<div class="col-sm-12 item animated single-left" data-href="{{ url( $item->slug ) }}">

				@include('theme::includes.post-item')

			</div>
			  

		<?php endforeach; ?>
		
		<div style="clear:both"></div>
		
		<?php echo $posts->links(); ?>	

	</div><!-- #media -->


<?php endif; ?>

</div>

@stop