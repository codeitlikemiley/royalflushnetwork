@extends('app')

@section('content')

<div id="appis">
  <ul>
    <li v-for="todo in todos">
      @{{ todo.text }}
    </li>
  </ul>
</div>


@endsection