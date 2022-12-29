@extends('agency/page')

@section('content')
	<section class="practice-form">
		<form method="post" action="/practice">
			@csrf
			<ul>
				@foreach($quizzes as $quizz)
					<li>@include(Str::replace('\\', '/', $quizz->problem->problemDefinition->solver))</li>
				@endforeach
			</ul>

			<input type="submit" class="btn btn-primary" />
		</form>
	</section>
@endsection