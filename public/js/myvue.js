new Vue({
  el: '#users',
  
  data: {
  	users: []
  	
  },

  ready: function(){
  	this.fetchUsers();
  	
  },

  methods: {
  	fetchUsers: function(){
  		this.$http.get('/api/users', function(users, success){
  			this.users = users;
  			
  		});
  	}

  	
  }
});