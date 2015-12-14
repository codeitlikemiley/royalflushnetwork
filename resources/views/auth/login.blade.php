@extends('app')

@section('head')
    {!! HTML::style('css/parsley.css') !!}
@stop

@section('content')
<div class="container main">

    <div class="section">
	    <div class="row">
	        <div class="col l6 offset-l3 m8 offset-m2 s12 ">

	            <ul class="tabs z-depth-1">
	            	
		            <li class="tab col s3">
		        	    <a class="{{ Session::get('login') }}" href="#login">Login</a>
		            </li>
		            <li class="tab col s3">
		         	    <a class="{{ Session::get('signup') }}" href="#signup">Sign-up</a>
		            </li>
	            </ul>
	            <div class="progress" id="loginloader" style="display:none">
      				<div class="indeterminate amber" ></div>
				</div>
	    	</div>
	    	
	    	<div id="login" class="col l6 offset-l3 m8 offset-m2 s12 ">
	    		@include('layouts.forms.login')
	    	</div>
	    	<div id="signup" class="col l6 offset-l3 m8 offset-m2 s12 ">
	    		@include('layouts.forms.signup')
	    	</div>
	    </div>
    </div>
</div>
@endsection

@section('footer')




@stop