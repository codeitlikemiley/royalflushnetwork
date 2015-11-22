{{-- Start Card Div --}}
<div class="card">
{!! Form::open(['route'=> '1stlinkactivation', 'class' => 'col s12', 'id' => 'activatefirstlink_form' ]) !!}

<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
   <div class="row">
     <div class="input-field col s12">
       <i class="material-icons prefix">link</i>
         <input id="link" type="text"  name="link"  readonly value="iyuri305">

     </div>
   </div>
   <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">person_pin</i>
       <input id="pin" type="text" class="validate" minlength="7" name="pin" required="pin">
       <label for="pin" data-error="PinCodeTooShort" data-success="Ok">Pin Code</label>

    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">vpn_key</i>
        <input id="secret" type="text" class="validate" minlength="7" name="secret" required="secret">
        <label for="secret" data-error="SecretKeyTooShort" data-success="Ok" >Secret Code</label>

    </div>
  </div>
  <div class="row">
  <div class="g-recaptcha">

  </div>
  </div>

  <button class="col s6  btn waves-effect waves-light form-submit" type="submit" name="action">Activate Link <i class="material-icons right">send</i></button>

    <a class="activator col s6  btn waves-effect waves-light deep-orange darken-4" type="submit" name="action" >Check Pin</a>
{!! Form::close() !!}
{{-- End Login Form --}}
  {{-- Password Reset Section --}}
  {{-- <div class="card-reveal">
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
  </div> --}}
  {{-- End of Password Reset Form --}}
</div>
{{-- End Card --}}
