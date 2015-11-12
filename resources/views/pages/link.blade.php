@extends('app')

@section('content')
  
{{-- Bug Related to Last Link is the Only One Being Shown Fix this --}}
<div class="row">

<ul class="collapsible collapsible-accordion ">
    <li>
      <a class="collapsible-header waves-effect waves-light waves-red lighten-5 teal-text "><i class="material-icons left">attach_money</i>Select Sponsor's Link<i class="mdi-navigation-arrow-drop-down right"></i></a>
        <div class="collapsible-body">
            <ul class="teal lighten-5">
              @foreach ($reflinks as $link)
              <li class="center">
              <a href="{{ $link->link }}" class="waves-effect waves-light waves-red lighten-5 teal-text ">{{ $link->link }}</a></li>
              <hr>
              @endforeach
            </ul>
        </div>
    </li>
</ul>
</div>
    @if($profile !== null)
    <div class="row center">
          <h2>Full Name: {{ $profile->first_name. ' '.$profile->last_name }}</h2>
    </div>
    <hr>
    <div class="row center">
          <h2>Profile Pic: </h2>
          <img src="{{ $profile->profile_pic }}" width="64" height="64" class="circle">
    </div>
    <hr>
    <div class="row center">
          <h2>About Me :{{ $profile->about_me }} </h2>
         
    </div>
    <hr>
     <div class="row center">
          <h2>Display Name :{{ $profile->display_name }} </h2>
         
    </div>
    <hr>
     <div class="row center">
          <h2>Contact No :{{ $profile->contact_no }} </h2>
         
    </div>
    <hr>

 <div class="row center">
          <h2>Address :{{ $profile->address }} </h2>
         
    </div>
    <hr>

 <div class="row center">
          <h2>City :{{ $profile->city }}</h2>
         
    </div>
    <hr>

 <div class="row center">
          <h2>Province :{{ $profile->province_state }}</h2>
         
    </div>
    <hr>

 <div class="row center">
          <h2>Zip Code :{{ $profile->zip_code }}</h2>
         
    </div>
    <hr>
<div class="row center">
          <h2>Country :{{ $profile->country }}</h2>
    
    </div>
    <hr>
      @endif   
    <div class="row center">
          <h2>Username: {{ $user->username }}</h2>
    </div>
    <hr>
    <div class="row center">
          <h2>Refferal Link : {{ $link->link }}</h2>
    </div>
    <hr>
    <div class="row center">
          <h2>EMail: {{ $user->email }}</h2>
    </div>
    <hr>  
    <div class="row center">
          <h2>Account ID: {{ $link->user_id }}</h2>
    </div>
    <hr>
    @if($link->sp_user_id == null)
    <div class="row center">
          <h2>Company Account</h2>
    </div>
    @elseif ($link->sp_user_id == !null) 
      <div class="row center">
          <h2>Your Sponsor Account ID : {{ $link->sp_link_id }}</h2>
    </div>
    @endif
    <hr>   
    @if($link->sp_link_id == null)
    <div class="row center">
          <h2>No Upline</h2>
    </div>
    @elseif ($link->sp_link_id == !null) 
      <div class="row center">
          <h2>Your Sponsor's Link : {{ $link->sp_link_id }}</h2>
    </div>
    @endif
    <hr>   
    @if($link->active == true)
      <div class="row center">
          <h2>Link Actived</h2>
      </div>
    @elseif($link->active == false)
      <div class="row center">
          <h2>Link Not Yet Activated</h2>
      </div>
    @endif
     <hr>
    @if($user->active == true)
      <div class="row center">
          <h2>Email Verified Account</h2>
      </div>
    @elseif($user->active == false)
      <div class="row center">
          <h2>Email Not Verified</h2>
      </div>
    @endif
     <hr>
      @if($user->status == true)
      <div class="row center">
          <h2>Account is in Good Standing</h2>
      </div>
    @elseif($user->active == false)
      <div class="row center">
          <h2>Banned</h2>
      </div>
    @endif
     <hr>
    
@endsection