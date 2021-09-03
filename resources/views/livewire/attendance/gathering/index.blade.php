<div class="py-4">
	
	<div class="px-4 flex flex-col md:flex-row md:items-center items-end md:justify-between">
		<div class="flex flex-row space-x-2">
			<x-select wire:model="perpage" class="w-1/8">
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</x-select>
			<x-jet-input type="text" class="block w-full md:w-72" placeholder="Cari disini.." wire:model="search" />
		</div>
		@role('developer|administrator')
		<x-button-link class="mt-4 md:mt-0" href="{{ route('gathering.create') }}">{{ __('Tambah Kegiatan') }}</x-button-link>
		@endrole
	</div>
	
	
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('Detail Kegiatan') }}</x-th>
			<x-th>{{ __('Guru Absen') }}</x-th>
			<x-th></x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($gatherings as $k => $gath)
			<tr>
				<x-td class="text-gray-600">{{ $gatherings->firstItem() + $k }}</x-td>
				<x-td>
					<div class="text-gray-900">
						{{ $gath->held_at->isoFormat('LL') }}
					</div>
				</x-td>
				<x-td>
					<div class="tex-gray-900 text-sm font-semibold">
						<x-link href="{{ route('gathering.show', $gath->id) }}">{{ $gath->name }}</x-link>
					</div>
					<div class="text-gray-600 text-sm">{{ $gath->description ?? '-' }}</div>
				</x-td>
				<x-td>
					<div class="text-gray-900">{{ $gath->users()->count() }} {{ __('orang') }}</div>
				</x-td>
				<x-td class="text-right text-sm font-medium">
					<div class="flex space-x-4 flex-row justify-end">
						<x-buttons.button-show href="{{ route('gathering.show', $gath->id) }}" />
							@role('developer|administrator')
							<x-buttons.button-edit href="{{ route('gathering.edit', $gath->id) }}" />
								<x-buttons.button-delete wire:click="confirmDelete({{ $gath->id }})" />
									@endrole
								</div>
							</x-td>
						</tr>
						@empty
						<x-empty-records :colspan="5" />
						@endforelse
					</x-slot>
				</x-table>
				
				@if($gatherings->hasPages())
				<div class="mt-4 px-4">
					{{ $gatherings->links() }}
				</div>
				@endif
				
				
				<x-jet-confirmation-modal wire:model="modal_confirmation">
					<x-slot name="title">{{ __('Konfirmasi Hapus Kegiatan') }}</x-slot>
					<x-slot name="content">
						@if ($item)
						<p>{{ __('Anda yakin ingin menghapus data kegiatan ') }} <span class="text-red-600 font-medium">{{ $item->name ?? '' }}</span> {{ __(' pada tanggal ') }} <span class="text-red-600 font-medium">{{ $item->held_at->isoFormat('LL') }}</span>?</p>
						@endif
					</x-slot>
					
					<x-slot name="footer">
						<x-jet-secondary-button wire:click="$toggle('modal_confirmation')" wire:loading.attr="disabled">
							{{ __('Batal') }}
						</x-jet-secondary-button>
						
						<x-jet-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
							{{ __('Ya, Hapus!') }}
						</x-jet-danger-button>
					</x-slot>
				</x-jet-confirmation-modal>
			</div>
			