@extends('cyborg/body')

@section('page')
	<div class="start-stream">
		<div class="col-lg-12">
			<div class="heading-section">
				<h4>{{ $quiz->title }} <em>({{ round($quiz->score / 100, 1) }}%)</em></h4>
				<h5>{{ __('automath.completed-in') }}: {{ Carbon\CarbonInterval::seconds($quiz->time_spent)->cascade()->forHumans()  ?? 'nope' }}</h5>
			</div>
			<div class="row quiz-entries">
				@foreach($quiz->quizEntries as $entry)
					@automath_include($entry->problem->problemDefinition->solver, 'show')
				@endforeach
			</div>
		</div>
	</div>
@endsection