<div>
	<!-- PARTNER -->
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Keluarga') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Update informasi data keluarga anda.') }}
		</x-slot>
		
		<x-slot name="form">
			<!-- Name -->
			<div class="col-span-6">
				<x-jet-label for="pname" value="{{ __('Nama Istri/Suami') }}" />
				<x-jet-input id="pname" type="text" class="mt-1 block w-full" wire:model.defer="partner.name" autocomplete="name" />
				<x-jet-input-error for="name" class="mt-2" />
			</div>
			<!-- Phone -->
			<div class="col-span-6">
				<x-jet-label for="pphone" value="{{ __('Nomor Telepon') }}" />
				<x-jet-input id="pphone" type="text" class="mt-1 block w-full" wire:model.defer="partner.phone" autocomplete="phone" />
				<x-jet-input-error for="phone" class="mt-2" />
			</div>
			<!-- Education -->
			<div class="col-span-6">
				<x-jet-label for="education" value="{{ __('Pendidikan Terakhir') }}" />
				<x-select id="education" class="mt-1 block w-full" wire:model.defer="partner.education">
					<option value="SMP/MTs">SMP/MTs</option>
					<option value="SMA/MA">SMA/MA</option>
					<option value="S1">S1</option>
					<option value="S2">S2</option>
					<option value="S3">S3</option>
				</x-select>
				<x-jet-input-error for="education" class="mt-2" />
			</div>
			<!-- Work -->
			<div class="col-span-6">
				<x-jet-label for="work" value="{{ __('Pekerjaan') }}" />
				<x-jet-input id="work" type="text" class="mt-1 block w-full" wire:model.defer="partner.work" autocomplete="work" />
				<x-jet-input-error for="work" class="mt-2" />
			</div>
			
			<!-- Childrens -->
			<div class="col-span-6">
				
				<x-jet-label value="{{ __('Data Anak') }}" />
				<div class="mt-1 text-sm text-gray-900">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						@foreach($childs as $k => $child)
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<div class="flex-1 w-0 truncate">
									<div class="font-semibold">{{ $child->name }}</div>
									<div class="text-gray-600">{{ $child->birthplace }}, {{ $child->birthdate->isoFormat('LL') }}</div>
								</div>
							</div>
							<div class="ml-4 flex-shrink-0">
								<x-jet-danger-button wire:click="deleteChildren({{ $child->id }})">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</x-jet-danger-button>
							</div>
						</li>
						@endforeach
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								
							</div>
							<div class="ml-4 flex-shrink-0">
								<x-jet-secondary-button wire:click="$toggle('add_children')">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
									</svg>
									<span class="ml-1">
										{{ __('Tambah Data Anak') }}
									</span>
								</x-jet-secondary-button>
							</div>
						</li>
					</ul>
				</div>
				
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
	
	
	{{-- Dialog Modal --}}
	<x-jet-dialog-modal wire:model="add_children">
		<x-slot name="title">
			{{ __('Tambah Data Anak') }}
		</x-slot>
		
		<x-slot name="content">
			<div class="grid grid-cols-6 gap-6 mt-2">
				<div class="col-span-6 sm:col-span-4">
					<x-jet-label for="child_name">{{ __('Nama Lengkap') }} <x-required /></x-jet-label>
					<x-jet-input id="child_name" type="text" class="mt-1 block w-full" wire:model.defer="child_name" autocomplete="child_name"  />
					<x-jet-input-error for="child_name" class="mt-2" />
				</div>
				<div class="col-span-6 sm:col-span-2">
					<x-jet-label for="child_name">{{ __('Jenis Kelamin') }} <x-required /></x-jet-label>
					<x-select class="mt-1 block w-full" wire:model.defer="child_gender">
						<option value="1">{{ __('Laki-laki') }}</option>
						<option value="0">{{ __('Perempuan') }}</option>
					</x-select>
				</div>
				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="child_birthplace">{{ __('Tempat Lahir') }} <x-required /></x-jet-label>
					<x-jet-input id="child_birthplace" type="text" class="mt-1 block w-full" wire:model.defer="child_birthplace" autocomplete="child_birthplace"  />
					<x-jet-input-error for="child_birthplace" class="mt-2" />
				</div>
				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="child_birthdate">{{ __('Tanggal Lahir (dd/mm/yyyy)') }} <x-required /></x-jet-label>
					<x-jet-input id="child_birthdate" type="text" class="mt-1 block w-full" wire:model.defer="child_birthdate" autocomplete="child_birthdate"  />
					<x-jet-input-error for="child_birthdate" class="mt-2" />
				</div>
			</div>
			
		</x-slot>
		
		<x-slot name="footer">
			<x-jet-secondary-button wire:click="$toggle('add_children')" wire:loading.attr="disabled">
				{{ __('Batal') }}
			</x-jet-secondary-button>
			
			<x-jet-button type="button" class="ml-2" wire:click="saveChildren" wire:loading.attr="disabled">
				{{ __('Simpan') }}
			</x-jet-button>
		</x-slot>
	</x-jet-dialog-modal>
	
	
</div>