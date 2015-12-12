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

    <!--Import all JS Libary-->
    {!! HTML::script('js/vendor.js') !!}
    <!--Import Custom JS-->
    @include('layouts.ajax')
    {{-- {!! HTML::script('js/login.js') !!} --}}
    {!! HTML::script('js/search.js') !!}
    {{-- {!! HTML::script('js/register.js') !!} --}}
    {!! HTML::script('js/activatefirstlink.js') !!}
    {{-- {!! HTML::script('js/passwordreset.js') !!} --}}

    <!--Import Google Recaptcha-->
    @include('layouts.recaptcha')






    <!--Custom JS Here!-->

        <!-- Make Sure You add Another Blade that is Below Socket.io.js
        To Avoid io Being Undefined !-->
        {!! HTML::script('js/vue.js') !!}
        {!! HTML::script('js/myvue.js') !!}





    </body>
<script type="text/javascript">




// Dynamically Load the Url and Append the Port Specified in socket.js
            var socket = io(window.location.origin + ':6001');
            socket.on("rfn-channel:App\\Events\\IncreaseRfnBonus", function(message){
                $('#rfn_bonus').text(parseInt($('#rfn_bonus').text()) + parseInt(message.data.rfn_bonus));


                // parse the text to int then add rfn bonus!
            });

</script>
  </html>
