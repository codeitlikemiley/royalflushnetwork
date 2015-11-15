@extends('app')

@section('content')


{{-- Note that options are being overshoot up the screen --}}
{{-- Add this to the registration page --}}
<div class="row">
 <div class="input-field col s12">
    <select id="powerselect" name="sponsorlink">
    <option value="" disabled selected>Choose Sponsor Link</option>  
     
    </select>
    <label>Money Links</label>
  </div>
  </div>

@endsection
