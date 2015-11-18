@extends('app')

@section('content')
	<div class="section">
		<div class="row">
			<h2>Create a new password</h2>
			{!! Form::open(['route'=> 'password/postReset', 'class' => 'col s12', 'id' => 'pass_recovery' ]) !!}
			    {!! Form::hidden('token', $token) !!}
			    <div class="row">
			    <div class="input-field col s12">
				    <i class="mdi-communication-email prefix"></i>
				    {!! Form::email('email', $email, ['readonly'  ]) !!}
				</div>
				<div class="input-field col s12">
					<i class="mdi-action-lock-outline prefix"></i>
					{!! Form::password('password',['placeholder' => 'New password']) !!}
				</div>
				<div class="input-field col s12">
				    <i class="mdi-action-lock-outline prefix"></i>
				    {!! Form::password('password_confirmation',['placeholder' => 'Password confirmation']) !!}
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
@endsection