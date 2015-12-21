@extends('app')

@section('content')

<div id="users" class="main">

  <ul class="collection">
      <li class="collection-item" v-for="user in users">Name: @{{ user.username }}</br> @{{ user.created_at }}</li>

</ul>



<pre>@{{ $data | json }}</pre>

</div>




@endsection
