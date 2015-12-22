@extends('app')

@section('content')
<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">ERROR 429:
            <span>Too Many Request!</span></h1>

            <div class="row center">
                <h5 class="header col s12 light">{{ Lang::get('auth.tooManyEmails',
						['email' => $email] ) }}</h5>
            </div>
            <div class="row center">
                <a href="{{ route('logout') }}"  class="btn-large waves-effect waves-light orange">Logout</a>
            </div>
            <br><br>
        </div>
    </div>
</main>
@endsection