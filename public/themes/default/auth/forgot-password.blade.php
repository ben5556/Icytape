@extends('theme::app')

@section('css')
	<style>
		.alert{
			position: relative;
    		top: 10px;
		}
	</style>
@stop

@section('content')

	@if(Session::has('notification'))
	    <span class="notification">{{ Session::get('notification') }}</span>
	@endif

	<div class="container">

     	@if (session('status'))
	        <div class="alert alert-success">
	            {{ session('status') }}
	        </div>
	    @endif

	    <form method="POST" action="<?= URL::to('password/email') ?>" accept-charset="UTF-8" class="form-signin" style="top: 34px; display: block;">
	        @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
	        <h1><?= __('lang.forgot_password') ?></h1>
	        <p>Enter your email address below:</p>
	          
	        <input name="email" type="text" id="email" class="form-control" placeholder="Email Address">
	        <button class="btn btn-lg btn-block btn-color" type="submit"><?= Lang::get('lang.submit') ?></button>
	     	{{ csrf_field() }}
	    </form>

	</div>


	<script type="text/javascript">

	    $(document).ready(function(){
	        $('#email').focus();
	    });

	</script>

@stop