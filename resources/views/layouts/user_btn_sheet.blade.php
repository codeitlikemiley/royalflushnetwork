{{-- Load Ajax User Info --}}

<div id="userbtn" class="modal-trigger" data-target="bottom_sheet_home">
<a href="#bottom_sheet_home" class="btn-floating btn-large waves-effect waves-red white" >
{{-- style="background-color: Transparent;" --}}
{{-- if search found user change this icon to profile-pic  --}}
@if(\Cookie::has('sponsor'))
{{--*/ $cookie = \Cookie::get('sponsor') /*--}}
<img src="{{ $cookie['user']['profile']['profile_pic']  }}" width="55" height="55" class="circle">
@endif
@unless(\Cookie::has('sponsor'))
<img src="{{ asset('img/toplogo.png') }}" width="55" height="55" class="circle">
@endunless
</a>
</div>
