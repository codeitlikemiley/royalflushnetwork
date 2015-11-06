@extends('app')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">You have a new password!</h1>
            <div class="row center">
                <h5 class="header col s12 light">Your password has been successfully restored.</h5>
            </div>
            <div class="row center">
                <a href="{{ route('login') }}" id="download-button" class="btn-large waves-effect waves-light orange">Login</a>
            </div>
            <br><br>
        </div>
    </div>
@endsection
