@extends('app')

@section('content')
@if($userdata->username !== null)
 <hr>
    <div class="row center">
          <h2>Username: {{ $userdata->username }}</h2>
    </div>
@endif     

{{--  @if($userdata->links !== null)
<div class="row">
  <div class="input-field col s12">
    <select>
    <option value="" disabled selected>Choose Sponsor Link</option>
    @foreach ($userdata->links as $links)
      <option value="{{ $links->link }}" data-icon="{{ url('img/luffy.jpg')  }}" class="left circle">{{ $links->link }}</option>
    @endforeach
    </select>
    <label>Materialize Select</label>
  </div>
  </div>
@endif --}}
@if($userdata->links !== null)
<div class="row">

<ul class="collapsible collapsible-accordion ">
    <li>
      <a class="collapsible-header waves-effect waves-light waves-red lighten-5 teal-text "><i class="material-icons left">attach_money</i>Select Sponsor's Link<i class="mdi-navigation-arrow-drop-down right"></i></a>
        
        <div class="collapsible-body">
            <ul class="teal lighten-5">
              @foreach ($userdata->links as $links)
              <li class="center">
              <a href="{{ $links->link }}" class="waves-effect waves-light waves-red lighten-5 teal-text ">{{ $links->link }}</a></li>
              <hr>
              @endforeach
            </ul>
        </div>
        
    </li>
</ul>
</div>
@endif
    @if($userdata->profile !== null)
    <div class="row center">
          <h2>Display Name :{{ $userdata->profile->display_name }} </h2>
         
    </div>
   
    
    <div class="row center">
          <h2>Profile Pic: </h2>
          <img src="{{ $userdata->profile->profile_pic }}" width="64" height="64" class="circle">
    </div>
    <hr>
    <div class="row center">
          <h2>About Me :{{ $userdata->profile->about_me }} </h2>
         
    </div>
    <hr>
 
     <div class="row center">
          <h2>Contact No :{{ $userdata->profile->contact_no }} </h2>
         
    </div>
    <hr>

 <div class="row center">
          <h2>City :{{ $userdata->profile->city }}</h2>
         
    </div>
    <hr>
<div class="row center">
          <h2>Country :{{ $userdata->profile->country }}</h2>
         
    </div>
   @endif 
    
    
    
    
@endsection



	