{{-- Start Card Div --}}
<div class="card">
{{-- Login Form --}}
<form action="login" method="POST" class="col s12 login-form" id="login_form" data-parsley-validate>

   <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

   <div class="row">
    <div class="input-field col s11">
      <i class="mdi-communication-email prefix"></i>
       <input id="login_email" type="email" name="email" required="" data-parsley-required-message="Email is required" data-parsley-type="email" data-parsley-type-message="This is Not an Email!" data-parsley-maxlength="60" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-trigger="change focusout"/>
       <label for="email">Email Address</label>

    </div>
  </div>

  <div class="row">
    <div class="input-field col s11">
      <i class="mdi-action-lock-outline prefix"></i>
        <input id="login_password" type="password" name="password" required="" data-parsley-required-message="Password is required" data-parsley-minlength="8" data-parsley-minlength-message="Password is Too Short!" data-parsley-maxlength="60" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-trigger="change focusout"/>
        <label for="password">Password</label>

    </div>
  </div>
  <div class="row">
   <div class="row col s11 offset-s1 non-input-field">
      <input type="checkbox" id="remember_token" name="remember_token"/>
      <label for="remember_token">Keep Me LoggedIn in This Device?</label>
   </div>
   </div>
  <div class="row">
  <div class="g-recaptcha" id="recaptcha1">

  </div>
  </div>
  @include('layouts.buttonloader')
  <div class="row buttonloader">
  <button class="col s5 offset-s1 btn waves-effect waves-light form-submit" type="submit" id="sign_in" name="action">Login <i class="material-icons right">power_settings_new</i></button>

    <a class="activator col s5 btn waves-effect waves-light deep-orange darken-4" type="submit" name="action" >Forgot Password?</a>
  </div>
</form>
{{-- End Login Form --}}
  {{-- Password Reset Section --}}
  <div class="card-reveal">
      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>



        {!! Form::open(['route'=> 'password/postEmail', 'class' => 'col s12', 'id' => 'passwordreset_form', 'data-parsley-validate' ]) !!}
        <div class="row">
          <div class="input-field col s11">
            <i class="mdi-action-lock-outline prefix"></i>
            {!! Form::email('email','',['placeholder' => 'Email', 'required' =>'', 'data-parsley-required-message' => 'Type Email You Want To Recover', 'data-parsley-type' => 'email', 'data-parsley-type-message' => 'This is Not An Email!', 'data-parsley-trigger' => 'change focusout']) !!}
          </div>
        </div>
        <div class="row">
          <div class="g-recaptcha" id="recaptcha2" required="" data-parsley-required-message="Are You A Human?">

          </div>
        </div>
        @include('layouts.buttonloader')
        <div class="row buttonloader">
          <button class="col s6 offset-s3 btn waves-effect waves-light form-submit" type="submit" name="action">Reset password</button>
        </div>
        {!! Form::close() !!}


  </div>
  {{-- End of Password Reset Form --}}
</div>
{{-- End Card --}}
