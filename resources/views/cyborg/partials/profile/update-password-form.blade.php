<div class="heading-section">
    <h4>{!! __('<em>Update</em> Password') !!}</h4>
    <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
</div>

<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')

    <div>
        <label for="current_password" class="w form-label">{{ __('Current Password') }}</label>
        <input id="current_password" name="current_password" type="password" class="mt-1 form-control" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div class="mt-2">
        <label for="password" class="w form-label">{{ __('New Password') }}</label>
        <input id="password" name="password" type="password" class="mt-1 form-control" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div class="mt-2">
        <label for="password_confirmation" class="w form-label">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 form-control" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <button class="mt-4 btn btn-lg btn-primary" type="submit">{{ __('Save') }}</button>

        @if(session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved') }}.</p>
        @endif
    </div>
</form>
