<x-jet-form-section submit="exportExcel">
	<x-slot name="title">{{ __('Export Excel') }}</x-slot>
	<x-slot name="description">{{ __('Download data absensi dalam format file Excel.') }}</x-slot>
	
	<x-slot name="form">
		<!-- Start Date -->
		<div class="col-span-3">
			<x-jet-label for="s_date">{{ __('Mulai Tanggal (dd/mm/yyyy)') }}<x-required /></x-jet-label>
			<x-jet-input id="s_date" type="text" class="mt-1 block w-full" wire:model.defer="s_date" autocomplete="s_date" />
			<x-jet-input-error for="s_date" class="mt-2" />
		</div>
		
		<!-- End Date -->
		<div class="col-span-3">
			<x-jet-label for="e_date">{{ __('Sampai Tanggal (dd/mm/yyyy)') }}<x-required /></x-jet-label>
			<x-jet-input id="e_date" type="text" class="mt-1 block w-full" wire:model.defer="e_date" autocomplete="e_date" />
			<x-jet-input-error for="e_date" class="mt-2" />
		</div>
		
		<!-- Data to Download -->
		<div class="col-span-6">
			<div class="flex items-center justify-between">
				
				<label for="all_data" class="flex items-center mt-2 mb-2" wire:click="toggleOptions">
					<x-jet-checkbox id="all_data" wire:model="all_options" />
					<span class="ml-2 font-semibold text-indigo-700">{{ __('Semua Data Absensi') }}</span>
				</label>
				
			</div>
			<x-jet-input-error for="data_options" class="mt-2" />
			<div wire:click="checkOptions">
				<label for="gathering" class="flex items-center mt-2">
					<x-jet-checkbox id="gathering" value="1" wire:model="data_options" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Kumpul') }}</span>
				</label>
				<label for="permit" class="flex items-center mt-2">
					<x-jet-checkbox id="permit" value="2" wire:model="data_options" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Perizinan') }}</span>
				</label>
				<label for="assignment" class="flex items-center mt-2">
					<x-jet-checkbox id="assignment" value="3" wire:model="data_options" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Penugasan') }}</span>
				</label>
				<label for="teaching" class="flex items-center mt-2">
					<x-jet-checkbox id="teaching" value="4" wire:model="data_options" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Pengajaran') }}</span>
				</label>
				<label for="evaluation" class="flex items-center mt-2">
					<x-jet-checkbox id="evaluation" value="5" wire:model="data_options" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Evaluasi') }}</span>
				</label>
				<label for="ticket" class="flex items-center mt-2">
					<x-jet-checkbox id="ticket" value="6" wire:model="data_options" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Tiket') }}</span>
				</label>
				<label for="recaps" class="flex items-center mt-2">
					<x-jet-checkbox id="recaps" value="7" wire:model="data_options" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Rekapitulasi Absensi') }}</span>
				</label>
			</div>
		</div>
		
	</x-slot>
	<x-slot name="actions">
		<x-jet-action-message class="mr-3" on="saved">
			{{ __('Sukes.') }}
		</x-jet-action-message>
		<x-jet-button wire:loading.attr="disabled">
			{{ __('Download') }}
		</x-jet-button>
	</x-slot>
</x-jet-form-section>