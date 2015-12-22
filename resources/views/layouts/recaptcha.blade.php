
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>

<script type="text/javascript">
$.ajaxSetup({headers:{'X-CSRF-TOKEN':
	$( 'meta[name="csrf-token"]' ).attr( 'content' )}});

// All About Google Recaptcha
var doSubmit1 = false;
var doSubmit2 = false;
var doSubmit3 = false;

var refresh1 = false;
var refresh2 = false;
var refresh3 = false;

var recaptcha1;
var recaptcha2;
var recaptcha3;



function reCaptchaVerify1(response) {

    var x = document.getElementsByClassName("g-recaptcha-response");
    var i;
    for (i = 0; i < x.length; i++) {
       if( response === x[i].value ) {
       	doSubmit1 = true;
        refresh1 = true;
       }
    }
}

function reCaptchaVerify2(response) {

    var x = document.getElementsByClassName("g-recaptcha-response");
    var i;
    for (i = 0; i < x.length; i++) {
       if( response === x[i].value ) {
       	doSubmit2 = true;
        refresh2 = true;
       }
    }
}

function reCaptchaVerify3(response) {

    var x = document.getElementsByClassName("g-recaptcha-response");
    var i;
    for (i = 0; i < x.length; i++) {
       if( response === x[i].value ) {
       	doSubmit3 = true;
        refresh3 = true;
       }
    }
}


function reCaptchaExpired1 () {

       grecaptcha.reset(recaptcha1);
       doSubmit1 = false;
       refresh1 = false;
}

function reCaptchaExpired2 () {

       grecaptcha.reset(recaptcha2);
       doSubmit2 = false;
       refresh2 = false;
}

function reCaptchaExpired3 () {


       grecaptcha.reset(recaptcha3);
       doSubmit3 = false;
       refresh3 = false;
}


var CaptchaCallback = function(){
recaptcha1 = grecaptcha.render('recaptcha1', {
          'sitekey' : '{{ env('RE_CAP_SITE') }}',
          'expired-callback': reCaptchaExpired1,
          'callback' : reCaptchaVerify1,
          'theme' : 'light'
        });
recaptcha2 = grecaptcha.render('recaptcha2', {
          'sitekey' : '{{ env('RE_CAP_SITE') }}',
          'expired-callback': reCaptchaExpired2,
          'callback' : reCaptchaVerify2,
          'theme' : 'light'
        });
recaptcha3 = grecaptcha.render('recaptcha3', {
          'sitekey' : '{{ env('RE_CAP_SITE') }}',
          'expired-callback': reCaptchaExpired3,
          'callback' : reCaptchaVerify3,
          'theme' : 'light'
        });
}; // END ALL ABOUT GOOGLE RECAPTCHA

// ALL METHOD FOR LOGIN AND REGISTER

// PROVIDE URL REDIRECT IF SET DEFAULT IS HOME
function authenticated( url ) {
window.location = url;
}

// HIDE SHOW LOGINLOADER
function loader( v ) {
if (v == 'on') {

	$('#loginloader').show();
}
else {

	$('#loginloader').hide();
}
}

// HIDE SHOW BUTTON LOADER
function buttonloader(v)
{

if(v == 'on'){

 $('.input-field').css({opacity : 0.2});
 $('.non-input-field').css({opacity : 0.2});
 $('.g-recaptcha').css({opacity : 0.2});
 $('.buttonloader').hide();
 $('.animatebuttonloader').show();

}
else{
 $('.input-field').css({opacity : 1});
 $('.non-input-field').css({opacity : 1});
 $('.g-recaptcha').css({opacity : 1});
 $('.animatebuttonloader').hide();
 $('.buttonloader').show();

}
}

// USE FOR RESETTING FORMS
function resetForm($form) {
$form.find('input:text, input:password, input:file, select, textarea').val('');
$form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}

// INITIALIZE PARSLEY TO AVOID DOUBLE AJAX SUBMIT
$('#login_form').parsley();

