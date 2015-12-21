{{-- Search Nav Bar Starts Here --}}

<nav>
    <div class="search-wrapper white">
       <form action="searchUser" method="POST" id="search_form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	        <div class="input-field overflow">
	          <input id="q" name="q" type="search" required style="color:#e57373;" placeholder="Search Sponsor Username"
              @if(\Cookie::has('sponsor'))
              {{--*/ $cookie = \Cookie::get('sponsor') /*--}}
              value="{{ $cookie['link']  }}"
              @endif
              >
	          <label for="search"><i class="material-icons" style="color:#e57373;">search</i></label>
	          <i class="material-icons" >close</i>

	        </div>
		</form>
    </div>
</nav>
{{-- Search Nav Bar Ends Here --}}
