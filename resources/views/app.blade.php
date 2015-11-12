<!DOCTYPE html>
  <html>
    <!--Import Header-->
    @include('layouts.header') 

    <body>
    <!--Import Navbar-->
    @include('layouts.navbar') 
   
    @include('layouts.loader')

    <!--Optional Div Class -->
    {{-- <div class="container main">  --}}
    @yield('content')
    {{-- </div> --}}

    <!--Import Footer-->
    @include('layouts.footer')
    @include('layouts.floatingbutton')
    @include('layouts.bottomsheet')

      <!--Import all Javascript-->
    {!! HTML::script('js/jquery.js') !!}
    {!! HTML::script('https://code.jquery.com/ui/1.11.4/jquery-ui.js') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.min.js') !!}

    {{-- {!! HTML::script('js/vue.js') !!} --}}
    {{-- {!! HTML::script('js/vue-resource.js') !!} --}}
    {{-- {!! HTML::script('js/myvue.js') !!} --}}
    
 


    @include('layouts.ajax')
    </body>
  </html>