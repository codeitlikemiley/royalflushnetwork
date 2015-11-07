@extends('app')

@section('content')

    <div class="row center">
          <h2>EMail:</h2>
    </div>
    <hr>

    <div class="row center">
          <h2>Money Link : {{ $link->link }}</h2>
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
          <h2>Active</h2>
      </div>
    @elseif($link->active == false)
      <div class="row center">
          <h2>Not Active</h2>
      </div>
    

    
    @endif
    
@endsection