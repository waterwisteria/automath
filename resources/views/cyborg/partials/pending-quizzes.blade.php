<!-- ***** Gaming Library Start ***** -->
<div class="gaming-library">
	<div class="col-lg-12">
		<div class="heading-section">
			<h4>{!! __('automath.your-pending-quizzes') !!}</h4>
		</div>

		@foreach($pendingQuizzes as $quiz)
			<div class="item">
				<ul>
					<li><img src="/cyborg/assets/images/stream-0{{ rand(1, 8) }}.jpg" alt="" class="templatemo-item"></li>
					<li><h4>{{ $quiz->title }}</h4><span>Arithmetics</span></li>
					<li><h4>{{ __('automath.date-added') }}</h4><span>{{ date('F d', strtotime($quiz->created_at)) }}</span></li>
					<li><h4>{{ __('automath.total-problems') }}</h4><span>{{ $quiz->quizEntries->count() }}</span></li>
					<li><h4>{{ __('automath.completed%') }}</h4><span>{{ floor($quiz->percentCompleted()) }}%</span></li>
					<li><div class="main-border-button"><a href="{{ route('solve.quiz', [ 'id' => $quiz->id ]) }}">Quiz</a></div></li>
				</ul>
			</div>
		@endforeach
	</div>
</div>
<!-- ***** Gaming Library End ***** -->