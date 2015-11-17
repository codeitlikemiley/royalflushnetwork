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
              // rsubmit.attr("disabled", false);
          }else{
              pwc.attr("class", "invalid");
              // rsubmit.attr("disabled", true);
              }
      }  // End of Registration Form Script



  
