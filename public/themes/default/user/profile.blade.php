<div id="profile-container">
	<div class="profile-container">
		<div class="container">
		
			<?php if(!Auth::guest() && Auth::user()->id == $user->id): ?>
				<?php 
					$my_or_user_uploads = Lang::get('lang.my_uploads');
					$my_or_user_likes = Lang::get('lang.my_likes');
						$is_user_profile = true;
				?>
			<?php else: ?>
				<?php 
					$my_or_user_uploads = Lang::get('lang.your_uploads');
					$my_or_user_likes = Lang::get('lang.your_likes');
					$is_user_profile = false;
				?>
			<?php endif; ?>

			<a href="<?= URL::to('user/' . $user->username ) ?>"><img src="{{ Voyager::image( $user->avatar ) }}?version={{ uniqid() }}" alt="<?= $user->username ?>" class="img-circle user-avatar-large"></a>
			<div class="profile-info">
				<h2><?= $user->username ?> <?php if($is_user_profile): ?> <i class="fa fa-edit fa-edit-profile" data-toggle="modal" data-target="#edit-modal" style="cursor:pointer;"><span>Edit Profile</span></i><?php endif; ?></h2>
				<p class="profile-points"><i class="fa fa-star" style="color:gold"></i> <a href="<?= URL::to('user/' . $user->username . '/points' ) ?>""><?= $user_points ?> points</a> <i class="fa fa-question-circle points-question" style="cursor:pointer" data-toggle="modal" data-target="#aboutpoints"></i></p>
				<p><?= Lang::get('lang.member_since') ?>: <?= date("F j, Y", strtotime($user->created_at)) ?></p>
			</div>


		</div>

		<div class="user-profile-btns">
			<div class="container">
				<div class="user-btn-group">
					<div class="btn-group vid-pic" data-toggle="buttons" style="margin-bottom:0px; margin-top:0px;">
					  <label class="btn btn-default <?php if(Request::is('user/' . $user->username )): ?>active<?php endif; ?> user_profile_view" data-href="<?= URL::to('user/' . $user->username ) ?>" style="line-height:40px;">
					    <input type="radio" name="user_profile" id="uploads"> <i class="fa icon-cloud-upload" style="font-size:14px; margin-right:4px;"></i> <?= $my_or_user_uploads ?>
					  </label>
					  <label class="btn btn-default <?php if(Request::is('user/' . $user->username .'/likes')): ?>active<?php endif; ?> user_profile_view" data-href="<?= URL::to('user/' . $user->username . '/likes/' ) ?>" style="line-height:40px;">
					    <input type="radio" name="user_profile" id="likes"> <i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}" style="font-size:14px; margin-right:4px;"></i> <?= $my_or_user_likes ?>
					  </label>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<div style="clear:both"></div>