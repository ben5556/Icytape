@extends('theme::app')

@section('content')

<!-- Edit User Profile -->

	<div class="container leaderboard-page">

			<div class="col-md-8 col-md-offset-2">

				<h1><i class="fa fa-trophy" style="color:gold"></i> Points Leaderboard</h1>

		      	<ul class="leaders">
		      		@php $rank = 1; @endphp
		      		<?php foreach($leaders as $user): ?>

		      			<li>
		      				<p class="rank">{{ $rank }}</p>
		      				<a href="<?= URL::to('user/' . $user->username ) ?>"><img src="{{ Voyager::image( $user->avatar ) }}" alt="<?= $user->username ?>" class="img-circle user-avatar-small" style="margin-right:10px; display:block; float:left;"> <?= $user->username ?> </a>
		      				<div><i class="fa fa-star" style="color:gold"></i> <?= $user->total_points ?></div>
		      			</li>
		      			<div style="clear:both"></div>

		      			@php $rank += 1; @endphp
		      		<?php endforeach; ?>
		      	</ul>

		    </div>

	</div>
	     

@stop