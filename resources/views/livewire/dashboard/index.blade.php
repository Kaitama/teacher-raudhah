<div>
	<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
		
		<div class="mt-4">
			<div class="grid grid-cols-1 md:grid-cols-2">
				<div class="flex items-center">
					<img class="rounded-full w-16" src="{{ Auth::user()->profile_photo_url }}" alt="">
					<div class="ml-4 text-2xl">
							<x-link class="font-bold" href="{{ route('dashboard.profile') }}">{{ $user->name }}</x-link>
						<div class="text-xl text-gray-600">
							{{ $user_nig ? $user_nig->number : $user->email }}
						</div>
					</div>
				</div>
				<div class="flex pt-4 md:pt-0 items-center md:justify-end text-gray-600 text-sm">
					@if($user_nig)
					<x-button-link-secondary href="{{ route('profile.edit') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
						</svg>
						{{ __('Edit profil') }}
					</x-button-link-secondary>
					@endif
				</div>
			</div>
			
			
		</div>
		
		@if(!$user_nig)
		<div class="mt-6 bg-red-50 p-4 flex justify-between items-center w-full space-x-6 rounded-md">
			<div class="text-red-600 text-md">
				Mohon lengkapi data <span class="font-bold">Nomor Induk Guru (NIG)</span> anda sebelum melanjutkan!
			</div>
			<x-jet-danger-button wire:click="$toggle('modal_set_nig')">Lanjutkan</x-jet-danger-button>
		</div>
		
		<!-- Modal Set NIG -->
		<x-jet-dialog-modal wire:model="modal_set_nig">
			<x-slot name="title">
				{{ __('Input Nomor Induk Guru') }}
			</x-slot>
			
			<x-slot name="content">
				{{ __('Jika anda mendapatkan pesan "NIG Tidak Terdaftar", segera hubungi Administrator yang bertugas.') }}
				
				<div class="mt-4">
					<x-jet-input type="text" class="mt-1 block w-3/4" placeholder="{{ __('Nomor Induk Guru') }}" wire:model.defer="nig" wire:keydown.enter="setNig" />
					<x-jet-input-error for="nig" class="mt-2" />
				</div>
			</x-slot>
			
			<x-slot name="footer">
				<x-jet-secondary-button wire:click="$toggle('modal_set_nig')" wire:loading.attr="disabled">
					{{ __('Cancel') }}
				</x-jet-secondary-button>
				
				<x-jet-button class="ml-2" wire:click="setNig" wire:loading.attr="disabled">
					{{ __('Simpan') }}
				</x-jet-button>
			</x-slot>
		</x-jet-dialog-modal>
		
		@endif
	</div>
	
	@if($user_nig)
	@livewire('dashboard.attendance')
	@endif
	
</div>
