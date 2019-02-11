<h3>{{ __('lang.reset_password_email') }}</h3>

<form method="POST" action="{{ URL::to('password_reset') }}" accept-charset="UTF-8" class="form-signin" style="top: 34px; display: block;">
    
    @if(Session::has('error'))
      <span class="error">{{ __('lang.password_reset_email_error') }}</span>
    @elseif(Session::has('success'))
      <span class="success">{{ Lang::get('lang.check_email_reset') }}</span>
    @endif
      
    <input name="email" type="text" id="email" class="form-control" placeholder="{{ __('lang.email_address') }}">
    <input class="primary_color_background" type="submit" value="{{ __('lang.send_password_reset') }}">
    {{ csrf_field() }}

</form>