{{-- Start Card Div --}}
<div class="card">
{{-- Login Form --}}
<form action="login" method="POST" class="col s12 login-form" id="login_form">

   <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

   <div class="row">
    <div class="input-field col s12">
      <i class="mdi-communication-email prefix"></i>
       <input id="login_email" type="email" class="validate" name="email" required="email">
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
   <div class="row col s11 offset-s1">
      <input type="checkbox" id="remember_token" name="remember_token"/>
      <label for="remember_token">Keep Me LoggedIn in This Device?</label>
   </div>
   </div>
  <div class="row">
  <div class="g-recaptcha">

  </div>
  </div>

  <button class="col s6  btn waves-effect waves-light form-submit" type="submit" id="sign_in" name="action">Login <i class="material-icons right">power_settings_new</i></button>

    <a class="activator col s6  btn waves-effect waves-light deep-orange darken-4" type="submit" name="action" >Forgot Password?</a>

</form>
{{-- End Login Form --}}
  {{-- Password Reset Section --}}
  <div class="card-reveal">
      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
      <div class="container">
    <div class="row center">

        {!! Form::open(['route'=> 'password/postEmail', 'class' => 'col s12', 'id' => 'passwordreset_form' ]) !!}
        <div class="row">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            {!! Form::email('email','',['placeholder' => 'Email' , 'class' => 'validate', 'required' =>'email']) !!}
          </div>
        </div>
        <div class="row">
          <div class="g-recaptcha">

          </div>
        </div>
        <div class="row">
          <button class="col s6 offset-s3 btn waves-effect waves-light form-submit" type="submit" name="action">Reset password</button>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
  </div>
  {{-- End of Password Reset Form --}}
</div>
{{-- End Card --}}
