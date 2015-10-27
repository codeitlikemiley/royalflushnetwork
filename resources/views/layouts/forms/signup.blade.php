
<form action="signup" method="POST" class="col s12 login-form" id="registration_form" >
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	<div class="input-field col s12">
	    <i class="mdi-action-account-circle prefix"></i>
	    <input type="text" class="validate" name="full_name" required="">
       <label for="full_name" data-error="Error" data-success="Ok">Full Name</label>
	</div>
	<div class="input-field col s12">
	    <i class="mdi-communication-email prefix"></i>
	    <input id=email type="email" class="validate" name="email" required="">
       <label for="email" data-error="InvalidEmailAddress" data-success="Ok">Email Address</label>
	</div>
	<div class="input-field col s12">
	    <i class="mdi-communication-phone prefix"></i>
	    <input  type="text" name="contact_no" class="validate" required="">
       <label for="contact_no">Contact No.</label>
	</div>
	<div class="input-field col s12">
	    <i class="mdi-action-room prefix"></i>
	    <input  type="text" class="validate" name="address" length="60" required="">
       <label for="address" data-error="ExceedAllowedCharacter" data-success="Ok">Address</label>
	</div>
	<div class="input-field col s12">
	    <i class="mdi-action-lock-outline prefix"></i>
	    <input id="pwd1" type="password" class="validate" minlength="8" name="password">
        <label for="password" data-error="PasswordTooShort" data-success="Ok" >Password</label>
	</div>
	<div class="input-field col s12">
	    <i class="mdi-action-lock-outline prefix"></i>
	    <input id="pwd2" type="password" class="validate"  minlength="8" name="password_confirmation" disabled>
        <label for="password_confirmation" data-error="ReType" data-success="Ok" >Password Confirmation</label>
        
	</div>
	<hr class="hide">
	<hr class="hide">
	<hr class="hide">
    <button class="col s6 offset-s3 btn waves-effect waves-light form-submit" type="submit" name="action" id="registration_submit">Sign-up</button>
    </form>
