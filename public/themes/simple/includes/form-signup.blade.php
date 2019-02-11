@if ($errors->any())
    <div class="alert alert-danger" style="background:#bb2020; color:#ffffff; padding:10px;">
        <ul style="list-style:none;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ url('signup') }}">

    <h2>{{ __('lang.sign_up_with') }}</h2>
    <div class="social">
        <a class="facebook" href="{{ url('login/facebook') }}"><i class="fa fa-facebook"></i> facebook</a>
        <span>or</span>
        <a class="google" href="{{ url('login/google') }}"><i class="fa fa-google"></i> Google</a>
    </div>
    <!-- check for notifications -->

    <h2>{{ __('lang.or_signup_with') }}</h2>
    
    <input type="text" id="username" name="username" placeholder="{{ __('lang.username') }}">
    <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('lang.email_address') }}">
    <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('lang.password') }}">
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('lang.confirm_password') }}">
    <input type="hidden" class="form-control" id="redirect" name="redirect" value="{{ Input::get('redirect') }}" />

    <input class="primary_color_background" type="submit" value="{{ __('lang.sign_up') }}">
    {{ csrf_field() }}

</form>