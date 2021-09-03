<div>
	
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Tambah Evaluasi') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Tambah evaluasi guru.') }}
		</x-slot>
		
		<x-slot name="form">
			<!-- Signed_at -->
			<div class="col-span-6">
				<x-jet-label for="signed_at">{{ __('Tanggal (dd/mm/yyyy)') }}<x-required /></x-jet-label>
				<x-jet-input id="signed_at" type="text" class="mt-1 block w-full" wire:model.defer="signed_at" autocomplete="signed_at" />
				<x-jet-input-error for="signed_at" class="mt-2" />
			</div>
			
			<!-- Category -->
			<div class="col-span-6">
				<x-jet-label for="category">{{ __('Evaluasi Guru') }}<x-required /></x-jet-label>
				<x-select id="category" wire:model.defer="category" class="mt-1 block w-full">
					@foreach ($categories as $key => $category)
							<option value="{{ $key }}">{{ $category }}</option>
					@endforeach
				</x-select>
				<x-jet-input-error for="category" class="mt-2" />
			</div>

			<!-- Decree -->
			<div class="col-span-6">
				<x-jet-label for="decree">{{ __('Nomor Surat') }}</x-jet-label>
				<x-jet-input id="decree" type="text" class="mt-1 block w-full" wire:model.defer="decree" autocomplete="decree" />
				<x-jet-input-error for="decree" class="mt-2" />
			</div>
			
			<!-- Description -->
			<div class="col-span-6">
				<x-jet-label for="description">{{ __('Keterangan') }}</x-jet-label>
				<x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="description" />
			</div>
			
			<div class="col-span-6">
				<x-jet-label for="search">{{ __('Guru yang Dievaluasi') }}<x-required /></x-jet-label>
				@livewire('teacher.search')
				<x-jet-input-error for="teachers" class="mt-2" />
				
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