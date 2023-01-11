@extends('cyborg/body')

@section('page')
	<form method="post" action="{{ route('post.create.quiz') }}">
		@csrf
		<div class="main-profile">
			<h1>{{ __('automath.create-quiz') }}</h1>
			<div class="mt-3 col-lg-6 align-self-center">
				<ul>
					@foreach($problems as $problem)
						<li>
							<div class="mb-3">
								<label for="problem[{{ $problem->id }}]" class="form-label">{{ ucfirst($problem->description) }}</label>
								<input type="number" class="form-control" id="problem[{{ $problem->id }}]" min="0" value="5">
							</div>
						</li>
					@endforeach
				</ul>

				<div class="flex items-center gap-4">
					<button class="mt-4 btn btn-lg btn-primary" type="submit">{{ __('Save') }}</button>
				</div>
			</div>
		</div>
	</form>
@endsection