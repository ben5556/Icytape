<h2><i class="icon-star"></i> {{ __('lang.user_points', array('username' => $user->username)) }}</h2>
<p>{{ __('lang.view_info_about_points') }}</p>

<br />
<h3 style="background:#ccc; float:left; padding:11px; margin-top:0px;">{{ __('lang.user_points', array('username' => $user->username)) }}</h3>
<p style="padding:10px; line-height:auto; font-size:20px; background:#e3e3e3; float:left; margin-top:0px; height:25px;">{{ $user_points }}</p>
<a href="{{ url('leaderboard') }}" class="pull-left view-leaderboard" style="padding:10px; text-decoration:underline; background:#f5f5f5; font-size:14px; cursor:pointer; height:25px; line-height:30px; font-weight:bold; margin-top:0px;"><i class="fa fa-trophy" style="color:gold; margin-right:5px;"></i>{{ __('lang.view_leaderboards') }}</a>
<div style="clear:both"></div>

<table class="table table-condensed" cellspacing="0">
	<tr>
		<th>{{ __('lang.points') }}</th>
		<th>{{ __('lang.description') }}</th>
		<th>{{ __('lang.time') }}</th>
	</tr>
	
	@foreach($points as $point)
		<tr>
			<td>{{ $point->points }}</td>
			<td>{{ $point->description }}</td>
			<td>{{ $point->created_at }}</td>
		</tr>
	@endforeach
	
</table>
