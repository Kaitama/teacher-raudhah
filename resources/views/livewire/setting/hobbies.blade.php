<div>
	<!-- PARENTS -->
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Hobby dan Lainnya') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Update informasi data hobby anda.') }}
		</x-slot>
		
		<x-slot name="form">
			<!-- Arts -->
			<div class="col-span-6">
				<x-jet-label for="arts" value="{{ __('Bidang Seni') }}" />
				<x-jet-input id="arts" type="text" class="mt-1 block w-full" wire:model.defer="profile.arts" autocomplete="arts" />
			</div>
			<!-- Sports -->
			<div class="col-span-6">
				<x-jet-label for="sports" value="{{ __('Bidang Olahraga') }}" />
				<x-jet-input id="sports" type="text" class="mt-1 block w-full" wire:model.defer="profile.sports" autocomplete="sports" />
			</div>
			<!-- Organizations -->
			<div class="col-span-6">
				<x-jet-label for="organizations" value="{{ __('Bidang Organisasi') }}" />
				<x-jet-input id="organizations" type="text" class="mt-1 block w-full" wire:model.defer="profile.organizations" autocomplete="organizations" />
			</div>
			
			<!-- Others -->
			<div class="col-span-6">
				<x-jet-label for="others" value="{{ __('Hobby Lainnya') }}" />
				<x-textarea id="others" class="mt-1 block w-full" wire:model.defer="profile.others" />
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
	
</div>