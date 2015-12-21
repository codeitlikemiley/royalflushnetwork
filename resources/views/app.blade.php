<!DOCTYPE html>
  <html>
    <!--Import Header-->
    @include('layouts.header')
    <!--Custom Per Page Header-->
    @yield('head')
    <body>
    <!--Import Navbar-->
    @include('layouts.navbar')
    <!--Import Search Bar-->
    @include('search')
   <!--Import Page Loader-->
    @include('layouts.loader')

    <!--Optional Div Class -->
    {{-- <div class="container main">  --}}
    @yield('content')
    {{-- </div> --}}

    <!--Import Footer-->
    @include('layouts.news')
    @include('layouts.footer')
    @include('layouts.floatingbutton')
    @include('layouts.user_btn_sheet')
    {{-- Note Only Load BottomSheet if there is Referror or Searched User --}}
    @include('layouts.bottomsheet')

    <!--Import all JS Usable in All Page-->
    {!! HTML::script('js/vendor.js') !!}
    <!--Import Initialize Js Components-->
    @include('layouts.ajax')

    <!--Custom JS Here!-->
    {!! HTML::script('js/search.js') !!}
    {!! HTML::script('js/activatefirstlink.js') !!}

    <!-- Make Sure You add Another Blade that is Below Socket.io.js
    To Avoid io Being Undefined !-->
    {!! HTML::script('js/vue.js') !!}
    {!! HTML::script('js/myvue.js') !!}

    </body>
    <!--Custom Script On Desired Page -->
    @yield('footer')
    <!--Global BroadCast Channel -->
    @include('layouts.globalbroadcast')
  </html>
