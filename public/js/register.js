$(document).ready(function() {



   function loader(v)
   {
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
                });

    });
});
