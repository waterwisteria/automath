<!-- ***** Dashboard Start ***** -->
<div class="row">
	<div class="col-lg-12">
		<div class="main-profile ">
			<div class="row">
				<div class="col-lg-4">
					<canvas id="myChart"></canvas>
				</div>
				<div class="col-lg-4 align-self-center">
					<div class="main-info header-text">
						<!-- span>Offline</span -->
						<h4>{{ $user->name }}</h4>
						<p>You Haven't Gone Live yet. Go Live By Touching The Button Below.</p>
						<div class="main-border-button">
							<a href="{{ route('profile.edit') }}">Create quiz</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 align-self-center">
					<ul>
						<li>{{ __('automath.quizzes-completed') }} <span>{{ $completedQuizzes }}</span></li>
						<li>{{ __('automath.problems-answered') }} <span>{{ $questionsAnswered }}	</span></li>
						<li>{{ __('automath.total-quiz-time') }} <span>{{ Carbon\CarbonInterval::seconds($totalQuizTime)->cascade()->forHumans()  ?? '' }}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	//Chart.defaults.backgroundColor = '#fff';
	Chart.defaults.color = '#e75e8d';
	
	const ctx = document.getElementById('myChart');
	
	new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [ '{!! implode('\', \'', $lastQuizLabels) !!}' ],
			datasets: [{
				label: 'Quiz results',
				data: [ {{ implode(', ', $lastQuizResults) }} ],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>
<!-- ***** Dashboard End ***** -->