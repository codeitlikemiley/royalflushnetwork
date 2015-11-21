<!DOCTYPE html>
  <html>
    <!--Import Header-->
    @include('layouts.header')

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

    <!--Import all Javascript-->
    {!! HTML::script('js/jquery.js') !!}
    {!! HTML::script('https://code.jquery.com/ui/1.11.4/jquery-ui.js') !!}
    <!--Check the Update of materialize fix for select option-->
    {!! HTML::script('js/matest.min.js') !!}
    {!! HTML::script('vendor/jnewsbar/js/jNewsbar.jquery.min.js') !!}
    {!! HTML::script('js/login.js') !!}
    {!! HTML::script('js/search.js') !!}
    {!! HTML::script('js/register.js') !!}
    {!! HTML::script('js/activatefirstlink.js') !!}
    {!! HTML::script('js/passwordreset.js') !!}

    {{-- {!! HTML::script('https://www.google.com/recaptcha/api.js') !!} --}}
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
    <script type="text/javascript">
    var CaptchaCallback = function(){
    $('.g-recaptcha').each(function(index, el) {
        grecaptcha.render(el, {'sitekey' : '{{ env('RE_CAP_SITE') }}'});
    });
};
    </script>
    <!--Under Test JS-->
    {{-- {!! HTML::script('js/vue.js') !!} --}}
    {{-- {!! HTML::script('js/vue-resource.js') !!} --}}
    {{-- {!! HTML::script('js/myvue.js') !!} --}}

    <!--Custom JS Here!-->
    @include('layouts.ajax')
    </body>
  </html>
