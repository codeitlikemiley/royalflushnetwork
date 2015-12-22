@extends('app')

@section('content')
<main>
    <div class="container main">
	    <div class="row">
	        <div class="col l6 offset-l3 m8 offset-m2 s12 ">

	            <ul class="tabs z-depth-1">

		            <li class="tab col s3">
		        	    <a class="{{ Session::get('resendEmail') }}" href="#resendEmail">Account's Email is Not Yet Verified</a>
		            </li>
	            </ul>
	    	</div>

	    	<div id="resendEmail" class="col l6 offset-l3 m8 offset-m2 s12 ">
	    		@include('layouts.forms.resendemail')
	    	</div>
	    </div>
    </div>
</main>
@endsection

