<!DOCTYPE html>
  <html>
    <!--Import Header-->
    @include('layouts.header') 

    <body>
    <!--Import Navbar-->
    @include('layouts.navbar') 
   
    @include('layouts.loader')

    <!--Content Goes Here -->
    {{-- <div class="container main">  --}}
    @yield('content')
    {{-- </div> --}}

    <!--Import Footer-->
    @include('layouts.footer')
    @include('layouts.floatingbutton')
    @include('layouts.bottomsheet')

      <!--Import all Javascript-->
      <!-- jQuery is required by Materialize to function -->
      {{--<script type="text/javascript" src="js/jquery.js"></script>--}}
      {{--<script type="text/javascript" src="js/materialize.min.js"></script>--}}
      {{--<script type="text/javascript" src="js/vue.js"></script>--}}
      {{--<script type="text/javascript" src="js/vue-resource.js"></script>--}}
      {{--<script type="text/javascript" src="js/myvue.js"></script>--}}

    {!! HTML::script('js/jquery.js') !!}
    {!! HTML::script('js/materialize.min.js') !!}
    {!! HTML::script('js/vue.js') !!}
    {!! HTML::script('js/vue-resource.js') !!}
    {!! HTML::script('js/myvue.js') !!}

    @include('layouts.ajax')
    </body>
  </html>