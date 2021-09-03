<x-jet-form-section submit="updateBiodataInformation">
	<x-slot name="title">
		{{ __('Informasi Profil') }}
	</x-slot>
	
	<x-slot name="description">
		{{ __('Update informasi profil dan biodata anda.') }}
	</x-slot>
	
	<x-slot name="form">
		
		<!-- Phone -->
		<div class="col-span-6 sm:col-span-4">
			<x-jet-label for="phone" value="{{ __('Telepon') }}" />
			<x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="profile.phone" />
			<x-jet-input-error for="phone" class="mt-2" />
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