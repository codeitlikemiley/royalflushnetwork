$(document).ready(function() {
     
     $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


   function authenticated(url)
   {
      window.location = url;
   }

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

    $('#login_form').on('submit', function(e){

            e.preventDefault();
            var login_form = $('#login_form').serializeArray();
            var url = $('#login_form').attr('action');
            loader('on');
            
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: login_form,
                success:function(data)
                {
                    loader('off');
                    
                    if(data.success === false){
                    $.each(data.errors, function(index, error) 
                    {
                        Materialize.toast(error, 4000,'',function(){console.log(error);});
                    });
                    }
                    if(data.success === true)
                    {
                        authenticated(data.url)
                    }
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
                });
      
    });   





});

   