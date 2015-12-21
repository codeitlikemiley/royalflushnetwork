<script type="text/javascript">
// Dynamically Load the Url and Append the Port Specified in socket.js
var socket = io(window.location.origin + ':6001');
socket.on("rfn-channel:App\\Events\\IncreaseRfnBonus", function(message){
    $('#rfn_bonus').text(parseInt($('#rfn_bonus').text()) + parseInt(message.data.rfn_bonus));


    // parse the text to int then add rfn bonus!
});
</script>