@extends('app')

@section('content')

<div id="users" class="main">

  <ul class="collection">
      <li class="collection-item" v-for="user in users">Name: @{{ user.name }} </br>Email: @{{ user.email }}</li>
      
</ul>



<pre>@{{ $data | json }}</pre>

</div>




@endsection