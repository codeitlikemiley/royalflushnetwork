@extends('app')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Welcome!</h1>
            <div class="row center">
                <h5 class="header col s12 light">Please check your inbox, we sent you an email to continue with the registration proccess.</h5>
            </div>
            <div class="row center">
                <a href="{{ route('login') }}"  class="btn-large waves-effect waves-light orange">Login page</a>
            </div>
            <br><br>
        </div>
    </div>
@endsection