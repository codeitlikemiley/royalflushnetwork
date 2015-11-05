@if (count($users) === 0)
... html showing no users found
@elseif (count($users) >= 1)
... print out results
    @foreach($users as $user)
    print user
    @endforeach
@endif