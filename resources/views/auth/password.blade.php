@extends('app')

@section('content')
	<div class="container main">
		<div class="row center">
			<div class="card badge light-blue">
				<strong>Password recovery : </strong>Please enter your email below to restore your password</strong>
			</div>
		</div>
		<div class="row center">
			{!! Form::open(['route'=> 'password/postEmail', 'class' => 'col s12 login-form' ]) !!}
				
			    <div class="input-field col s12">
				    <i class="mdi-action-lock-outline prefix"></i>
				    {!! Form::email('email','',['placeholder' => 'Email']) !!}
				</div>
		    	<button class="col s6 offset-s3 btn waves-effect waves-light form-submit" type="submit" name="action">Reset password</button>
			{!! Form::close() !!}
		</div>
	</div>
@endsection