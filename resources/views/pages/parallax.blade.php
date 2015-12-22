@extends('app')

@section('content')
<!-- Start First Parallax Div -->
<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Be an Affiliate</h1>
        <div class="row center">
          <h5 class="header col s12 light">The Most Exciting and Rewarding Payplan! Period!</h5>
        </div>
        <div class="row center">
          <a href="/login" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Sign Up Now!</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="img/city.png" alt="Unsplashed background img 1"></div>
  </div>
<!-- Start First Parallax Div -->
   
<!--   Start Feature Row1   -->
<div class="row">

	<div class="col s12 m4">
		  <div class="icon-block">
		    <h2 class="center brown-text"><img src="img/geneology.png" class="responsive-img circle"></h2>
		    <h5 class="center">For Affiliate</h5>

		    <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
		  </div>
	</div>

	<div class="col s12 m4">
		  <div class="icon-block">
		    <h2 class="center brown-text"><img src="img/sale.png" class="responsive-img circle"></h2>
		    <h5 class="center">For Customers</h5>

		    <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
		  </div>
	</div>

	<div class="col s12 m4">
		  <div class="icon-block">
		    <h2 class="center brown-text"><img src="img/cash.png" class="responsive-img circle"></h2>
		    <h5 class="center">For Sellers</h5>

		    <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
		  </div>
	</div>

</div>
<!--   End Feature Row1   -->

<!-- Start Video Container -->
<div class="video-container">
<iframe width="853" height="480" src="//www.youtube.com/embed/GOCEYKdovYQ?rel=0" frameborder="0" allowfullscreen></iframe>
</div>
<!-- End Video Container -->

@endsection