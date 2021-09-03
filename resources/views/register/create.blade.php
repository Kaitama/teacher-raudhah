<x-guest-layout>
	<x-jet-authentication-card>
			<x-slot name="logo">
					<x-jet-authentication-card-logo />
			</x-slot>

			<x-static-error-message />

			<form method="POST" action="{{ route('register.create') }}">
					@csrf
					<input type="hidden" name="nig" value="{{ $nig }}" />

					<div>
							<x-jet-label for="name">{{ __('Nama Lengkap') }}<x-required /></x-jet-label>
							<x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
							<x-jet-input-error for="name" class="mt-2" />
					</div>

					<div class="mt-4">
							<x-jet-label for="username">{{ __('Username') }}<x-required /></x-jet-label>
							<x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" />
							<x-jet-input-error for="username" class="mt-2" />
					</div>

					<div class="mt-4">
							<x-jet-label for="email">{{ __('Email') }}<x-required /></x-jet-label>
							<x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
							<x-jet-input-error for="email" class="mt-2" />
					</div>

					<div class="mt-4">
							<x-jet-label for="phone">{{ __('Nomor Telepon') }}<x-required /></x-jet-label>
							<x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
							<x-jet-input-error for="phone" class="mt-2" />
					</div>

					<div class="mt-4">
							<x-jet-label for="password">{{ __('Password') }}<x-required /></x-jet-label>
							<x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
							<x-jet-input-error for="password" class="mt-2" />
					</div>

					<div class="mt-4">
							<x-jet-label for="password_confirmation">{{ __('Konfirmasi Password') }}<x-required /></x-jet-label>
							<x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
					</div>

					<div class="flex items-center justify-between mt-4">
							<x-link class="text-sm" href="{{ route('login') }}">
									{{ __('Login akun disini.') }}
							</x-link>

							<x-jet-button class="ml-4">
									{{ __('Register') }}
							</x-jet-button>
					</div>
			</form>
	</x-jet-authentication-card>
</x-guest-layout>
