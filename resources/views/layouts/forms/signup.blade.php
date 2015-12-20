<form action="signup" method="POST" class="col s12 login-form"
id="registration_form" data-parsley-validate>
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

		<div class="input-field col s10 pull-s1 offset-s1">

    	<select id="powerselect" name="sponsor_link" tabindex="1" required="" data-parsley-required-message="You Cant Register Without A Sponsor" data-parsley-trigger="change focusout" data-parsley-no-focus>
        @if(\Cookie::has('sponsor'))
        {{--*/ $cookie = \Cookie::get('sponsor') /*--}}
        <option value="{{ $cookie['link']  }}" selected>{{ $cookie['link']  }}</option>
        @endif
        @unless(\Cookie::has('sponsor'))
        <option value="" disabled selected>Search Sponsor</option>
        @endunless
    	</select>

    	<label>Sponsor Link</label>
  		</div>

        <div class="input-field col s11">
        <i class="material-icons prefix">perm_identity</i>
    	  <input id="first_name" type="text" name="first_name" tabindex="2" required="" data-parsley-required-message="What is Your First Name?" data-parsley-minlength="2" data-parsley-minlength-message="First Name Cant Be That Short!" data-parsley-maxlength="30" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-pattern-message="Invalid Character Present!" data-parsley-trigger="change focusout"/>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s11">
        <i class="material-icons prefix">supervisor_account</i>
          <input id="last_name" type="text" name="last_name" tabindex="3" required="" data-parsley-required-message="What is Your Last Name?" data-parsley-minlength="2" data-parsley-minlength-message="Last Name Cant Be That Short!" data-parsley-maxlength="30" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-pattern-message="Invalid Character Present!" data-parsley-trigger="change focusout"/>
          <label for="last_name">Last Name</label>
        </div>


        <div class="input-field col s11">
        <i class="material-icons prefix">account_circle</i>
          <input id="username" type="text" name="username" tabindex="4" required="" data-parsley-required-message="Username is Required For Account Login!" data-parsley-minlength="6" data-parsley-minlength-message="Username Name Cant Be That Short!" data-parsley-maxlength="30" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-pattern="/^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/" data-parsley-pattern-message="Username Pattern Must Be e.g. (johndoe_001)" data-parsley-trigger="change focusout"/>
          <label for="username">Username</label>
        </div>

        <div class="input-field col s11">
    	<i class="material-icons prefix">public</i>
          <input id="display_name" type="text" name="display_name" tabindex="5" required="" data-parsley-required-message="On What Name Do You Want to Be Viewed?" data-parsley-minlength="2" data-parsley-minlength-message="Display Name Cant Be That Short!" data-parsley-maxlength="30" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-pattern="/^[\w\-\s]*$/" data-parsley-pattern-message="Diplay Name Pattern Must Be e.g. (Im John-Doe_23)" data-parsley-trigger="change focusout"/>
          <label for="display_name">Display Name</label>
        </div>

	<div class="input-field col s11">
	    <i class="mdi-communication-email prefix"></i>
	    <input id=email type="email" name="email" tabindex="6" required="" data-parsley-required-message="Required for Account Recovery" data-parsley-type="email" data-parsley-type-message="This is Not a Valid Email" data-parsley-maxlength="60" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-pattern="/^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/i" data-parsley-pattern-message="Use Only Google Email Address!" data-parsley-trigger="change focusout"/>
       <label for="email">Email Address</label>
	</div>

	<div class="input-field col s11">
	    <i class="material-icons prefix">lock_open</i>
	    <input id="pwd1" type="password" name="password" tabindex="7" required="" data-parsley-required-message="Please Provide a Password For Your Account!" data-parsley-minlength="8" data-parsley-minlength-message="Password is Too Short!" data-parsley-maxlength="60" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-trigger="change focusout"/>
        <label for="password">Password</label>
	</div>
	<div class="input-field col s11">
	    <i class="material-icons prefix">vpn_key</i>
	    <input id="pwd2" type="password" name="password_confirmation" tabindex="8" required="" data-parsley-required-message="Password Confirmation is required" data-parsley-minlength="8" data-parsley-minlength-message="Password Confirmation is Too Short!" data-parsley-maxlength="60" data-parsley-maxlength-message="You Exceeded The Character Limit!" data-parsley-equalto="#pwd1" data-parsley-equalto-message="Password Confirmation Does Not Match!" data-parsley-trigger="change focusout"/>
        <label for="password_confirmation">Password Confirmation</label>

	</div>
  <div class="row non-input-field">
	 <div class="row col s11 offset-s1">
      <input type="checkbox" id="agree" name="agree" required="" data-parsley-required-message="Plese Read and Agree On Our Terms And Condition" data-parsley-trigger="change focusout"/>
      <label for="agree">Do You Agree On Our <a class="modal-trigger" data-target="tos">Terms and Condition</a>?</label>
	 </div>
   </div>
   <div class="row">
   <div class="g-recaptcha" id="recaptcha3" data-tabindex="9">

   </div>
   </div>

  @include('layouts.buttonloader')

   <div class="row buttonloader">

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
