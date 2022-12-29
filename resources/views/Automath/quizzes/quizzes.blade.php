@extends('agency/page')

@section('content')
	<section class="practice-form">
		<ul>
			@foreach($quizzes as $quizz)
				<li>
					<a href="{{ route('solve.quiz', $quizz->id) }}">{{ $quizz->title }}</a>
				</li>
			@endforeach
		</ul>
	</section>
@endsection