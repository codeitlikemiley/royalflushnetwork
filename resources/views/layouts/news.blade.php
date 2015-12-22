
<div class="latest_members">


<h2>Latest Members<i class="material-icons amber-text">new_releases</i></h2>
<ul id="users">
    <li v-for="user in users"><strong class="amber-text">@{{ user.display_name }}</strong><strong> Joined </strong><abbr class="timeago" v-bind:title="user.created_at">@{{ user.created_at }}</abbr></li>

</ul>

</div>
