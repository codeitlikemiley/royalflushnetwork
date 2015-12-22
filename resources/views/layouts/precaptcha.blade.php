<script src="https://www.google.com/recaptcha/api.js?onload=PCaptchaCallback&render=explicit" async defer></script>

<script type="text/javascript">
$.ajaxSetup({headers:{'X-CSRF-TOKEN':
	$( 'meta[name="csrf-token"]' ).attr( 'content' )}});
var doSubmit4 = false;
var refresh4 = false;
var recaptcha4;
function reCaptchaVerify4(response) {

    var x = document.getElementsByClassName("g-recaptcha-response");
    var i;
    for (i = 0; i < x.length; i++) {
       if( response === x[i].value ) {
        doSubmit4 = true;
        refresh4 = true;
       }
    }
}
function reCaptchaExpired4 () {


       grecaptcha.reset(recaptcha4);
       doSubmit4 = false;
       refresh4 = false;
}
var PCaptchaCallback = function(){
recaptcha4 = grecaptcha.render('recaptcha4', {
          'sitekey' : '{{ env('RE_CAP_SITE') }}',
          'expired-callback': reCaptchaExpired4,
          'callback' : reCaptchaVerify4,
          'theme' : 'light'
        });
}; // END ALL ABOUT GOOGLE RECAPTCHA
var base_url = window.location.origin;

// PROVIDE URL REDIRECT IF SET DEFAULT IS HOME
function authenticated( url ) {
window.location = url;
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

function loader( v ) {
if (v == 'on') {

    $('#resetloader').show();
}
else {

    $('#resetloader').hide();
}
}


$('#pass_recovery').parsley();
$('#pass_recovery').on('submit', function(e){

        e.preventDefault();

        var form = $(this);
            // Validate All Input Before Submit
            form.parsley().validate();
            // Check If All Input Validated Correctly
            if (form.parsley().isValid()){
            // If Captcha is Answered then Do Submit
            if (doSubmit4) {

        var dataPass = form.serializeArray();
        var url = form.attr('action');
        loader('on');
        buttonloader('on');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: dataPass,
            success:function(data)
            {
                loader('off');
                buttonloader('off');

                Materialize.toast(data.message, 4000,'',function(){
                    //
                });

                authenticated(base_url);
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
            }); // End AjaxCall
        }// End DO Submit
        else {
                Materialize.toast('Please Answer Password Reset Captcha!', 4000,'',function () {
                    //
                });
        } // end If Else Do Submit
            if (refresh4) {
                reCaptchaExpired4();
                Materialize.toast('Refreshing Password Reset Captcha', 4000,'',function () {

                });
            }
  }// ENd Parsley Validate
});
</script>