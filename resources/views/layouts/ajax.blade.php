<script type="text/javascript">
(function($){
  $(function(){       //Start of function

    $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  }); // End of AjaxSetup

  
   $('.button-collapse').sideNav({
      menuWidth: 300, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }); //End Button Collapse


   // $('.collapsible').collapsible();
   $('.collapsible').collapsible({
      accordion : true
    });  // End Collapsible

   
   // $('.tooltipped').tooltip({delay: 50});

   $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: '.5', // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() { console.log('Open'); }, // Callback for Modal open
      complete: function() { console.log('Closed'); } // Callback for Modal close
      });  // End MOdal Trigger

   $('#bsh').click(function(){
   $('#sidenav-overlay').remove();
   });   // END Bottomsheet

   
   $('.parallax').parallax();
   $('.slider').slider();
   $('select').material_select();
   $( "#q" ).autocomplete({
    source: "search/autocomplete",
    minLength: 3,
    autoFocus: true,
    select: function(event, ui) {
      $('#q').val(ui.item.value);

    }
  });
    
    
  
  $('#registration_submit').attr('disabled', true);  

  function ReactivatePassConfirm(){
        var passwordVal = $('#pwd1').val();

        if(passwordVal.length > 8){
          $('#pwd2').removeAttr("disabled");
          }
      } // End Reactivate
        

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

    function authenticated(url){
      window.location = url;
    }
    
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
                          
                        pageloader('off'); 
                        $('#pageloader').addClass('green').fadeIn(2000, function(){
                          $(this).hide();
                          $(this).removeClass("green");
                        });

                        console.log(data);

                        $( "input[name='q']" ).val();
                        //add here logic to populate page with data
                        },
                        error: function(data){
                          
                        pageloader('off');

                        $('#pageloader').addClass('red').fadeIn(2000, function(){
                          $(this).hide();
                          $(this).removeClass("red");
                        });

                        $( "input[name='q']" ).val('We Cant Find Your Sponsor, Search Again!');
                        }
                      });

                
        });

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

  
    
    

    });// end of document ready
})(jQuery);     
</script>