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
   $('.collapsible').collapsible();
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

  

   


  
    
    

    });// end of document ready
})(jQuery);
      </script>