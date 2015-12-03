var socket = io(window.location.origin + ':6001');

new Vue({
  el: '#users',
  data: {
  	users: [

    ],
  },
  ready: function(){
      $("abbr.timeago").livequery(function () { $(this).timeago(); });
      this.fetchUsers();
      socket.on('rfn-chanel:UserSignedUp', function(data) {
          this.users.unshift(data);
      }.bind(this));




  },

  methods: {
  	fetchUsers: function(){
  		this.$http.get('/api/users', function(users,success){
  			this.users = users;
  		}.bind(this));
  	}
  }

  
});
