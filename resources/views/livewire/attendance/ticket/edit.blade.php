<div>
	
	<x-jet-form-section submit="update">
		<x-slot name="title">
			{{ __('Ubah Tiket') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Ubah tiket guru.') }}
		</x-slot>
		
		<x-slot name="form">

			<!-- Saved_at -->
			<div class="col-span-6">
				<x-jet-label for="saved_at">{{ __('Tanggal (dd/mm/yyyy)') }}<x-required /></x-jet-label>
				<x-jet-input id="saved_at" type="text" class="mt-1 block w-full" wire:model.defer="saved_at" autocomplete="saved_at" />
				<x-jet-input-error for="saved_at" class="mt-2" />
			</div>

			<!-- Teacher -->
			<div class="col-span-6">
				<x-jet-label for="search">{{ __('Guru Pengganti') }}<x-required /></x-jet-label>
				{{-- @livewire('teacher.search') --}}
				<x-jet-input-error for="teachers" class="mt-2" />
				
				@if($teachers)
				
				<div class="mt-4 text-sm text-gray-900">
					<div class="grid grid-cols-12 gap-4">
						@foreach ($teachers as $i => $teacher)
						<div class="col-span-4 md:col-span-3 p-2 bg-gray-100 hover:bg-gray-200 rounded-full">
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

			<!-- Session -->
			<div class="col-span-6">
				<x-jet-label for="session">{{ __('Jumlah Les') }}<x-required /></x-jet-label>
				<x-jet-input id="session" type="number" class="mt-1 block w-full" wire:model.defer="session" autocomplete="session" />
				<x-jet-input-error for="session" class="mt-2" />
			</div>
			
			<!-- Description -->
			<div class="col-span-6">
				<x-jet-label for="description">{{ __('Keterangan') }}</x-jet-label>
				<x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="description" />
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