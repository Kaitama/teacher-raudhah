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
		<x-button-link class="mt-4 md:mt-0" href="{{ route('assignment.create') }}">{{ __('Tambah Penugasan') }}</x-button-link>
		@endrole
	</div>
		
		
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('Penugasan') }}</x-th>
			<x-th>{{ __('Data Guru') }}</x-th>
			@role('developer|administrator')
			<x-th></x-th>
			@endrole
		</x-slot>
		<x-slot name="td">
			@forelse ($assignments as $k => $assign)
			<tr>
				<x-td class="text-gray-600">{{ $assignments->firstItem() + $k }}</x-td>
				<x-td>
					<div class="tex-gray-900 text-sm font-semibold">{{ $assign->signed_at->isoFormat('LL') }}</div>
					<div class="text-gray-600 text-sm">{{ $assign->decree }}</div>
				</x-td>
				<x-td>
					<div class="tex-gray-900 text-sm font-semibold">
						<x-link href="{{ route('teacher.show', $assign->user->id) }}">{{ $assign->user->name }}</x-link>
					</div>
					<div class="text-gray-600 text-sm">{{ $assign->description ?? '-' }}</div>
				</x-td>
				<x-td>
					<div class="text-gray-900 text-sm font-semibold">{{ $categories[$assign->category] }}</div>
					<div class="text-gray-600 text-sm">
						{{ __('Mulai tanggal ' . $assign->started_at->format('d/m/Y') . ' sampai ') }}
						{{ $assign->ended_at ? 'tanggal ' . $assign->ended_at->format('d/m/Y') : 'sekarang' }}
					</div>
				</x-td>
				@role('developer|administrator')
				<x-td class="text-right text-sm font-medium">
					<div class="flex space-x-4 flex-row justify-end">
						<x-buttons.button-edit href="{{ route('assignment.edit', $assign->id) }}" />
						<x-buttons.button-delete wire:click="confirmDelete({{ $assign->id }})" />
					</div>
				</x-td>
				@endrole
			</tr>
			@empty
			<x-empty-records :colspan="5" />
			@endforelse
		</x-slot>
	</x-table>
	
	@if($assignments->hasPages())
	<div class="mt-4 px-4">
		{{ $assignments->links() }}
	</div>
	@endif


	<x-jet-confirmation-modal wire:model="modal_confirmation">
		<x-slot name="title">{{ __('Konfirmasi Hapus Penugasan') }}</x-slot>
		<x-slot name="content">
			@if ($item)
			<p>{{ __('Anda yakin ingin menghapus data penugasan ') }} <span class="text-red-600 font-medium">{{ $item->user->name ?? '' }}</span> {{ __(' dengan nomor SK ') }} <span class="text-red-600 font-medium">{{ $item->decree }}</span>?</p>
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
