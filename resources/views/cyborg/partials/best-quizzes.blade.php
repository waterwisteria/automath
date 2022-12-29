<!-- ***** Other Start ***** -->
<div class="other-games">
	<div class="row">
		<div class="col-lg-12">
			<div class="heading-section">
				<h4>{!! __('automath.your-best-quizzes') !!}</h4>
			</div>
		</div>
		@foreach($bestQuizzes as $quiz)
			<div class="col-lg-6">
				<div class="item">
					<img src="/cyborg/assets/images/game-0{{ rand(1, 3) }}.jpg" alt="" class="templatemo-item">
					<h4><a href="{{ route('result.quiz', [ 'id' => $quiz->id ]) }}">{{ $quiz->title }}</a></h4><span>Arithmetic problems</span>
					<ul>
						<li><i class="fa fa-star"></i> {{ round($quiz->score / 100, 1) }}%</li>
						<li><i class="fa fa-download"></i> {{ $quiz->quizEntries->count() }}</li>
					</ul>
				</div>
			</div>
		@endforeach
	</div>
</div>
<!-- ***** Other End ***** -->