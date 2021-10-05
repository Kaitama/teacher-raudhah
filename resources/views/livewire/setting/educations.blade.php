<div>
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Pendidikan') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Update informasi data pendidikan anda.') }}
		</x-slot>
		
		<x-slot name="form">
			<div class="col-span-6">
				<x-jet-label value="{{ __('Riwayat Pendidikan') }}" />
				<div class="mt-1 text-sm text-gray-900">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						@foreach($educations as $k => $education)
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<div class="flex-1 w-0 truncate">
									<div class="font-semibold">{{ $levels[$education->level] }} - {{ $education->name }}@if($education->out == null) <x-pill color="green">{{ __('Active') }}</x-pill> @endif</div>
									@if($education->faculty)
									<div class="text-gray-900">
										{{ __('Fakultas') }} {{ $education->faculty }}{{ $education->faculty && $education->focus ? ', ' : '' }}{{ 'Jurusan/Program Studi ' . $education->focus }} 
									</div>
									@endif
									<div class="text-gray-600">
										{{ __('Tahun ') }} {{ $education->in }} - {{ $education->out ?? 'Sekarang' }}
										@if($education->certificate)
										| {{ 'Nomor Ijazah: ' . $education->certificate }}
										@endif
									</div>
									@if ($education->address)
									<div class="text-gray-600 text-light">
										{{ $education->address }}
									</div>
									@endif
								</div>
							</div>
							<div class="ml-4 flex-shrink-0">
								<x-jet-danger-button wire:click="destroy({{ $education->id }})">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</x-jet-danger-button>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</x-slot>

		<x-slot name="actions">
			<x-jet-button type="button" wire:loading.attr="disabled" wire:click.prevent="$toggle('add_education')">
				{{ __('Tambah') }}
			</x-jet-button>
		</x-slot>

	</x-jet-form-section>


	{{-- Dialog Modal --}}
	<x-jet-dialog-modal wire:model="add_education">
		<x-slot name="title">
			{{ __('Tambah Data Pendidikan') }}
		</x-slot>
		
		<x-slot name="content">
			<div class="grid grid-cols-6 gap-6 mt-2">
				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="level">{{ __('Jenjang Pendidikan') }}<x-required /></x-jet-label>
					<x-select class="mt-1 block w-full" wire:model.defer="level">
						@foreach ($levels as $k => $v)
						<option value="{{ $k }}">{{ $v }}</option>
						@endforeach
					</x-select>
				</div>

				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="certificate">{{ __('Nomor Ijazah') }}</x-jet-label>
					<x-jet-input id="certificate" type="text" class="mt-1 block w-full" wire:model.defer="certificate" autocomplete="off"  />
				</div>
				<div class="col-span-6 sm:col-span-2">
					<x-jet-label for="in">{{ __('Tahun Masuk') }}<x-required /></x-jet-label>
					<x-jet-input id="in" type="text" class="mt-1 block w-full" wire:model.defer="in" autocomplete="off"  />
					<x-jet-input-error for="in" class="mt-2" />
				</div>
				<div class="col-span-6 sm:col-span-2">
					<x-jet-label for="out">{{ __('Tahun Keluar') }}</x-jet-label>
					<x-jet-input id="out" type="text" class="mt-1 block w-full" wire:model.defer="out" autocomplete="off"  />
					<x-jet-input-error for="out" class="mt-2" />
				</div>
				<div class="col-span-6 sm:col-span-2">
					<x-jet-label for="semester">{{ __('Semester') }}</x-jet-label>
					<x-jet-input id="semester" type="text" class="mt-1 block w-full" wire:model.defer="semester" autocomplete="off"  />
					<x-jet-input-error for="semester" class="mt-2" />
				</div>

				<div class="col-span-6">
					<x-jet-label for="name">{{ __('Nama Sekolah / Universitas') }}<x-required /></x-jet-label>
					<x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="off"  />
					<x-jet-input-error for="name" class="mt-2" />
				</div>
				
				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="faculty">{{ __('Fakultas') }}</x-jet-label>
					<x-jet-input id="faculty" type="text" class="mt-1 block w-full" wire:model.defer="faculty" autocomplete="faculty"  />
				</div>
				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="focus">{{ __('Jurusan / Program Studi') }}</x-jet-label>
					<x-jet-input id="focus" type="text" class="mt-1 block w-full" wire:model.defer="focus" autocomplete="focus"  />
				</div>

				<div class="col-span-6">
					<x-jet-label for="address">{{ __('Alamat Sekolah / Universitas') }}</x-jet-label>
					<x-textarea class="mt-1 block w-full" wire:model.defer="address" />
				</div>
			</div>
			
		</x-slot>
		
		<x-slot name="footer">
			<x-jet-secondary-button wire:click="$toggle('add_education')" wire:loading.attr="disabled">
				{{ __('Batal') }}
			</x-jet-secondary-button>
			
			<x-jet-button type="button" class="ml-2" wire:click="create" wire:loading.attr="disabled">
				{{ __('Simpan') }}
			</x-jet-button>
		</x-slot>
	</x-jet-dialog-modal>
	
</div>
