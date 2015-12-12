{{-- {!! HTML::script('https://www.google.com/recaptcha/api.js') !!} --}}

<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
<script type="text/javascript">
var doSubmit = false;
function reCaptchaVerify(response) {

    var x = document.getElementsByClassName("g-recaptcha-response");
    var i;
    for (i = 0; i < x.length; i++) {
       if( response === x[i].value ) {
       	doSubmit = true;
       }
    }
}

function reCaptchaExpired () {
 
       grecaptcha.reset();     
}
var CaptchaCallback = function(){
$('.g-recaptcha').each(function(index, el) {
   grecaptcha.render(el, {
    	'sitekey' : '6Lf-KBETAAAAAPLeTJk1zJlb0xLJpIsvUxOZWlE9',
    	'callback' : reCaptchaVerify,
        'expired-callback': reCaptchaExpired,
        'timeout' : 10,
    });
});
};
        $.ajaxSetup( {
            headers: {
                'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' )
                    .attr( 'content' )
            }
        } );


        function authenticated( url ) {
            window.location = url;
        }

        function loader( v ) {
            if ( v == 'on' ) {
                $( '#login_form' )
                    .css( {
                        opacity: 0.2
                    } );
                $( '#loginloader' )
                    .show();
            } else {
                $( '#login_form' )
                    .css( {
                        opacity: 1
                    } );
                $( '#loginloader' )
                    .hide();
            }
        }



        $( '#login_form' )
            .on( 'submit', function ( e ) {

                e.preventDefault();
                
                if (doSubmit) {
                    var login_form = $( '#login_form' )
                    .serializeArray();
                    var url = $( '#login_form' )
                    .attr( 'action' );
                    loader( 'on' );
                

                $.ajax( {
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: login_form,
                    success: function ( data ) {
                        loader( 'off' );

                        if ( data.success === false ) {
                            $.each( data.errors, function (
                                index, error ) {
                                Materialize.toast(
                                    error, 4000,
                                    '',
                                    function () {
                                        console
                                            .log(
                                                error
                                            );
                                    } );
                            } );
                        }
                        if ( data.success === true ) {
                            $.each( data.messages, function (
                                index, message ) {
                                Materialize.toast(
                                    message, 4000,
                                    '',
                                    function () {
                                        console
                                            .log(
                                                message
                                            );
                                    } );
                            } );
                            authenticated( data.url );
                        }
                    },
                    error: function ( data ) {
                        loader( 'off' );
                        var errors = data.responseJSON;
                        $.each( errors.errors, function (
                            index, error ) {
                            Materialize.toast(
                                error, 4000, '',
                                function () {
                                    console.log(
                                        error
                                    );
                                } );
                        } );

                    }
                } );
        
    }
                

            } );
//End Login 
    function buttonloader(v)
    {

       if(v == 'on'){
         $('.input-field').css({
         opacity : 0.2
         });
         $('.agree').css({
         opacity : 0.2
         });
         $('.g-recaptcha').css({
         opacity : 0.2
         });
         $('#regbutton').hide();
         $('#buttonloader').show();

       }else{
         $('.input-field').css({
           opacity : 1
         });
         $('.agree').css({
         opacity : 1
         });
         $('.g-recaptcha').css({
         opacity : 1
         });
         $('#buttonloader').hide();
         $('#regbutton').show();

       }
     }

    function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}


$('#registration_form').on('submit', function(e){

            e.preventDefault();

            if (doSubmit){

        	var registration_form = $('#registration_form').serializeArray();
            var url = $('#registration_form').attr('action');
            loader('on');
            buttonloader('on');

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: registration_form,
                success:function(data)
                {
                    loader('off');
                    buttonloader('off');

                    Materialize.toast('Thanks For Registration', 4000,'',function(){console.log('User Has Been Registered!');});
        			resetForm($('#registration_form'));
                },
                error:function(data)
                {
                    loader('off');
                    buttonloader('off');

                    var errors = data.responseJSON;

                    $.each(errors.errors, function(index, error)
                    {
                        Materialize.toast(error, 4000,'',function(){console.log(error);});
                    });

                }
                }); // End Ajax
            }
            

    });
// ENd Register
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

 var base_url = window.location.origin;

 $('#passwordreset_form').on('submit', function(e){

            e.preventDefault();

            if (doSubmit) {
            var passwordReset = $('#passwordreset_form').serializeArray();
            var url = $('#passwordreset_form').attr('action');
            loader('on');
            
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: passwordReset,
                success:function(data)
                {
                    loader('off');
  
                    Materialize.toast(data.message, 4000,'',function(){console.log(data.message);});

                },
                error:function(data)
                {
                     loader('off');
                   
                    var errors = data.responseJSON;

                    $.each(errors.errors, function(index, error) 
                    {
                        Materialize.toast(error, 4000,'',function(){console.log(error);});
                    });
                    
                }
                }); // End Ajax Call	
            }
            
      
    });   

    $('#pass_recovery').on('submit', function(e){

                e.preventDefault();

                if (doSubmit) {
                	var dataPass = $('#pass_recovery').serializeArray();
                var url = $('#pass_recovery').attr('action');
                pageloader('on');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: dataPass,
                    success:function(data)
                    {
                        pageloader('off');
      
                        Materialize.toast(data.message, 4000,'',function(){console.log(data.message);});

                        authenticated(base_url);
                    },
                    error:function(data)
                    {
                        pageloader('off');
                       
                        var errors = data.responseJSON;

                        $.each(errors.errors, function(index, error) 
                        {
                            Materialize.toast(error, 4000,'',function(){console.log(error);});
                        });
                        
                    }
                    }); // End AjaxCall
                }
                
          
        });  




</script>
