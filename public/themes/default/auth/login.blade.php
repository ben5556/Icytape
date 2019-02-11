@extends('theme::app')

@section('css')
	<style>
		body{
			padding-top:0px;
			margin-top:0px;
		}
		.alert{
			position: relative;
    		top: 40px;
		}
	</style>
@stop

@section('content')

	@if(Session::has('notification'))
	    <span class="notification">{{ Session::get('notification') }}</span>
	@endif

	<div class="container">

	    <form method="post" action="<?= URL::to('login') ?>" class="form-signin" data-width="450" data-height="500">
	    <h1><?= Lang::get('lang.sign_in') ?></h2>
		<h2 class="form-login-heading"><?= Lang::get('lang.sign_in_with') ?></h2>
	    <div class="social-signup">
	        <a class="facebook-signup" href="{{ url('login/facebook') }}">
	        	<img src="{{ theme_folder_url('/assets/img/facebook-btn.png') }}" alt="facebook login">
	        </a>
	        <a class="google-signup" href="{{ url('login/google') }}">
	        	<img src="{{ theme_folder_url('/assets/img/google-btn.png') }}" alt="google login">
	        </a>
	    </div>
	    <div class="clear"></div>
	    
	       <hr>
	        <h2 class="form-login-heading-second"><?= Lang::get('lang.or_sign_in_with') ?></h2>

	        <input type="text" class="form-control" placeholder="<?= Lang::get('lang.username_or_email') ?>" data-focus="true" id="email" name="email" autofocus>
	        <input type="password" class="form-control" placeholder="<?= Lang::get('lang.password') ?>" id="password" name="password">
	        <input type="hidden" class="form-control" id="redirect" name="redirect" value="@if(isset($redirect)){{ $redirect }}@else{{ '/' }}@endif" />
	        <button class="btn btn-lg btn-block btn-color btn-signin" type="submit"><?= Lang::get('lang.sign_in') ?></button>
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
	        <a href="{{ url('password/reset') }}" class="reset_password" style="width:100%; text-align:center; display:block;"><?= Lang::get('lang.forgot_password') ?></a>
	    </form>

	</div>


@stop


@section('javascript')

	<script>

	 	var RecaptchaOptions = {
	       theme : 'white'
	    };

	    $(document).ready(function(){
	        position_elements();
	    });

	    $(window).resize(function(){
	        position_elements();
	    });

	    function position_elements(){
	    	if($(window).width() > 767){
	        	$('#overlay').css('height', $(window).height());
	        	$('.form-signin').css('top', ( ($(window).height()/2) - ($('.form-signin').height()/2) ) - ($('.navbar').height()+$('.alert').height()) + 'px' );
	        	$('.backstretch, #overlay, .form-signin').fadeIn();
	        } else {
	        	$('.form-signin').css('top', 'auto');
	        }
	    }

	</script>

@endsection