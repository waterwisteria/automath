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

.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
<main class="form-signin w-100 m-auto">
	<div class="zcol-lg-6">
		<form method="post" action="{{ route('login') }}">
			@csrf
			
			<h1 class="h3 mb-3 fw-normal">{{ __('Log in') }} | <a href="{{ route('register') }}">Register</a></h1>
			
			<x-auth-session-status class="mb-4" :status="session('status')" />
			
			<div class="form-floating">
				<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
				<label for="floatingInput">{{ __('Email') }}</label>
				<x-input-error :messages="$errors->get('email')" class="mt-2 warning" />
			</div>
			
			<div class="form-floating">
				<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="{{ __('Password') }}">
				<label for="floatingPassword">{{ __('Password') }}</label>
				<x-input-error :messages="$errors->get('password')" class="mt-2 warning" />
			</div>
			
			<div class="checkbox mb-3 w">
				<label>
					<input type="checkbox" value="remember-me"> {{ __('Remember me') }}
				</label>
			</div>

			<div class="mb-3 w">
				@if (Route::has('password.request'))
					<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
						{{ __('Forgot your password?') }}
					</a>
				@endif
			</div>
			
			<button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Log in') }}</button>
		</form>
	</div>
</main>
