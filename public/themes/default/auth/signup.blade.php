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

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif


	    <form method="post" action="<?= URL::to('signup') ?>" class="form-signin" data-width="450" data-height="595">
	    	 <h1><?= Lang::get('lang.sign_up') ?></h1>
	    <h2 class="form-login-heading"><?= Lang::get('lang.sign_up_with') ?></h2>
	    <div class="social-signup">
	        <a class="facebook-signup" href="{{ url('login/facebook') }}">
	        	<img src="{{ theme_folder_url('/assets/img/facebook-btn.png') }}" alt="facebook login">
	        </a>
	        <a class="google-signup" href="{{ url('login/google') }}">
	        	<img src="{{ theme_folder_url('/assets/img/google-btn.png') }}" alt="google login">
	        </a>
	    </div>
	        <!-- check for notifications -->
	        <div class="clear"></div>

	        <hr>
	        <h2 class="form-login-heading-second"><?= Lang::get('lang.or_signup_with') ?></h2>
	        
	        <input type="text" class="form-control" id="username" name="username" data-focus="true" placeholder="<?= Lang::get('lang.username') ?>">
	        <input type="text" class="form-control" id="email" name="email" placeholder="<?= Lang::get('lang.email_address') ?>">
	        <input type="password" class="form-control" id="password" name="password" placeholder="<?= Lang::get('lang.password') ?>">
	        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="<?= Lang::get('lang.confirm_password') ?>">
	        <input type="hidden" class="form-control" id="redirect" name="redirect" value="@if(isset($redirect)){{ $redirect }}@else{{ '/' }}@endif" />
	        
	        @if(setting('site.captcha'))
	            <?= Recaptcha::recaptcha_get_html(setting('site.captcha_public_key')) ?>
	        @endif

	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
	        <button class="btn btn-lg btn-block btn-color" type="submit"><?= Lang::get('lang.sign_up') ?></button>
	        
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
	        $('#username').focus();
	    });

	    $(window).resize(function(){
	        position_elements();
	    });

	    function position_elements(){
	        $('#overlay').css('height', $(window).height());
	        $('.form-signin').css('top', ( ($(window).height()/2) - ($('.form-signin').height()/2) ) - ($('.navbar').height() + $('.alert').height()) + 'px' );
	        $('.backstretch, #overlay, .form-signin').fadeIn();
	    }
	    
	</script>
@stop