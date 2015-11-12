<form action="searchUser" method="POST" id="search_form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="input-field">
          <input id="q" name="q" type="search" required style="color:#e57373;" placeholder="Search Sponsor :" >
          <label for="search"><i class="material-icons" style="color:#e57373;">search</i></label>
          <i class="material-icons" >close</i>

        </div>

</form>










