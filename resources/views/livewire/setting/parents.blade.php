<div>
	<!-- PARENTS -->
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Orang Tua') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Update informasi data orang tua anda.') }}
		</x-slot>
		
		<x-slot name="form">
			<!-- Fname -->
			<div class="col-span-6">
				<x-jet-label for="fname">{{ __('Nama Ayah') }}<x-required /></x-jet-label>
				<x-jet-input id="fname" type="text" class="mt-1 block w-full" wire:model.lazy="profile.fname" autocomplete="fname" />
				<x-jet-input-error for="profile.fname" class="mt-2" />
			</div>
			
			<!-- Fphone -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="fphone" value="{{ __('Telepon Ayah') }}" />
				<x-jet-input id="fphone" type="text" class="mt-1 block w-full" wire:model.defer="profile.fphone" autocomplete="fphone" />
			</div>
			
			<!-- Fstatus -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="fstatus" value="{{ __('Status Keberadaan Ayah') }}" />
				<x-select wire:model="profile.fstatus" class="mt-1 block w-full">
					<option value="1">Masih Hidup</option>
					<option value="0">Sudah Meninggal</option>
				</x-select>
			</div>
			
			<!-- Mname -->
			<div class="col-span-6">
				<x-jet-label for="mname">{{ __('Nama Ibu') }}<x-required /></x-jet-label>
				<x-jet-input id="mname" type="text" class="mt-1 block w-full" wire:model.lazy="profile.mname" autocomplete="mname" />
				<x-jet-input-error for="profile.mname" class="mt-2" />
			</div>
			
			<!-- Mphone -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="mphone" value="{{ __('Telepon Ibu') }}" />
				<x-jet-input id="mphone" type="text" class="mt-1 block w-full" wire:model.defer="profile.mphone" autocomplete="mphone" />
			</div>
			
			<!-- Mstatus -->
			<div class="col-span-6 sm:col-span-3">
				<x-jet-label for="mstatus" value="{{ __('Status Keberadaan Ibu') }}" />
				<x-select wire:model="profile.mstatus" class="mt-1 block w-full">
					<option value="1">Masih Hidup</option>
					<option value="0">Sudah Meninggal</option>
				</x-select>
			</div>
			
			<!-- PAddress -->
			<div class="col-span-6">
				<x-jet-label for="paddress" value="{{ __('Alamat Orang Tua') }}" />
				<x-textarea id="paddress" class="mt-1 block w-full" wire:model.defer="profile.paddress" />
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