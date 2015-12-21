
<div class="latest_members">


<h2>Latest Members</h2>
<ul id="users">
    <li v-for="user in users"><strong class="amber-text">@{{ user.display_name }}</strong> --- <strong>Signed Up!</strong> --- <abbr class="timeago" v-bind:title="user.created_at">@{{ user.created_at }}</abbr></li>

</ul>

</div>
