@extends('cyborg/body')

@section('page')
	<form method="post" action="{{ route('post.quiz', $quiz->id) }}" autocomplete="off">
		@csrf
		
		<div class="start-stream">
			<div class="col-lg-12">
				<div class="heading-section">
					<h4>{{ $quiz->title }} <em>{{ $quiz->questionsAnswered() }}/{{ $quiz->quizEntries->count() }}</em></h4>
				</div>
				<div class="row quiz-entries">
					@foreach($quizEntries as $entry)
						@automath_include($entry->problem->problemDefinition->solver, 'edit')
					@endforeach
	
					<div class="col-lg-12">
						<div class="main-button">
							<button>{{ __('automath.submit-answers') }}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection