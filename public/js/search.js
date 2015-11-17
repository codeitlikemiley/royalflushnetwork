$(document).ready(function() {
   
 
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

    // initialize select 
    


    // ajax call for search sponsor
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
                        // stop the loader  
                        pageloader('off'); 
                        $('#pageloader').addClass('teal lighten-2').fadeIn(2000, function(){
                          $(this).hide();
                          $(this).removeClass("teal lighten-2");
                        });

                        
                        //initiate profile object
                        var pic = data.userdata.profile.profile_pic;

                        var mobileno = data.userdata.profile.contact_no;
                        
                        var dname = data.userdata.profile.display_name;
                        // user data
                        
                        var about_me = data.userdata.profile.about_me;
                        
                        var username = data.userdata.username;

                        var premium = "FREEMIUM";
                        var active = data.userdata.links[0].active;
                        // initiate links object
                        var links = data.userdata.links;
                       
                        
                        // fill the input value with search value
                        $( "input[name='q']" ).val();


                        var user = $( "input[name='q']" ).val();

                        // Show Toast Message
                        Materialize.toast('Your Sponsor '+user+' is Found!', 4000,'',function(){console.log('User Found');});

                        // Make Font Color pink
                        $( "input[name='q']" ).css( "color", "#4db6ac" );


                        if(active > 0){
                        premium = "PREMIUM VIP";
                        }

                        if(about_me == null){
                          about_me ="Im Here to Help You Succeed!";
                        }

                        if(mobileno == null){
                          mobileno = " ";
                        }
          
                        // remove image
                        $('div#userbtn > a > img').remove();
                        // append image
                        $('div#userbtn > a').append('<img src="' + pic + '" width="55" height="55" class=" circle" tyle="z-index: 1001"/>');

                        $('div#profile_card > img').remove();
                        $('div#profile_card').append('<img src="' + pic + '" width="64" height="64" class=" circle" tyle="z-index: 1001"/>');
                        $('div#profile_card > p').remove();
                        $('div#profile_card > span').remove();
                        $('div#profile_card').append('<p>' + dname + '</p>');
                        $('div#profile_card').append('<span class="right">' + mobileno + '</span>');
                        $('div#profile_card').append('<span class="amber bold">' + premium + '</span>');
                        
                        $('.collapsible').collapsible({
                        accordion : true
                        });
                        // reset the loading of sponsorlink
                        $('#sploadlinks > li').remove();
                        $('#sploadlinks > hr').remove();
                        
                        // attach link to the collapsible
                        for (var i = 0; i < links.length; i++) {
                          // append all links in options
                          $("#sploadlinks").append('<li style="text-indent: 4rem;"><a href="' + links[i].link + '" class="teal-text">' + links[i].link  + '<i class="material-icons right">send</i></a></li><hr>');
                          
                        }

                        // re-initialize collapsible on call instance
                        $('.collapsible').collapsible({
                        accordion : true
                        });

                        $('#about_me').empty();
                        $('#about_me').append('<p>' + about_me + '</p>');


                        
                        

                        

                        // this code below wont re-populate if no image is set in a user
                        
                        // remove any existing option in select
                        $('select').children().remove();
                        $('select').material_select('destroy');
                        // interate thru all links
                        for (var i = 0; i < links.length; i++) {
                          // append all links in options
                          $("#powerselect").append('<option value="' + links[i].link + '">' + links[i].link  + '</option>');
                          // log all links
                          // console.log(links[i].link);
                          
                        }
                        // re initiate again select
                        $('select').material_select();
                        



                        //add More logic to populate page with data
                        },
                        error: function(data){
                          
                        pageloader('off');

                        $('#pageloader').addClass('red accent-4').fadeIn(2000, function(){
                          $(this).hide();
                          $(this).removeClass('red accent-4');
                        });
                        
                        $( "input[name='q']" ).val('We Cant Find Your Sponsor, Search Again!');
                        $( "input[name='q']" ).css( "color", "#d50000" );
                        }
                      });

                
        });

  
});