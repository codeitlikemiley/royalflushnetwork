<head>
  <!-- meta tag  -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="csrf-token" content={{ csrf_token() }}/>
  <!-- Facebook Open Graph  -->
  <meta property="og:url"           content="{{ route('/') }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ trans('rfn.SiteName') }}" />
    <meta property="og:description"   content="{{ trans('rfn.SiteDescription') }}" />
    <meta property="og:image"         content="{{ asset('img/rfnlogo.png') }}" />

  <!-- Title Tag  -->
  <title>{{ trans('rfn.SiteName') }}</title>


  <!--Import all Css-->
  {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.min.css') !!}
  {!! HTML::style('css/style.css') !!}
  {!! HTML::style('vendor/jnewsbar/css/jNewsbar.css') !!}
  


</head>
