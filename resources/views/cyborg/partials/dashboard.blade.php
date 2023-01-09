<!-- ***** Dashboard Start ***** -->
<div class="row">
	<div class="col-lg-12">
		<div class="main-profile ">
			<div class="row">
				<div class="col-lg-4">
					@if(!empty($quizChartsData))
						<div id="quizChartsData" data-json='@json($quizChartsData)'></div>
						<canvas id="myChart" data-message="{{ __('Results') }}"></canvas>
					@else
						<img src="/cyborg/assets/images/profile.jpg" alt="" style="border-radius: 23px;">
					@endif
				</div>
				<div class="col-lg-4 align-self-center">
					<div class="main-info header-text">
						<!-- span>Offline</span -->
						<h4>{{ $user->name }}</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<div class="main-border-button">
							<a href="{{ route('create.quiz') }}">{{ __('automath.create-quiz') }}</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 align-self-center">
					<ul>
						<li>{{ __('automath.quizzes-completed') }} <span>{{ $completedQuizzes }}</span></li>
						<li>{{ __('automath.problems-answered') }} <span>{{ $questionsAnswered }}	</span></li>
						<li>{{ __('automath.total-quiz-time') }} <span>{{ Carbon\CarbonInterval::seconds($totalQuizTime)->cascade()->forHumans([ 'parts' => 1 ])  ?? '' }}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ***** Dashboard End ***** -->