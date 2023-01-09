<!-- ***** Other Start ***** -->
<div class="other-games" id="ajax-more-best-quizzes-route" data-route="{{ route('ajax.more.best.quizzes') }}" data-best_quizzes_per_page="{{ config('automath.best_quizzes_per_page') }}">
	<div class="row">
		<div class="col-lg-12">
			<div class="heading-section">
				<h4>{!! __('automath.your-best-quizzes') !!}</h4>
			</div>
		</div>
		@forelse($bestQuizzes as $quiz)
			@include('cyborg/partials/best-quiz-item')
			
			@if($loop->last && $completedQuizzes > count($bestQuizzes))
				<div class="main-button-container col-lg-12">
					<div class="main-button">
						<a href="">{{ __('Show more quizzes') }}</a>
					</div>
				</div>
			@endif
		@empty
			<div class="col-lg-12">
				<div class="item">
					<p class="text-center">{!! __('You have no best quiz! <a href=":url">Create a quiz</a> and start ranking.', [ 'url' => route('create.quiz') ]) !!}
				</div>
			</div>
		@endforelse
	</div>
</div>
<!-- ***** Other End ***** -->