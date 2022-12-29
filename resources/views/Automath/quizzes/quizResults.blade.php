@extends('agency/page')

@section('content')
	<section class="quiz-results">
		{{ $quiz->getFinalScore() }}%
	</section>
@endsection