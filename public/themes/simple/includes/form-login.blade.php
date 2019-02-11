<form method="post" action="{{ url('login') }}">

    <h2 class="form-login-heading">{{ __('lang.sign_in_with') }}</h2>
    <div class="social">
        <a class="facebook" href="{{ url('login/facebook') }}"><i class="fa fa-facebook"></i> facebook</a>
        <span>or</span>
        <a class="google" href="{{ url('login/google') }}"><i class="fa fa-google"></i> Google</a>
    </div>

    <h2>{{ __('lang.or_sign_in_with') }}</h2>

    <input type="text" class="form-control" placeholder="{{ __('lang.username_or_email') }}" id="email" name="email" autofocus>
    <input type="password" class="form-control" placeholder="{{ __('lang.password') }}" id="password" name="password">
    <input type="hidden" class="form-control" id="redirect" name="redirect" value="{{ Input::get('redirect') }}" />
    
    <input class="primary_color_background" type="submit" value="{{ __('lang.sign_in') }}">
    {{ csrf_field() }}

    <a href="{{ url('password/reset') }}" class="forgot_password">{{ __('lang.forgot_password') }}</a>
</form>