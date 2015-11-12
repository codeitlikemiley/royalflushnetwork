<!DOCTYPE html>
<html lang="en">
<head>

  <title>Starter Template - Materialize</title>
  <!-- CSS  -->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.min.css">
	<style>
	@media (min-width:992px) {
	#aside {
	width:250px;
	}
	}

	@media (max-width:992px) {
	#aside.pinned, #aside.pin-bottom {
	position:static !important;
	top: auto !important;
	}
	}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<div class="navbar-fixed">
    <nav class="orange">
        <div class="nav-wrapper container">
            <a href="#!" class="brand-logo">&nbsp;Materialize</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#modalLogin" class="modal-trigger"><i class="mdi-action-perm-identity"></i></a></li>
                <li><a href="#"><i class="mdi-navigation-refresh"></i></a></li>
                <li><a href="#"><i class="mdi-navigation-more-vert"></i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li>
                    <a href="#">
                        <input id="search" type="search" placeholder="search">
                    </a>
                </li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
            </ul>
        </div>
    </nav>
</div>
<nav class="orange lighten-2 flat hide-on-med-and-down">
    <div class="nav-wrapper container">
        <form>
            <div class="input-field">
                <input id="search" type="search" required="">
                <label for="search"><i class="mdi-action-search"></i></label>
                <i class="mdi-navigation-close"></i>
            </div>
        </form>
    </div>
</nav>

<!-- main content -->
<div class="container">
    <div class="row">
        <div class="col l9">
            <h3>Main</h3>

            <div class="divider"></div>
            <p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics,
                raw denim deep v taxidermy messenger bag. Tofu YOLO Etsy, direct trade ethical Odd Future jean shorts paleo. Forage Shoreditch tousled aesthetic irony, street art organic Bushwick artisan cliche semiotics ugh synth chillwave meditation.
                Shabby chic lomo plaid vinyl chambray Vice. Vice sustainable cardigan, Williamsburg master cleanse hella DIY 90's blog.</p>
                
            <button class="btn btn-flat orange waves-effect waves-light white-text">Click Me</button>
            
            <div class="divider"></div>

            <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan farm-to-table Williamsburg slow-carb
                readymade disrupt deep v. Meggings seitan Wes Anderson semiotics, cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade. Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies,
                forage fingerstache food truck occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p>

            <div class="row">
                <div class="col s2"><i class="medium mdi-action-label-outline"></i></div>
                <div class="col s2"><i class="medium mdi-action-loyalty"></i></div>
                <div class="col s2"><i class="medium mdi-action-query-builder"></i></div>
                <div class="col s2"><i class="medium mdi-action-settings-applications"></i></div>
            </div>


            <div class="divider"></div>
            <p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics,
                raw denim deep v taxidermy messenger bag. Tofu YOLO Etsy, direct trade ethical Odd Future jean shorts paleo. Forage Shoreditch tousled aesthetic irony, street art organic Bushwick artisan cliche semiotics ugh synth chillwave meditation.
                Shabby chic lomo plaid vinyl chambray Vice. Vice sustainable cardigan, Williamsburg master cleanse hella DIY 90's blog.</p>

            <div class="divider"></div>
            <p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics,
                raw denim deep v taxidermy messenger bag. Tofu YOLO Etsy, direct trade ethical Odd Future jean shorts paleo. Forage Shoreditch tousled aesthetic irony, street art organic Bushwick artisan cliche semiotics ugh synth chillwave meditation.
                Shabby chic lomo plaid vinyl chambray Vice. Vice sustainable cardigan, Williamsburg master cleanse hella DIY 90's blog.</p>

            <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free Kickstarter artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan farm-to-table Williamsburg slow-carb
                readymade disrupt deep v. Meggings seitan Wes Anderson semiotics, cliche American Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade. Wayfarers codeply PBR selfies. Banh mi McSweeney's Shoreditch selfies,
                forage fingerstache food truck occupy YOLO Pitchfork fixie iPhone fanny pack art party Portland.</p>

            <div class="row">
                <div class="col s2"><i class="medium mdi-action-label-outline"></i></div>
                <div class="col s2"><i class="medium mdi-action-loyalty"></i></div>
                <div class="col s2"><i class="medium mdi-action-query-builder"></i></div>
                <div class="col s2"><i class="medium mdi-action-settings-applications"></i></div>
            </div>

        </div>
        <div class="col l3">
            <div id="aside">
                <h3>Aside</h3>
                <div class="divider"></div>
                <div class="card">
                    <div class="card-image">
                        <img src="//placehold.it/800x450/FF9800/EE00BB">
                        <span class="card-title">Card Title</span>
                    </div>
                    <div class="card-content">
                        <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">This is a link</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="//placehold.it/800x450/FF9800/EE00BB">
                        <span class="card-title">Card Title</span>
                    </div>
                    <div class="card-content">
                        <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">This is a link</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="//placehold.it/800x450/FF9800/EE00BB">
                        <span class="card-title">Card Title 2</span>
                    </div>
                    <div class="card-content">
                        <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">This is a link</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<!--login modal-->
<div id="modalLogin" class="modal">
    <div class="modal-content">
        <h2 class="center-align">Login</h2>
        <div class="center-align">
            <div class="divider"></div>
            <form class="col s12">
                <div class="row center-align">
                    <div class="input-field col m10 offset-m1 blue-text">
                        <i class="mdi-action-account-circle prefix"></i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Username</label>
                    </div>
                    <div class="input-field col m10 offset-m1 blue-text ">
                        <i class="mdi-action-lock-open prefix"></i>
                        <input id="icon_password" type="password" class="validate">
                        <label for="icon_password">Password</label>
                    </div>
                    <div class="input-field col m10 offset-m1 blue-text">
                        <input type="checkbox" class="blue-text" id="filled-in-box" checked="checked">
                        <label for="filled-in-box">Remember me next time</label>
                    </div>
                </div>
            </form>
            <div class="divider"></div>
            <p>
                <a href="#" class="btn btn-flat white modal-close">Cancel</a> &nbsp;
                <a href="#" class="waves-effect waves-blue blue btn btn-flat modal-action modal-close">Login</a>
            </p>
        </div>
    </div>
</div>
 

<footer>
  <!--  Scripts-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.min.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
	$(".button-collapse").sideNav();
	$('.modal-trigger').leanModal();
    $('#aside').pushpin({ top:110, bottom:500 });
  });
  </script>


</footer>
</body>
</html>
					
					