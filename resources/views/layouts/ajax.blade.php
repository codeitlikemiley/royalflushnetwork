<script type="text/javascript">
(function($){
  $(function(){       //Start of function

    // add x-csrf token
    $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  }); // End of AjaxSetup

  
  // initialize sidenav button
   $('.button-collapse').sideNav({
      menuWidth: 300, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }); //End Button Collapse


   // initialized collapsible
   $('.collapsible').collapsible({
      accordion : true
    });  // End Collapsible
  
   
   // modal trigger for bottomsheet
   $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: '.6', // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() { console.log('Open'); }, // Callback for Modal open
      complete: function() { console.log('Closed'); } // Callback for Modal close
      });  // End MOdal Trigger

   $('#bsh').click(function(){
   $('#sidenav-overlay').remove();
   });   // END Bottomsheet

   // initialize parallax
   $('.parallax').parallax();
   // initialize slider
   $('.slider').slider();

  
    
    
  // disable registration form button
  // $('#registration_submit').attr('disabled', true);  

  // validation function for pass
  function ReactivatePassConfirm(){
        var passwordVal = $('#pwd1').val();

        if(passwordVal.length > 8){
          $('#pwd2').removeAttr("disabled");
          }
      } // End Reactivate
        
  // registration password
  $('#pwd1').on('blur', function(e){
     ReactivatePassConfirm();
  }); 

  $('#pwd2').on('blur', function(e) {
     ValidatePassword();
   });

   $('#pwd2').on('keyup', function(e) {
     ValidatePassword();
   });
    
  function ValidatePassword(){
        var pw = $("#pwd1");
        var pwc = $("#pwd2");
        var rsubmit = $("#registration_submit");
        var passwordVal = pw.val();
        var checkVal = pwc.val();
        
        //Validate the values
        console.log(passwordVal == checkVal && checkVal.length > 8);
        if (passwordVal == checkVal && checkVal.length > 8) {
              pwc.attr("class", "valid");
              rsubmit.attr("disabled", false);
          }else{
              pwc.attr("class", "invalid");
              rsubmit.attr("disabled", true);
              }
      }  // End of Registration Form Script


    // login.blade.php loader for login and signup
   function loader(v){
      if(v == 'on'){
        $('#login_form').css({
          opacity : 0.2
        });
        $('#loginloader').show();
      }else{
        $('#login_form').css({
          opacity : 1
        });
        $('#loginloader').hide();
      }
    }

    // page loader whole page
    function pageloader(v){
      if(v == 'on'){
        $('#search_form').css({
          opacity : 0.2
        });
        $('#pageloader').show();
      }else{
        $('#search_form').css({
          opacity : 1
        });
        $('#pageloader').hide();
      }
    }

    // get root url function
    function authenticated(url){
      window.location = url;
    }
    

     // ajax call for autocomplete
   $( "#q" ).autocomplete({
    source: "search/autocomplete",
    minLength: 3,
    autoFocus: true,
    select: function(event, ui) {
      $('#q').val(ui.item.value);

    }
  });

    // autocomplete added behavior 
    $( "input[name='q']" ).on( "focus", function(){
        $( "input[name='q']" ).css( "color", "#e57373" );
        $( "input[name='q']" ).val();
        $( ".ui-autocomplete" ).show();
    });

    $( "input[name='q']" ).change(function(){
      $( ".ui-autocomplete" ).empty();
    });

    // initialize select 
    $('select').material_select();


    // ajax call for search sponsor
    $("#search_form").submit(function(e){
                e.preventDefault();
                var url = $('#search_form').attr('action');
                var search_form = $('#search_form').serializeArray();
                pageloader('on');  
                $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: search_form,
                        success: function(data){
                        // stop the loader  
                        pageloader('off'); 
                        $('#pageloader').addClass('teal lighten-2').fadeIn(2000, function(){
                          $(this).hide();
                          $(this).removeClass("teal lighten-2");
                        });

                        
                        //initiate profile object
                        var pic = data.userdata.profile.profile_pic;
                        
                        var dname = data.userdata.profile.display_name;
                        // user data
                        
                        var username = data.userdata.username;

                        var premium = "FREEMIUM";
                        var active = data.userdata.links[0].active;
                        // initiate links object
                        var links = data.userdata.links;
                       
                        
                        // fill the input value with search value
                        $( "input[name='q']" ).val();


                        var user = $( "input[name='q']" ).val();

                        // Show Toast Message
                        Materialize.toast('Your Sponsor '+user+' is Found!', 4000,'',function(){console.log('User Found');});

                        // Make Font Color pink
                        $( "input[name='q']" ).css( "color", "#4db6ac" );


                        if(active > 0){
                        premium = "PREMIUM VIP";
                        }
          
                        // remove image
                        $('div#userbtn > a > img').remove();
                        // append image
                        $('div#userbtn > a').append('<img src="' + pic + '" width="55" height="55" class=" circle" tyle="z-index: 1001"/>');

                        $('div#profile_card > img').remove();
                        $('div#profile_card').append('<img src="' + pic + '" width="64" height="64" class=" circle" tyle="z-index: 1001"/>');
                        $('div#profile_card > p').remove();
                        $('div#profile_card').append('<p>' + dname + '</p>');
                        $('div#profile_card').append('<p>' + premium + '</p>');

                        // this code below wont re-populate if no image is set in a user
                        
                        // remove any existing option in select
                        $('select').children().remove();
                        $('select').material_select('destroy');
                        // interate thru all links
                        for (var i = 0; i < links.length; i++) {
                          // append all links in options
                          $("#powerselect").append('<option value="' + links[i].link + '">' + links[i].link  + '</option>');
                          // log all links
                          // console.log(links[i].link);
                          
                        };
                        // re initiate again select
                        $('select').material_select();
                        



                        //add More logic to populate page with data
                        },
                        error: function(data){
                          
                        pageloader('off');

                        $('#pageloader').addClass('red accent-4').fadeIn(2000, function(){
                          $(this).hide();
                          $(this).removeClass('red accent-4');
                        });
                        
                        $( "input[name='q']" ).val('We Cant Find Your Sponsor, Search Again!');
                        $( "input[name='q']" ).css( "color", "#d50000" );
                        }
                      });

                
        });


    // ajax call for login
    $('#sign_in').on('click', function(e){

            e.preventDefault();
            var login_form = $('#login_form').serializeArray();
            var url = $('#login_form').attr('action');
            loader('on');
            

            $.post(url, login_form, function(data){
              loader('off');
             
              if(data == "notregister"){                    
                    $('#loginloader').addClass('red').fadeIn(2000, function(){
                        $(this).hide();
                        $(this).removeClass("red");
                    });
                    
                    Materialize.toast('Invalid Credentials', 4000,'',function(){console.log('Invalid Credentials');});
                   
                    $( "input[name='email']" ).val('');
                    $('#login_email').removeClass("valid");
                    $('#login_email').removeClass("invalid");

                    $( "input[name='password']" ).val('');
                    $('#login_password').removeClass("valid");
                    $('#login_password').removeClass("invalid");

                   
              }else if(data == "wrongpass"){           
                    $('#loginloader').addClass('pink').fadeIn(2000, function(){
                        $(this).hide();
                        $(this).removeClass("pink");
                    });

                    Materialize.toast('Re-Type Correct Password', 4000,'',function(){console.log('Password is Incorrect');});

                    $( "input[name='email']" ).val();
                    $( "input[name='password']" ).val('');
                    $('#login_password').removeClass("valid");
                    $('#login_password').removeClass("invalid");
                  
              }else if(data == "notactive"){
                    $('#loginloader').addClass('yellow').fadeIn(2000, function(){
                        $(this).hide();
                        $(this).removeClass("yellow");  
                    });

                    Materialize.toast('Verify Your Email!', 4000,'',function(){console.log('Verify Your Email!');});

                    authenticated('profile');

              }else if(data == "banned"){
                    $('#loginloader').addClass('black').fadeIn(2000, function(){
                        $(this).hide();
                        $(this).removeClass("black");
                    });

                    Materialize.toast('Account is Banned!', 4000,'',function(){console.log('Account is Banned!');});

                    $( "input[name='email']" ).val();
      
                    $( "input[name='password']" ).val('');
                    $('#login_password').removeClass("valid");
                    $('#login_password').removeClass("invalid");

              }else if(data == "success") {
                    $('#loginloader').addClass('green').fadeIn(2000, function(){
                        $(this).hide();
                        $(this).removeClass("green");
                    });

                    Materialize.toast('Welcome Back!', 4000,'',function(){console.log('Welcome Back!');});

                    authenticated('profile');

              }else{
                    $('#loginloader').addClass('grey').fadeIn(2000, function(){
                        $(this).hide();
                        $(this).removeClass("grey");
                    });

                    Materialize.toast('OOPS! Something Went Wrong!', 4000,'',function(){console.log('OOPS! Something Went Wrong!');});
                    
                    $( "input[name='email']" ).val('');
                    $('#login_email').removeClass("valid");
                    $('#login_email').removeClass("invalid");

                    $( "input[name='password']" ).val('');
                    $('#login_password').removeClass("valid");
                    $('#login_password').removeClass("invalid");
                    

                }
              
            });
    });

    // newsbar initialize
    $('div.latest_payouts').jNewsbar({
    position : 'bottom',
    effect : 'slideDown',
    animSpeed: 500,
    pauseTime : 1000,
    toggleItems : 11,
    pauseOnHover : false,
    theme : "teal-lighten-2"
    });

  
    
    

    });// end of document ready
})(jQuery);     
</script>