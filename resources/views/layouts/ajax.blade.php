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
                        var pic = data.userdata.profile.profile_pic

                        var mobileno = data.userdata.profile.contact_no
                        
                        var dname = data.userdata.profile.display_name
                        // user data
                        
                        var about_me = data.userdata.profile.about_me
                        
                        var username = data.userdata.username

                        var premium = "FREEMIUM";
                        var active = data.userdata.links[0].active
                        // initiate links object
                        var links = data.userdata.links
                       
                        
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

                        if(about_me == null){
                          about_me ="Im Here to Help You Succeed!";
                        }

                        if(mobileno == null){
                          mobileno = " ";
                        }
          
                        // remove image
                        $('div#userbtn > a > img').remove();
                        // append image
                        $('div#userbtn > a').append('<img src="' + pic + '" width="55" height="55" class=" circle" tyle="z-index: 1001"/>');

                        $('div#profile_card > img').remove();
                        $('div#profile_card').append('<img src="' + pic + '" width="64" height="64" class=" circle" tyle="z-index: 1001"/>');
                        $('div#profile_card > p').remove();
                        $('div#profile_card > span').remove();
                        $('div#profile_card').append('<p>' + dname + '</p>');
                        $('div#profile_card').append('<span class="right">' + mobileno + '</span>');
                        $('div#profile_card').append('<span class="amber bold">' + premium + '</span>');
                        
                        $('.collapsible').collapsible({
                        accordion : true
                        });
                        // reset the loading of sponsorlink
                        $('#sploadlinks > li').remove();
                        $('#sploadlinks > hr').remove();
                        
                        // attach link to the collapsible
                        for (var i = 0; i < links.length; i++) {
                          // append all links in options
                          $("#sploadlinks").append('<li style="text-indent: 4rem;"><a href="' + links[i].link + '" class="teal-text">' + links[i].link  + '<i class="material-icons right">send</i></a></li><hr>');
                          
                        }

                        // re-initialize collapsible on call instance
                        $('.collapsible').collapsible({
                        accordion : true
                        });

                        $('#about_me').empty();
                        $('#about_me').append('<p>' + about_me + '</p>');


                        
                        

                        

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
                          
                        }
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