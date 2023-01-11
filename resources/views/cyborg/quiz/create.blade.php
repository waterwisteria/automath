@extends('cyborg/body')

@section('page')
	<form method="post" action="{{ route('post.create.quiz') }}">
		@csrf
		<div class="main-profile">
			<h1>{{ __('automath.create-quiz') }}</h1>
			<div class="mt-3 col-lg-6 align-self-center">
				<ul>
					<li>
						<div class="mb-3">
							<label for="title" class="form-label">{{ __('Quiz name') }}</label>
							@error('title')
								<div class="text-danger p-3 bg-dark">{{ $errors->first('title') }}</div>
							@enderror
							<input
								type="text"
								class="form-control"
								id="title"
								name="title"
								min="-50"
								value="{{ old('title', __('My quiz')) }}"
							>
						</div>
					</li>
					@foreach($problems as $problem)
						@php($problemName = 'problem.' . $problem->id)
						<li>
							<div class="mb-3">
								<label for="problem[{{ $problem->id }}]" class="form-label">{{ ucfirst($problem->description) }}</label>
								@error($problemName)
									<div class="text-danger p-3 bg-dark">{{ $errors->first($problemName) }}</div>
								@enderror
								<input
									type="number"
									class="form-control"
									id="problem[{{ $problem->id }}]"
									name="problem[{{ $problem->id }}]"
									min="-50"
									value="{{ old($problemName, 5) }}"
								>
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