@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.includes') }}</div>

				<div class="panel-body">
					<p>{{ Lang::get('auth.tooManyEmails',
						['email' => $email] ) }}</p>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