// START LOGIN SUBMIT
$('#login_form').on('submit', function (e){
            // PREVENT SUBMIT
            e.preventDefault();

            var form = $(this);
            // Validate The Form
            form.parsley().validate();
            // Check If All Input are Validated Correctly
            if (form.parsley().isValid()){
            // if Captcha is Answered Then Submit the Form
            if (doSubmit1) {
                var login_form = form.serializeArray();
                var url = form.attr('action');
                loader('on');
                buttonloader('on');
            // Start AJAX CALL
            $.ajax( {
                url: url,
                type: 'POST',
                dataType: 'json',
                data: login_form,
                success: function (data) {
                    loader('off');
                    buttonloader('off');

                    if (data.success === false) {
                        $.each(data.errors, function (index, error) {
                            Materialize.toast(error, 4000,'',function () {
                                //
                            });
                        });
                    }
                    if (data.success === true) {
                        $.each(data.messages, function (index, message) {
                            Materialize.toast(message, 4000,'',function () {
                            	//
                            });
                        });
                        resetForm($('#login_form'));
                        authenticated( data.url );
                    }
                },
                error: function (data) {
                    loader('off');
                    buttonloader('off');
                    var errors = data.responseJSON;
                    $.each( errors.errors, function (index, error) {
                        Materialize.toast(error, 4000, '',function () {
                                //
                            });
                    });

                }
            }); // End Login Ajax Call
        } else {
            // If Do submit Failed Do this
            Materialize.toast('Please Answer Login Captcha!', 4000,'',function () {
                //
            });
        } // End If  Else Do Submit
        if (refresh1) {
            reCaptchaExpired1();
            Materialize.toast('Refreshing Login Captcha!', 4000,'',function () {
                //
            });
        } // End Refresh Captcha
    } // End PARSLEY isValid

});
//END LOGIN SUBMIT

// INITIALIZE PARSLEY TO AVOID DOUBLE FORM SUBMIT
$('#passwordreset_form').parsley();

// START PASSWORD RESET SUBMIT
$('#passwordreset_form').on('submit', function(e){
        // PREVENT FORM SUBMIT
        e.preventDefault();

        var form = $(this);
        // Validate Form Before Submit
        form.parsley().validate();
        // Check if All Input Are Validated Correctly
        if (form.parsley().isValid()){
        // Check if Captcha is Answered Then Do Submit
        if (doSubmit2) {
        var passwordReset = form.serializeArray();
        var url = form.attr('action');
        loader('on');
        buttonloader('on');

        // Start Ajax Call
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: passwordReset,
            success:function(data)
            {
                loader('off');
                buttonloader('off');

                resetForm($('#passwordreset_form'));
                Materialize.toast(data.message, 4000,'',function(){
                    //
                });

            },
            error:function(data)
            {
                 loader('off');
                 buttonloader('off');

                var errors = data.responseJSON;

                $.each(errors.errors, function(index, error)
                {
                 Materialize.toast(error, 4000,'',function(){
                    //
                });
                });

            }
            }); // End Ajax Call
        } else { // If Failed to Submit Then Do This
            Materialize.toast('Please Answer Password Reset Captcha!', 4000,'',function () {
                //
            });
        } // End If Else Do Submit
        if (refresh2) {
            reCaptchaExpired2();
            Materialize.toast('Refreshing Password Reset Captcha', 4000,'',function () {
                //
            });
        }// End Refresh Captcha
    } // End Parsley isValid

});   // ENd Password Reset Form

// INITIALIZE PARSLEY TO AVOID DOUBLE SUBMIT
$('#registration_form').parsley();

// START REGISTRATION SUBMIT
$('#registration_form').on('submit', function(e){
            // PREVENT SUBMIT
            e.preventDefault();

            var form = $(this);
            // Validate All Input Before Submit
            form.parsley().validate();
            // Check If All Input Validated Correctly
            if (form.parsley().isValid()){
            // If Captcha is Answered then Do Submit
            if (doSubmit3) {

            var registration_form = form.serializeArray();
            var url = form.attr('action');
            loader('on');
            buttonloader('on');
            // Start AJax Call
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
                    $('select').children().remove();
                    $('select').material_select('destroy');
                    resetForm($('#registration_form'));
                    $('#email').val('');
                    $("#powerselect").append('<option value="" disabled selected>Search Sponsor</option>');
                    $('select').material_select();


                },
                error:function(data)
                {
                    loader('off');
                    buttonloader('off');

                    var errors = data.responseJSON;

                    $.each(errors.errors, function(index, error)
                    {
                        Materialize.toast(error, 4000,'',function(){
                            //
                        });
                    });

                }
                }); // End Ajax
            } else {
                Materialize.toast('Please Answer Registration Captcha!', 4000,'',function () {
                    //
                });
            } // end If Else Do Submit
            if (refresh3) {
                reCaptchaExpired3();
                Materialize.toast('Refreshing Registration Captcha', 4000,'',function () {

                });
            } // End Refresh Captcha
        }// End If parsley isValid

    });
// ENd Register

</script>
