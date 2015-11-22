@extends('app')

@section('content')
<div class="container main">

    <div class="section">
	    <div class="row">
	        <div class="col l6 offset-l3 m8 offset-m2 s12 ">

                <h4 class="teal lighten-2 center white-text">Activate Link</h4>

	            <div class="progress" id="activatorloader" style="display:none">
      				<div class="indeterminate amber" ></div>
				</div>
	    	</div>

	    	<div id="firstlink" class="col l6 offset-l3 m8 offset-m2 s12 ">


                {!! Form::open(['route'=> '1stlinkactivation', 'class' => 'col s12', 'id' => 'activatefirstlink_form' ]) !!}

                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                   <div class="row">
                     <div class="input-field col s12">
                       <i class="material-icons prefix">link</i>
                         <input id="link" type="text"  name="link"  readonly value="iyuri305">
                         <label class="active" for="link">First Link</label>
                     </div>
                   </div>
                   <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">person_pin</i>
                       <input id="pin" type="text" class="validate" minlength="7" name="pin" required="pin">
                       <label for="pin" data-error="PinCodeTooShort" data-success="Ok">Pin Code</label>

                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">vpn_key</i>
                        <input id="secret" type="text" class="validate" minlength="7" name="secret" required="secret">
                        <label for="secret" data-error="SecretKeyTooShort" data-success="Ok" >Secret Code</label>

                    </div>
                  </div>
                  <div class="row">
                  <div class="g-recaptcha">

                  </div>
                  </div>

                  <button class="col s6  btn waves-effect waves-light form-submit" type="submit" name="action">Activate Link <i class="material-icons right">send</i></button>

                    <a href="#!" class="col s6  btn waves-effect waves-light red darken-4" type="submit" name="action" >Back</a>
                {!! Form::close() !!}
	    	</div>

	    </div>
    </div>
</div>
@endsection
