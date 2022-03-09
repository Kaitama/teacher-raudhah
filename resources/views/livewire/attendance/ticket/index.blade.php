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
		@can('c a tiket')
		<x-button-link class="mt-4 md:mt-0" href="{{ route('ticket.create') }}">{{ __('Tambah Tiket') }}</x-button-link>
		@endcan
	</div>
	
	
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('Data Guru') }}</x-th>
			<x-th>{{ __('Deskripsi') }}</x-th>
			<x-th></x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($tickets as $k => $ticket)
			<tr>
				<x-td class="text-gray-600">{{ $tickets->firstItem() + $k }}</x-td>
				<x-td>
					<div class="text-gray-900 text-sm font-semibold">{{ $ticket->saved_at->isoFormat('LL') }}</div>
				</x-td>
				<x-td>
					<div class="tex-gray-900 text-sm font-semibold">
						<x-link href="{{ route('teacher.show', $ticket->user->id) }}">{{ $ticket->user->name }}</x-link>
					</div>
					<div class="text-gray-600 text-sm">{{ $ticket->user->nig->number ?? '-' }}</div>
				</x-td>
				<x-td>
					<div class="text-gray-900 text-sm font-semibold">{{ $ticket->session }} {{ __('Les') }}</div>
					<div class="text-gray-600 text-sm">{{ $ticket->description ?? '-' }}</div>
				</x-td>
				<x-td class="text-right text-sm font-medium">
					<div class="flex space-x-4 flex-row justify-end">
						@can('u a tiket')
						<x-buttons.button-edit href="{{ route('ticket.edit', $ticket->id) }}"></x-buttons.button-edit>
						@endcan
						@can('d a tiket')
						<x-buttons.button-delete wire:click="confirmDelete({{ $ticket->id }})"></x-buttons.button-delete>
						@endcan
					</div>
				</x-td>
			</tr>
			@empty
			<x-empty-records :colspan="5" />
			@endforelse
		</x-slot>
	</x-table>
	
	@if($tickets->hasPages())
	<div class="mt-4 px-4">
		{{ $tickets->links() }}
	</div>
	@endif
	
	@can('d a tiket')
	<x-jet-confirmation-modal wire:model="modal_confirmation">
		<x-slot name="title">{{ __('Konfirmasi Hapus Tiket') }}</x-slot>
		<x-slot name="content">
			@if ($item)
			<p>{{ __('Anda yakin ingin menghapus data tiket atas nama ') }} <span class="text-red-600 font-medium">{{ $item->user->name }}</span>?</p>
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
	@endcan
</div>
