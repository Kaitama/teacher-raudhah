<div>
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Penugasan') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Penilaian penugasan') }} {{ $teacher->name }}.
		</x-slot>
		
		<x-slot name="form">

			<div class="col-span-4">
				<x-jet-label for="scored_at">{{ __('Tanggal Penilaian (dd/mm/yyyy)') }}<x-required /> </x-jet-label>
				<x-jet-input id="scored_at" type="text" class="mt-1 block w-full" wire:model.defer="scored_at" autocomplete="scored_at" />
				<x-jet-input-error for="scored_at" class="mt-2" />
			</div>

			<div class="col-span-4">
				<x-jet-label for="activity">{{ __('Nama Kegiatan') }}<x-required /></x-jet-label>
				<x-jet-input id="activity" type="text" class="mt-1 block w-full" wire:model.defer="activity" />
				<x-jet-input-error for="activity" class="mt-2" />
			</div>

			<div class="col-span-4">
				<x-jet-label for="score">{{ __('Nilai') }}<x-required /></x-jet-label>
				<x-jet-input id="score" type="text" class="mt-1 block w-full" wire:model.defer="score" autocomplete="score" />
				<x-jet-input-error for="score" class="mt-2" />
			</div>

			<div class="col-span-4">
				<x-jet-label for="description" value="{{ __('Keterangan') }}" />
				<x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="description" />
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
