<!-- ***** Dashboard Start ***** -->


<div class="row">
	<div class="col-lg-12">
		<div class="main-profile ">
			<div class="row">
				<div class="col-lg-4">
					<div>
						<canvas id="myChart"></canvas>
					</div>
					
					<!-- img src="/cyborg/assets/images/profile.jpg" alt="" style="border-radius: 23px;" -->
				</div>
				<div class="col-lg-4 align-self-center">
					<div class="main-info header-text">
						<span>Offline</span>
						<h4>{{ $user->name }}</h4>
						<p>You Haven't Gone Live yet. Go Live By Touching The Button Below.</p>
						<div class="main-border-button">
							<a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 align-self-center">
					<ul>
						<li>{{ __('automath.quizzes-completed') }} <span>{{ $completedQuizzes }}</span></li>
						<li>{{ __('automath.problems-answered') }} <span>{{ $questionsAnswered }}	</span></li>
						<li>Live Streams <span>None</span></li>
						<li>Clips <span>29</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
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