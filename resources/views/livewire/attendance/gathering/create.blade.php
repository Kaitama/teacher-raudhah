<div>
	
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Tambah Kegiatan') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Tambah absensi keguruan pada Kumpul Kamisan atau kegiatan lainnya.') }}
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
				@livewire('teacher.search')
				
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
				{{ __('Simpan') }}
			</x-jet-button>
		</x-slot>
	</x-jet-form-section>
	
</div>