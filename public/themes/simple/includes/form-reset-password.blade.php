<h3>{{ __('lang.enter_email_pass') }}</h3>

<form method="POST" action="{{ url('password_reset') . '/' . $token }}" accept-charset="UTF-8" class="form-signin" style="top: 51px; display: block;">  
        
    <input name="email" type="text" id="email" class="form-control" placeholder="email">
    <input name="password" type="password" id="password" class="form-control" placeholder="password">
    <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="confirm password">
    <input class="btn primary_color_background" type="submit" value="{{ __('lang.reset_password') }}" />
    {{ csrf_field() }}

</form>