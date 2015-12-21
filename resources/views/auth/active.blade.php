@extends('app')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Successfully Activated</h1>
            <div class="row center">
                <h5 class="header col s12 light">Your user account has been successfully activated, thanks for joining.</h5>
            </div>
            <div class="row center">
                <a href="{{ route('login') }}" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
            </div>
            <br><br>
        </div>
    </div>
@endsection
