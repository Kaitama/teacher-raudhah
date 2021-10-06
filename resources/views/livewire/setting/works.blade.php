<div>
	<x-jet-form-section submit="save">
		<x-slot name="title">
			{{ __('Pekerjaan') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Update informasi riwayat pekerjaan anda.') }}
		</x-slot>
		
		<x-slot name="form">
			<div class="col-span-6">
				<x-jet-label value="{{ __('Riwayat Pekerjaan') }}" />
				<div class="mt-1 text-sm text-gray-900">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						@forelse($works as $k => $work)
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<div class="flex-1 w-0 truncate">
									<div class="font-semibold">@if($work->position) {{ $work->position }} - @endif {{ $work->name }}</div>
									@if($work->description)
									<div class="text-gray-900">
										{{ $work->description }}
									</div>
									@endif
									<div class="text-gray-600">
										{{ __('Tahun ') }} {{ $work->in }} - {{ $work->out ?? 'Sekarang' }}
									</div>
									@if ($work->address)
									<div class="text-gray-600 text-light">
										{{ $work->address }}
									</div>
									@endif
								</div>
							</div>
							<div class="ml-4 flex-shrink-0">
								<x-jet-danger-button wire:click="destroy({{ $work->id }})">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</x-jet-danger-button>
							</div>
						</li>
						@empty
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm text-gray-500 italic">
							{{ __('Data masih kosong.') }}
						</li>
						@endforelse
					</ul>
				</div>
			</div>
		</x-slot>

		<x-slot name="actions">
			<x-jet-button type="button" wire:loading.attr="disabled" wire:click.prevent="$toggle('add_work')">
				{{ __('Tambah') }}
			</x-jet-button>
		</x-slot>

	</x-jet-form-section>


	{{-- Dialog Modal --}}
	<x-jet-dialog-modal wire:model="add_work">
		<x-slot name="title">
			{{ __('Tambah Data Pekerjaan') }}
		</x-slot>
		
		<x-slot name="content">
			<div class="grid grid-cols-6 gap-6 mt-2">

				<div class="col-span-6">
					<x-jet-label for="name">{{ __('Nama Instansi / Perusahaan') }}<x-required /></x-jet-label>
					<x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="off"  />
					<x-jet-input-error for="name" class="mt-2" />
				</div>
				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="in">{{ __('Mulai Tahun') }}<x-required /></x-jet-label>
					<x-jet-input id="in" type="text" class="mt-1 block w-full" wire:model.defer="in" autocomplete="off"  />
					<x-jet-input-error for="in" class="mt-2" />
				</div>
				<div class="col-span-6 sm:col-span-3">
					<x-jet-label for="out">{{ __('Sampai Tahun') }}</x-jet-label>
					<x-jet-input id="out" type="text" class="mt-1 block w-full" wire:model.defer="out" autocomplete="off"  />
					<x-jet-input-error for="out" class="mt-2" />
				</div>
				<div class="col-span-6">
					<x-jet-label for="position">{{ __('Posisi / Jabatan') }}</x-jet-label>
					<x-jet-input id="position" type="text" class="mt-1 block w-full" wire:model.defer="position" autocomplete="off"  />
				</div>

				<div class="col-span-6">
					<x-jet-label for="description">{{ __('Keterangan Tambahan') }}</x-jet-label>
					<x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" />
				</div>

				<div class="col-span-6">
					<x-jet-label for="address">{{ __('Alamat Instansi / Perusahaan') }}</x-jet-label>
					<x-textarea id="address" class="mt-1 block w-full" wire:model.defer="address" />
				</div>
			</div>
			
		</x-slot>
		
		<x-slot name="footer">
			<x-jet-secondary-button wire:click="$toggle('add_work')" wire:loading.attr="disabled">
				{{ __('Batal') }}
			</x-jet-secondary-button>
			
			<x-jet-button type="button" class="ml-2" wire:click="create" wire:loading.attr="disabled">
				{{ __('Simpan') }}
			</x-jet-button>
		</x-slot>
	</x-jet-dialog-modal>
	
</div>
