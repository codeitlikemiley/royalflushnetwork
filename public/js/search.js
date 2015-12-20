$(document).ready(function() {

    $.ajaxSetup({headers:{'X-CSRF-TOKEN':
        $( 'meta[name="csrf-token"]' ).attr( 'content' )}});

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

    // ajax call for search sponsorlink
    $("#search_form").submit(function(e){
                e.preventDefault();
                var url = $('#search_form').attr('action');
                var search_form = $('#search_form').serializeArray();
                pageloader('on');
                $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: search_form,
                        success: function(data){
                        // stop the loader
                        pageloader('off');

                        $('#pageloader').addClass('teal lighten-2').fadeIn(2000, function(){
                          $(this).hide();
                          $(this).removeClass("teal lighten-2");
                        });

                        var pic = data.splinkdata.user.profile.profile_pic;

                        var mobileno = data.splinkdata.user.profile.contact_no;

                        var dname = data.splinkdata.user.profile.display_name;

                        var about_me = data.splinkdata.user.profile.about_me;

                        var premium = "FREEMIUM";

                        var active = data.splinkdata.active;

                        var link = data.splinkdata.link;

                        // fill the input value with search value
                        $( "input[name='q']" ).val(link);

                        // Show Toast Message
                        Materialize.toast(data.message, 4000,'',function(){console.log('User Found');});

                        if(active > 0){
                        premium = "PREMIUM VIP";
                        }

                        if(about_me == null){
                          about_me ="Im Here to Help You Succeed!";
                        }

                        // remove image top bar
                        $('div#userbtn > a > img').remove();
                        // append image top bar
                        $('div#userbtn > a').append('<img src="' + pic + '" width="55" height="55" class=" circle" tyle="z-index: 1001"/>');

                        // Append All Profile Data
                        $('div#profile_card > img').remove();
                        $('div#profile_card').append('<img src="' + pic + '" width="85" height="85" class="circle white" style="z-index: 1001"/>');
                        $('div#profile_card > p').remove();
                        $('div#profile_card > span').remove();
                        $('div#profile_card').append('<p>' + dname + '</p>');

                        if(mobileno){
                            $('div#profile_card').append('<span class="right">' + mobileno + '</span>');
                        }

                        $('div#profile_card').append('<span class="amber bold">' + premium + '</span>');

                        $('.collapsible').collapsible({
                        accordion : true
                        });
                        // reset the loading of sponsorlink
                        $('#sploadlinks > li').remove();
                        $('#sploadlinks > hr').remove();

                        $("#sploadlinks").append('<li style="text-indent: 4rem;"><a href="'+link+'" class="teal-text">'+link+'<i class="material-icons right">send</i></a></li><hr>');

                        // re-initialize collapsible on call instance
                        $('.collapsible').collapsible({
                        accordion : true
                        });

                        $('#about_me').empty();
                        $('#about_me').append('<p>' + about_me + '</p>');

                        // remove any existing option in select
                        $('select').children().remove();
                        $('select').material_select('destroy');

                        // Append Option With Parsley
                        $('#powerselect').parsley().destroy();
                        $("#powerselect").append('<option value="'+link+'">'+link+'</option>');
                        $('#powerselect').attr('data-parsley-required', 'true');
                        $('#powerselect').parsley();

                        // re initiate again select with new Option
                        $('select').material_select();

                        },
                        error: function(data){

                        pageloader('off');
                        var data = data.responseJSON;

                        if (data.cookie === true) {
                            Materialize.toast(data.message, 4000,'',function () {
                                //
                            });
                            // Load Link
                            $( "input[name='q']" ).val(data.link);
                        }
                        if (data.cookie === false) {
                            Materialize.toast(data.message, 4000,'',function () {
                                //
                            });
                            $('#pageloader').addClass('red accent-4').fadeIn(2000, function(){
                              $(this).hide();
                              $(this).removeClass('red accent-4');
                            });

                            $( "input[name='q']" ).val(data.message);
                            $( "input[name='q']" ).css( "color", "#d50000" );

                            }


                        } // END ERROR
                      });


        });


});
