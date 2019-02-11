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

        <form method="POST" action="{{ url('password/reset') }}" accept-charset="UTF-8" class="form-signin" style="top: 51px; display: block;">  
            {{ csrf_field() }}

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif

            <h1>{{ __('lang.reset_password') }}</h1>
            <p>{{ __('lang.reset_password_email') }}</p>
         
            <input name="email" type="text" id="email" class="form-control" placeholder="email">
         
            <input name="password" type="password" id="password" class="form-control" placeholder="password">
         
            <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="confirm password">
         
            <input name="token" type="hidden" value="<?= $token ?>">     
            <button class="btn btn-lg btn-block btn-color" type="submit"><?= Lang::get('lang.reset_password') ?></button>
         
        </form>

    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#email').focus();
        });

    </script>

@stop