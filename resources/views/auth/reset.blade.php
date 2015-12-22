@extends('app')

@section('head')
    {!! HTML::style('css/parsley.css') !!}
@stop

@section('content')
<div class="container main">
	<div class="section">
		<div class="row">
			<div class="col l6 offset-l3 m8 offset-m2 s12">
			<ul class="tabs z-depth-1">
	            <li class="tab col s3">
	        	    <a class="{{ Session::get('password/reset/') }}" href="#pwdresetform">Password Reset</a>
	            </li>
            </ul>
            <div class="progress" id="resetloader" style="display:none">
      				<div class="indeterminate amber" ></div>
				</div>
			</div>
			<div id="pwdresetform" class="col l6 offset-l3 m8 offset-m2 s12">
			
			{!! Form::open(['route'=> 'password/postReset', 'class' => 'col s12 reset-form', 'id' => 'pass_recovery', 'data-parsley-validate']) !!}
			    {!! Form::hidden('token', $token) !!}
			    <div class="row">
			    <div class="input-field col s12">
				    <i class="mdi-communication-email prefix"></i>
				    {!! Form::email('email', $email, [
				    	'readonly','required' => '', 
				    	'data-parsley-required-message' => 'Dont Remove The Default Email Provided', 
				    	'data-parsley-type' => 'email', 
				    	'data-parsley-type-message' => 'This is Not A Valid Email!', 
				    	'data-parsley-pattern' => '/^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/i' , 
				    	'data-parsley-pattern-message' => 'Use Only Google Email Address!',
				    	'data-parsley-trigger' => 'change focusout'
				    ]) !!}
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">lock_open</i>
					{!! Form::password('password',
						['placeholder' => 'New password',
						'id'	=> 'newpwd1',
						'required' => '',
						'data-parsley-required-message' => 'Please Provide A New Password',
						'data-parsley-minlength' => '8',
						'data-parsley-minlength-message' => 'Password Provided is Too Short!',
						'data-parsley-maxlength'	=> '60',
						'data-parsley-maxlength-message' => 'Password Provided Exceeded 60 Characters Limit!',
						'data-parsley-trigger'		=> 'change focusout'
					]) !!}
				</div>
				<div class="input-field col s12">
				    <i class="material-icons prefix">vpn_key</i>
				    {!! Form::password('password_confirmation',
				    	['placeholder' => 'Password confirmation',
				    	'id'		=> 'newpwd2',
				    	'required' => '',
						'data-parsley-required-message' => 'Please Provide Confirm Password',
						'data-parsley-minlength' => '8',
						'data-parsley-minlength-message' => 'Password Provided is Too Short!',
						'data-parsley-maxlength'	=> '60',
						'data-parsley-maxlength-message' => 'Password Provided Exceeded 60 Characters Limit!',
						'data-parsley-equalto'	=> '#newpwd1',
						'data-parsley-equalto-message' 	=> 'Password Confirmation Does Not Match!',
						'data-parsley-trigger'		=> 'change focusout'
				    ]) !!}
				</div>
				</div>
				<div class="row">
  				<div class="g-recaptcha" id="recaptcha4">
    
   				</div>
   				</div>
   				@include('layouts.buttonloader')
   				<div class="row buttonloader">
			  	<button class="col s6 offset-s3 btn waves-effect waves-light form-submit" type="submit" name="action">Reset password</button>
			  	</div>
			{!! Form::close() !!}
			</div>
			
		</div>
	</div>
</div>
@endsection

@section('footer')
{!! HTML::script('js/parsley.min.js') !!}
<!--Import Google Recaptcha-->
@include('layouts.precaptcha')
@stop