<div>
	@if (!$register)
			
	<form wire:submit.prevent="checking">
		
		<div>
			<x-jet-label for="nig">{{ __('Nomor Induk Guru') }}<x-required /></x-jet-label>
			<x-jet-input id="nig" type="text" class="mt-1 block w-full" wire:model.defer="nig" autocomplete="nig" autofocus />
			<x-jet-input-error for="nig" class="mt-2" />
		</div>
		
		<div class="flex items-center justify-between mt-4">
			<x-link href="{{ route('login') }}" class="text-sm">
				{{ __('Login akun disini.') }}
			</x-link>
			
			
			<x-jet-button wire:loading.attr="disabled" class="ml-4">
				{{ __('Check') }}
			</x-jet-button>
			
		</div>
	</form>

	@else

	<form wire:submit.prevent="register">
		
		<div>
				<x-jet-label for="name">{{ __('Nama Lengkap') }}<x-required /></x-jet-label>
				<x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.defer="name" autofocus autocomplete="name" />
				<x-jet-input-error for="name" class="mt-2" />
		</div>

		<div class="mt-4">
				<x-jet-label for="username">{{ __('Username') }}<x-required /></x-jet-label>
				<x-jet-input id="username" class="block mt-1 w-full" type="text" wire:model.defer="username" />
				<x-jet-input-error for="username" class="mt-2" />
		</div>

		<div class="mt-4">
				<x-jet-label for="email">{{ __('Email') }}<x-required /></x-jet-label>
				<x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model.defer="email" />
				<x-jet-input-error for="email" class="mt-2" />
		</div>

		<div class="mt-4">
				<x-jet-label for="phone">{{ __('Nomor Telepon') }}<x-required /></x-jet-label>
				<x-jet-input id="phone" class="block mt-1 w-full" type="text" wire:model.defer="phone" />
				<x-jet-input-error for="phone" class="mt-2" />
		</div>

		<div class="mt-4">
				<x-jet-label for="gender">{{ __('Jenis Kelamin') }}<x-required /></x-jet-label>
				<x-select id="gender" class="block mt-1 w-full" wire:model.defer="gender">
					<option value="1">{{ __('Pria') }}</option>
					<option value="0">{{ __('Wanita') }}</option>
				</x-select>
		</div>

		<div class="mt-4">
				<x-jet-label for="password">{{ __('Password') }}<x-required /></x-jet-label>
				<x-jet-input id="password" class="block mt-1 w-full" type="password" wire:model.defer="password" autocomplete="new-password" />
				<x-jet-input-error for="password" class="mt-2" />
		</div>

		<div class="mt-4">
				<x-jet-label for="password_confirmation">{{ __('Konfirmasi Password') }}<x-required /></x-jet-label>
				<x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" wire:model.defer="password_confirmation" autocomplete="new-password" />
		</div>

		<div class="flex items-center justify-between mt-4">
				<x-link class="text-sm" href="{{ route('login') }}">
						{{ __('Login akun disini.') }}
				</x-link>

				<x-jet-button wire:loading.attr="disabled" class="ml-4">
						{{ __('Register') }}
				</x-jet-button>
		</div>
</form>
			
	@endif
</div>