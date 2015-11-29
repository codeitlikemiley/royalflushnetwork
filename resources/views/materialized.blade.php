@extends('app')

@section('content')
<p id="power">0</p>
 {{-- <div id="messages" ></div> --}}

 {{-- <input type="hidden" val{{ auth()->user->id }}" id="auth_id">

<script>
    this.socket.on("user-" + $('#auth_id').val() + ":App\\Events\\EventClass", function(data){
    this.messages.push(data.message);
 }.bind(this));
</script> --}}

@endsection
