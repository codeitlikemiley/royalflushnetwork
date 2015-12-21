var socket = io(window.location.origin + ':6001');



new Vue({
  el: 'body',
  data: {
    users: [],
    rfnbonus: []
  	
  },
  ready: function(){

      $("abbr.timeago").livequery(function () { $(this).timeago(); });
      this.fetchUsers();
      // this.fetchRFNBONUS();
      socket.on('rfn-chanel:UserSignedUp', function(data) {
          this.users.unshift(data);
      }.bind(this));
    


      

     
   

      









  },

  methods: {
  	fetchUsers: function(){
  		$.getJSON('/api/users', function(users,success){
  			this.users = users;
  		}.bind(this));
  	}
    // fetchRFNBONUS: function() {
    //   $.getJSON('/api/rfnbonus', function(rfnbonus, success) {
    //       this.rfnbonus = rfnbonus;
    //       console.log(rfnbonus);
    //   }.bind(this));
    // },
   
    
    
   

  }


});

