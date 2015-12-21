@extends('app')

@section('content')
 
<div class="row center">{{ Auth::user()->email }} </div>
<a href="{{ route('logout') }}">Logout</a>

          
@endsection