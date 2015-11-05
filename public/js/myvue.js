new Vue({
  el: '#users',
  
  data: {
  	users: [],
  	search : [],

  	
  },

  ready: function(){
  	this.fetchUsers();
  	this.fetchSearch();
  	
  },

  methods: {
  	fetchUsers: function(){
  		this.$http.get('/api/users', function(users, success){
  			this.users = users;
  			
  		});
  	},

  	fetchSearch: function(){
  		this.$http.get('/api/users/{search}', function(search, success){
  			this.search = search;
  		});
  	}

  	
  }
});