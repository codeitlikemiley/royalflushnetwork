<div class="card-panel red darken-1" id="msg">
	<p class="error">
		<strong>Oops! Something went wrong : </strong>
		@foreach ($errors->all() as $error)
	        {{ $error }}
	    @endforeach
	</p>
</div>