@extends('app')

@section('content')
<div class="container main">

    <div class="section">
	    <div class="row">
	        <div class="col l6 offset-l3 m8 offset-m2 s12 ">

	            <ul class="tabs z-depth-1">

		            <li class="tab col s3">
		        	    <a class="{{ Session::get('1stlinkactivation') }}" href="#firstlink">FirstLinkActivation</a>
		            </li>
		            {{-- <li class="tab col s3">
		         	    <a class="{{ Session::get('none') }}" href="#none">NONEYET</a>
		            </li> --}}
	            </ul>
	            <div class="progress" id="activatorloader" style="display:none">
      				<div class="indeterminate amber" ></div>
				</div>
	    	</div>

	    	<div id="firstlink" class="col l6 offset-l3 m8 offset-m2 s12 ">
	    		@include('layouts.forms.linkActivate')
	    	</div>
	    	{{-- <div id="linkactivation" class="col l6 offset-l3 m8 offset-m2 s12 ">
	    		@include('layouts.forms.signup')
	    	</div> --}}
	    </div>
    </div>
</div>
@endsection
