<script type="text/javascript">
(function($){
  $(function(){       //Start of function

   $('select').material_select();


  // initialize sidenav button
   $('.button-collapse').sideNav({
      menuWidth: 250, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }); //End Button Collapse





   // modal trigger for bottomsheet
   $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: '.6', // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() { console.log('Open'); }, // Callback for Modal open
      complete: function() { console.log('Closed'); } // Callback for Modal close
      });  // End MOdal Trigger

   $('#bsh').click(function(){
   $('#sidenav-overlay').remove();
   });   // END Bottomsheet

   // initialize parallax
   $('.parallax').parallax();
   // initialize slider
   $('.slider').slider();








    // newsbar initialize
    $('div.latest_members').jNewsbar({
    position : 'bottom',
    effect : 'slideDown',
    animSpeed: 500,
    pauseTime : 2000,
    toggleItems : 11,
    pauseOnHover : false,
    theme : "teal-lighten-2"
    });











    });// end of document ready
})(jQuery);
</script>
