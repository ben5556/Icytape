<div class="edit-profile" style="display:none;">
	<h3 style="margin-bottom:15px;">{{ __('lang.edit_profile') }} <i class="fa fa-times-circle" style="cursor:pointer;"></i></h3>

	<form method="POST" action="{{ url('user/update') . '/' . Auth::user()->id }}" id="update-profile-form" accept-charset="UTF-8" enctype="multipart/form-data">
	
			<label for="username">{{ __('lang.username') }}:</label>					
			<input name="username" type="text" id="username" class="form-control" value="{{ Auth::user()->username }}">
		
			<label for="email">{{ __('lang.email_address') }}:</label>					
			<input name="email" type="text" id="email" class="form-control" value="{{ Auth::user()->email }}">
		
			<label for="image" style="margin-left:24px; margin-top:10px;">{{ __('lang.update_avatar') }}</label>
	        <img src="{{ Voyager::image( Auth::user()->avatar ) }}" alt="{{ $user->username }}" class="img-circle user-avatar-medium pull-left" style="width:75px">
	        <input type="file" name="avatar" style="line-height:15px; margin-left:100px;">
	        <div style="clear:both"></div>
	    
			<label for="password">{{ __('lang.password_edit') }}:</label>
			<input type="password" name="password" id="password" class="form-control" />

		<input type="hidden" id="id" name="id" value="{{ Auth::user()->id }}" />
		<input type="hidden" id="redirect" name="redirect" value="{{ Request::url() }}" />
		<input type="submit" class="btn btn-color primary_color_background" value="{{ __('lang.update_profile') }}" />
	
		{{ csrf_field() }}

	</form>
	<div class="clear"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.edit-user-profile').click(function(){
		$('.edit-profile').slideDown();
	});

	$('.edit-profile i.fa-times-circle').click(function(){
		$('.edit-profile').slideUp();
	});
});
</script>