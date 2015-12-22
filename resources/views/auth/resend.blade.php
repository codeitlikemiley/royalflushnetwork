@extends('app')

@section('content')
<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">EMAIL RESEND REQUEST SENT!</h1>
            <div class="row center">
                <h5 class="header col s12 light">Please check your inbox, and Verify Your Email Account!</h5>
            </div>
            <div class="row center">
                <a href="{{ route('/') }}"  class="btn-large waves-effect waves-light orange">Home</a>
            </div>
            <br><br>
        </div>
    </div>
</main>
@endsection