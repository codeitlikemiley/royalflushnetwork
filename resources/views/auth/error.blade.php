@extends('app')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Attention!</h1>
            <div class="row center">
                <h5 class="header col s12 light">Something went wrong with your account activation.</h5>
            </div>
            <div class="row center">
		        {!! Form::open(['route'=> 'account/activate/link', 'class' => 'col s12 login-form' ]) !!}
      		        <div class="input-field col s12">
      		            <i class="mdi-communication-email prefix"></i>
      		            {!! Form::email('email','',['placeholder' => 'email']) !!}
      			    </div>
    			    <button type="submit" class="btn-large waves-effect waves-light orange form-submit">Get Activation email</button>
  		        {!! Form::close() !!}
            </div>
            <br><br>
        </div>
    </div>
@endsection