<script type="text/javascript">
        (function($){
  $(function(){
    $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
   $('.button-collapse').sideNav({
      menuWidth: 300, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
   // $('.collapsible').collapsible();
   $('.collapsible').collapsible({
      accordion : true
    });

   


   $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() { console.log('Open'); }, // Callback for Modal open
      complete: function() { console.log('Closed'); } // Callback for Modal close
      }	
   );

   $('#bsh').click(function(){
   $('#sidenav-overlay').remove();
   });

   
   $('.parallax').parallax();
   $('.slider').slider();
    


  // Registration Form Script 
  var pw = $("#pwd1");
  var pwc = $("#pwd2");
  var rsubmit = $("#registration_submit");
  
  rsubmit.attr("disabled", true);  

  var ReactivatePassConfirm = function(){
        var passwordVal = pw.val();
        var checkVal = pwc.val();
        if(passwordVal.length > 8){
          pwc.removeAttr("disabled");
          }
        }
        

  pw.on("blur", function(e){
     ReactivatePassConfirm();
  }); 

  pwc.on("blur", function(e) {
     ValidatePassword();
   });

   pwc.on("keyup", function(e) {
     ValidatePassword();
   });
    
  var ValidatePassword = function() {
        //Fetch both values
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
  };  // End of Registration Form Script

  // $('.dropdown-button').dropdown({
  //     inDuration: 300,
  //     outDuration: 225,
  //     constrain_width: false, // Does not change width of dropdown to that of the activator
  //     hover: true, // Activate on hover
  //     gutter: 0, // Spacing from edge
  //     belowOrigin: true, // Displays dropdown below the button
  //     alignment: 'left' // Displays dropdown with edge aligned to the left of button
  //   }
  // );




  

   


  
    
    

    });// end of document ready
})(jQuery);
      </script>