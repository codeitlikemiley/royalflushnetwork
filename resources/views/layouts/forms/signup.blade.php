
@if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>{{ Lang::get('auth.whoops') }}</strong>{{ Lang::get('auth.someProblems') }}<br><br>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
<form action="signup" method="POST" class="col s12 login-form" id="registration_form">
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
		
		<div class="input-field col s11 offset-s1">

    	<select id="powerselect" name="sponsor_link">
    	<option value="" disabled selected>Choose Link</option>  
    	</select>
    	<label>Sponsor Links</label>
  		</div>
 
        <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
    	  <input id="first_name" type="text" class="validate" name="first_name" class="validate" required="">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" name="last_name" class="validate" required="">
          <label for="last_name">Last Name</label>
        </div>
    
      
        <div class="input-field col s12">
        <i class="material-icons prefix">visibility</i>
          <input id="username" type="text" class="validate" name="username" class="validate" required="">
          <label for="username">Username</label>
        </div>

        <div class="input-field col s12">
    	<i class="material-icons prefix">vpn_lock</i>
          <input id="display_name" type="text" class="validate" name="display_name" class="validate" required="">
          <label for="display_name">Display Name</label>
        </div>
     
	<div class="input-field col s12">
	    <i class="mdi-communication-email prefix"></i>
	    <input id=email type="email" class="validate" name="email" required="">
       <label for="email" data-error="InvalidEmailAddress" data-success="">Email Address</label>
	</div>
	{{-- <div class="input-field col s12">
	    <i class="mdi-communication-phone prefix"></i>
	    <input  type="text" name="contact_no" class="validate" required="">
       <label for="contact_no">Contact No.</label>
	</div> --}}
	{{-- <div class="input-field col s12">
	    <i class="mdi-action-room prefix"></i>
	    <input  type="text" class="validate" name="address" length="60" required="">
       <label for="address" data-error="ExceedAllowedCharacter" data-success="">Address</label>
	</div> --}}
	<div class="input-field col s12">
	    <i class="mdi-action-lock-outline prefix"></i>
	    <input id="pwd1" type="password" class="validate" minlength="8" name="password">
        <label for="password" data-error="PasswordTooShort" data-success="" >Password</label>
	</div>
	<div class="input-field col s12">
	    <i class="mdi-action-lock-outline prefix"></i>
	    <input id="pwd2" type="password" class="validate"  minlength="8" name="password_confirmation" disabled>
        <label for="password_confirmation" data-error="PasswordDontMatch" data-success="" >Password Confirmation</label>
        
	</div>
  <div class="row">
	 <div class="row col s11 offset-s1">
      <input type="checkbox" id="agree" name="agree"/>
      <label for="agree">Do You Agree On Our <a class="modal-trigger" data-target="tos">Terms and Condition</a>?</label>
	 </div>
   </div>
   <div class="row">
   <div class="g-recaptcha">
    
   </div>
   </div>
   <div class="row">
    <button class="col s6 offset-s3 btn waves-effect waves-light form-submit" type="submit" name="action" id="registration_submit">Register An Account</button>
    </div>
    </form>

<div id="tos" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Terms and Condition</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
    </div>
  </div>