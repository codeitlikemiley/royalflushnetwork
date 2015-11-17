
<form action="login" method="POST" class="col s12 login-form" id="login_form">

   <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

   <div class="row">
    <div class="input-field col s12">
      <i class="mdi-communication-email prefix"></i>
       <input id="login_email" type="email" class="validate" name="email" required>
       <label for="email" data-error="InvalidEmailAddress" data-success="Ok">Email Address</label>

    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <i class="mdi-action-lock-outline prefix"></i>
        <input id="login_password" type="password" class="validate" minlength="8" name="password" required>
        <label for="password" data-error="PasswordTooShort" data-success="Ok" >Password</label>
 
    </div>
  </div>
  <div class="row">
  <div class="g-recaptcha"  data-sitekey="{{ env('RE_CAP_SITE') }}">
    
  </div>
  </div>
 
  <button class="col s6  btn waves-effect waves-light form-submit" type="submit" id="sign_in" name="action">Login <i class="material-icons right">power_settings_new</i></button>

    <a href="{{ url('password/email')  }}" class="col s6  btn waves-effect waves-light deep-orange darken-4" type="submit" name="action">Forgot Password?</a>

</form>