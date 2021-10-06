<div>
	<!-- BIODATA -->
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Biodata') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Update informasi biodata profil anda.') }}
		</x-slot>
		
		<x-slot name="form">
			
			<div class="col-span-6 p-4 border rounded-md border-gray-300 bg-gray-800 text-gray-100 shadow-lg">
				<div class="grid grid-cols-1 md:grid-cols-3">
					<div class="flex items-center col-span-2">
						<img class="rounded-full w-12" src="{{ $user->profile_photo_url }}" alt="">
						<div class="ml-4">
							<a class="font-bold text-xl text-indigo-100" href="{{ route('dashboard.profile') }}">{{ $profile->ftitle ?? null }} {{ $user->name }} {{ $profile->ltitle ?? null }}</a>
							<div class="text-md">
								{{ $user->nig->number }}
							</div>
						</div>
					</div>
					<div class="flex pt-4 md:pt-0 items-center md:justify-end text-gray-600 text-sm">
						<x-button-link-secondary href="{{ route('profile.show') }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
							</svg>
							{{ __('Edit akun') }}
						</x-button-link-secondary>
					</div>
				</div>
			</div>
			
			
			<!-- Ftitle -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="ftitle" value="{{ __('Gelar Depan') }}" />
				<x-jet-input id="ftitle" type="text" class="mt-1 block w-full" wire:model="profile.ftitle" autocomplete="ftitle" />
			</div>
			
			<!-- Ltitle -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="ltitle" value="{{ __('Gelar Belakang') }}" />
				<x-jet-input id="ltitle" type="text" class="mt-1 block w-full" wire:model="profile.ltitle" autocomplete="ltitle" />
			</div>
			
			<!-- KTP -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="ktp">{{ __('Nomor KTP') }}<x-required /></x-jet-label>
				<x-jet-input id="ktp" type="text" class="mt-1 block w-full" wire:model.defer="profile.ktp" autocomplete="ktp" />
				<x-jet-input-error for="profile.ktp" class="mt-2" />
			</div>
			
			<!-- NPWP -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="npwp" value="{{ __('Nomor NPWP') }}" />
				<x-jet-input id="npwp" type="text" class="mt-1 block w-full" wire:model.defer="profile.npwp" autocomplete="npwp" />
			</div>
			
			<!-- Phone -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="phone">{{ __('Nomor Telepon') }}<x-required /></x-jet-label>
				<x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="profile.phone" autocomplete="phone" />
				<x-jet-input-error for="profile.phone" class="mt-2" />
			</div>
			
			<!-- Gender -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="gender" value="{{ __('Jenis Kelamin') }}" />
				<x-select wire:model="profile.gender" class="mt-1 block w-full">
					<option value="1">Pria</option>
					<option value="0">Wanita</option>
				</x-select>
			</div>
			
			<!-- Birthplace -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="birthplace">{{ __('Tempat Lahir') }}<x-required /></x-jet-label>
				<x-jet-input id="birthplace" type="text" class="mt-1 block w-full" wire:model.defer="profile.birthplace" autocomplete="birthplace" />
				<x-jet-input-error for="profile.birthplace" class="mt-2" />
			</div>
			
			<!-- Birthdate -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="birthdate">{{ __('Tanggal Lahir (dd/mm/yyyy)') }}<x-required /></x-jet-label>
				<x-jet-input id="birthdate" type="text" class="mt-1 block w-full" wire:model.defer="birthdate" autocomplete="birthdate" />
				<x-jet-input-error for="birthdate" class="mt-2" />
			</div>
			
			<!-- Childnum -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="childnum" value="{{ __('Anak Ke') }}" />
				<x-jet-input id="childnum" type="text" class="mt-1 block w-full" wire:model.defer="profile.childnum" autocomplete="childnum" />
			</div>
			
			<!-- Siblings -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="siblings" value="{{ __('Jumlah Saudara') }}" />
				<x-jet-input id="siblings" type="text" class="mt-1 block w-full" wire:model.defer="profile.siblings" autocomplete="siblings" />
			</div>
			
			<!-- Blood -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="blood" value="{{ __('Golongan Darah') }}" />
				<x-jet-input id="blood" type="text" class="mt-1 block w-full" wire:model.defer="profile.blood" autocomplete="blood" />
			</div>
			
			<!-- marriage -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="marriage" value="{{ __('Status Pernikahan') }}" />
				<x-select wire:model="profile.marriage" class="mt-1 block w-full">
					@foreach ($marriages as $marriage)
					<option value="{{ $marriage }}">{{ $marriage }}</option>
					@endforeach
				</x-select>
			</div>

			<!-- Address -->
			<div class="col-span-6">
				<x-jet-label for="address" value="{{ __('Alamat Lengkap') }}" />
				<x-textarea id="address" class="mt-1 block w-full" wire:model.defer="profile.address" />
			</div>
			
		</x-slot>
		
		<x-slot name="actions">
			<x-jet-action-message class="mr-3" on="saved">
				{{ __('Tersimpan.') }}
			</x-jet-action-message>
			
			<x-jet-button wire:loading.attr="disabled">
				{{ __('Simpan') }}
			</x-jet-button>
		</x-slot>
	</x-jet-form-section>
	
	<x-jet-section-border />

	@livewire('setting.educations', ['userId' => $user->id])

	<x-jet-section-border />

	@livewire('setting.works', ['userId' => $user->id])

	<x-jet-section-border />
	
	@livewire('setting.partner', ['userId' => $user->id, 'partner' => $partner])
	
	<x-jet-section-border />
	
	@livewire('setting.parents', ['profile' => $profile])

	<x-jet-section-border />

	@livewire('setting.hobbies', ['profile' => $profile])


</div>
