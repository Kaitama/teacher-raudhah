<div x-data="{excelName: null, excelPreview: null}">
	
	<x-jet-form-section submit="update">
		<x-slot name="title">
			{{ __('Ubah Kegiatan') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Ubah absensi keguruan pada Kumpul Kamisan atau kegiatan lainnya.') }}
		</x-slot>
		
		<x-slot name="form">
			<!-- Fname -->
			<div class="col-span-6">
				<x-jet-label for="held_at">{{ __('Tanggal Kegiatan (dd/mm/yyyy)') }}<x-required /></x-jet-label>
				<x-jet-input id="held_at" type="text" class="mt-1 block w-full" wire:model.defer="held_at" autocomplete="held_at" />
				<x-jet-input-error for="held_at" class="mt-2" />
			</div>
			
			<!-- Fphone -->
			<div class="col-span-6">
				<x-jet-label for="name">{{ __('Nama Kegiatan') }}<x-required /></x-jet-label>
				<x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
				<x-jet-input-error for="name" class="mt-2" />
			</div>
			
			<!-- Fstatus -->
			<div class="col-span-6">
				<x-jet-label for="description">{{ __('Keterangan') }}</x-jet-label>
				<x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="description" />
				<x-jet-input-error for="description" class="mt-2" />
			</div>
			
			<div class="col-span-6">
				<x-jet-label for="search">{{ __('Guru yang Absen') }}</x-jet-label>
				<fieldset class="flex items-center space-x-10 mt-1 mb-4">
					<div class="flex items-center">
						<input type="radio" name="manual_input" value="manual" wire:model="manual_input" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" id="manual">
						<label for="manual" class="ml-3 block text-sm font-medium text-gray-700">{{ __('Manual Input') }}</label>
					</div>
					<div class="flex items-center">
						<input type="radio" name="manual_input" value="excel" wire:model="manual_input" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" id="excel">
						<label for="excel" class="ml-3 block text-sm font-medium text-gray-700">{{ __('Import Excel') }}</label>
					</div>
				</fieldset>

				@if($manual_input == 'manual')
				@livewire('teacher.search', ['ids' => $ids])
				
				@else
				{{-- Excel input --}}
				<div class="mt-2 text-right">
					<button type="button" wire:click="downloadTemplate" class="text-sm font-semibold border-0 text-indigo-600 focus:border-0 focus:outline-none">{{ __('Download Template Absensi Kumpul') }}</button>
				</div>

				<div class="my-4 rounded-md bg-gray-100 py-8 items-center col-span-12">
					<div class="overflow-hidden relative w-full mt-4 mb-4">
						<input type="file" class="hidden"
						wire:model="excel"
						x-ref="excel"
						x-on:change="
						excelName = $refs.excel.files[0].name;
						const reader = new FileReader();
						reader.onload = (e) => {
							excelPreview = e.target.result;
						};
						reader.readAsDataURL($refs.excel.files[0]);
						" />
						
						<button type="button" class="bg-indigo hover:text-indigo-500 text-indigo-700 text-xl py-2 px-4 block w-full inline-flex items-center justify-center font-bold" x-on:click.prevent="$refs.excel.click()">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
							</svg>
							<span class="ml-2" x-text="excelName ?? 'Pilih File Excel Absensi Kumpul'"></span>
						</button>
					</div>
				</div>
				
				<x-jet-input-error for="excel" class="mt-2" />

				@endif
				@if($teachers)
				
				<div class="mt-4 text-sm text-gray-900">
					<div class="grid grid-cols-12 gap-4">
						@foreach ($teachers as $i => $teacher)
						<div class="col-span-4 md:col-span-3 p-2 bg-gray-100 hover:bg-gray-200 rounded-full cursor-pointer" wire:click="remove({{ $i }})">
							<div class="flex items-center">
								<img src="{{ $teacher['profile_photo_url'] }}" alt="" class=" rounded-full h-6 w-6" />
								<div class="mx-2 truncate"><span>{{ $teacher['name'] }}</span></div>
							</div>
						</div>		
						@endforeach
					</div>
				</div>
				
				@endif
			</div>
			
			
			
			
		</x-slot>
		
		<x-slot name="actions">
			<x-jet-action-message class="mr-3" on="saved">
				{{ __('Tersimpan.') }}
			</x-jet-action-message>
			
			<x-jet-button wire:loading.attr="disabled">
				{{ __('Ubah') }}
			</x-jet-button>
		</x-slot>
	</x-jet-form-section>
	
</div>