<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
{{--If Returning Back Load Cookie--}}
@if(\Cookie::has('sponsor'))
{{--*/ $cookie = \Cookie::get('sponsor') /*--}}
Returning Back Load Cookie <br>
{{ $cookie['id']  }}    <br>
{{ $cookie['link']  }}  <br>
{{ $cookie['user_id']  }}   <br>
{{ $cookie['active']  }}    <br>
{{ $cookie['user']['username']  }}  <br>
{{ $cookie['user']['created_at']  }}    <br>
{{ $cookie['user']['profile']['profile_pic']  }}    <br>
{{ $cookie['user']['profile']['about_me']  }}   <br>
{{ $cookie['user']['profile']['display_name']  }}   <br>
{{ $cookie['user']['profile']['contact_no']  }}



@endif



@if(! empty($link))

    First Time Loading Use $link Variable<br>
    {{ $link['id']  }}  <br>
    {{ $link['link']  }}    <br>
    {{ $link['user_id']  }}  <br>
    {{ $link['active']  }}  <br>
    {{ $link['user']['username']  }}    <br>
    {{ $link['user']['created_at']  }}  <br>
    {{ $link['user']['profile']['profile_pic']  }}  <br>
    {{ $link['user']['profile']['about_me']  }} <br>
    {{ $link['user']['profile']['display_name']  }} <br>
    {{ $link['user']['profile']['contact_no']  }}
@endif
    </body>
</html>
