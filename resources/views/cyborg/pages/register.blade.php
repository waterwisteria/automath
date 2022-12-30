@extends('cyborg/layout')

@section('body')
<style>
	html,
	body {
		height: 100%;
	}
	
	body {
		display: flex;
		align-items: center;
		padding-top: 40px;
		padding-bottom: 40px;
	}
	
	.form-signin {
		max-width: 330px;
		padding: 15px;
	}
	
	.form-signin .form-floating:focus-within {
		z-index: 2;
	}

	.form-signin input[name="name"] {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
	}
	
	.form-signin input[type="email"] {
		margin-bottom: -1px;
		border-radius: 0;

	}
	
	.form-signin input[name="password"] {
		border-radius: 0;
	}

	.form-signin input[name="password_confirmation"] {
		margin-bottom: 10px;
		border-top-right-radius: 0;
		border-top-left-radius: 0;
	}
</style>
<main class="form-signin w-100 m-auto">
	<div class="zcol-lg-6">
		<form method="post" action="{{ route('register') }}">
			@csrf

			<h1 class="h3 mb-3 fw-normal">{{ __('Register') }} | <a href="{{ route('login') }}">{{ __('Log in') }}</a></h1>

			<!-- Name -->
			<div class="form-floating">
				<input type="text" name="name" class="form-control" id="floatingName" placeholder="Sir MathALot" value="{{ old('name') }}">
				<label for="floatingName">{{ __('Name') }}</label>
				<x-input-error :messages="$errors->get('name')" class="mt-2 warning" />
			</div>

			<!-- Email -->
			<div class="form-floating">
			<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
			<label for="floatingInput">{{ __('Email') }}</label>
			<x-input-error :messages="$errors->get('email')" class="mt-2 warning" />
			</div>

			<!-- Password -->
			<div class="form-floating">
				<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="{{ __('Password') }}">
				<label for="floatingPassword">{{ __('Password') }}</label>
				<x-input-error :messages="$errors->get('password')" class="mt-2 warning" />
			</div>

			<!-- Confirm password -->
			<div class="form-floating">
				<input type="password" name="password_confirmation" class="form-control" id="floatingPasswordConfirmation" placeholder="{{ __('Confirm Password') }}">
				<label for="floatingPasswordConfirmation">{{ __('Confirm Password') }}</label>
				<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 warning" />
			</div>

			<button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Register') }}</button>
		</form>
	</div>
</main>
@endsection