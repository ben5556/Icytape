<div class="leaderboard" style="display:none; background:#f1f1f1; padding:20px; text-align:left;">
	<i class="fa fa-times-circle" style="float:right; cursor:pointer;"></i>
	<h3><i class="fa fa-trophy" style="color:gold;"></i> {{ __('lang.leaderboards') }}</h3>

	@php $leaders = User::join('points', 'users.id', '=', 'points.user_id')->groupBy('points.user_id')->orderBy(DB::raw('SUM(points.points)'), 'DESC')->select('users.*')->get(); @endphp

	<ul style="padding-left:0px;">
		@foreach($leaders as $user)

			<li style="color:#f1f1f1; line-height:30px; display:block; width:100%; margin:20px auto;">
				<a href="{{ url('user') . '/' . $user->username }}" style="display:block; float:left; width:350px; overflow:hidden;"><img src="{{ Voyager::image( $user->avatar ) }}" alt="{{ $user->username }}" class="img-circle user-avatar-small" style="margin-right:10px; width:50px; border-radius:50px; border:2px solid #eee; display:block; float:left;"> {{ $user->username }} </a><div style="float:left; margin-right:150px; color:#333"><i class="fa fa-star" style="color:gold"></i> {{ $user->totalPoints() }}</div>
			</li>
			<div style="clear:both"></div>

		@endforeach
	</ul>

</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.leaderboard .fa-times-circle').click(function(){
		$('.leaderboard').hide();
		$('.table').show();
	});
});
</script>