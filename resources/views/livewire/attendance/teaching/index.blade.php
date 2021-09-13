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
		@can('c a absensi')
		<x-button-link class="mt-4 md:mt-0" href="{{ route('teaching.create') }}">{{ __('Tambah Absensi') }}</x-button-link>
		@endcan
	</div>
	
	
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('Data Guru') }}</x-th>
			<x-th>{{ __('Izin') }}</x-th>
			<x-th></x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($teachings as $k => $teaching)
			<tr>
				<x-td class="text-gray-600">{{ $teachings->firstItem() + $k }}</x-td>
				<x-td>
					<div class="text-gray-900">
						{{ $teaching->signed_at->isoFormat('LL') }}
					</div>
					<div class="text-gray-600 text-sm">
						{{ $teaching->checker ? $teaching->checker->name : ''  }}
					</div>
				</x-td>
				<x-td>
					<div class="tex-gray-900 text-sm font-semibold">
						<x-link href="{{ route('teacher.show', $teaching->user->id) }}">{{ $teaching->user->name }}</x-link>
					</div>
					<div class="text-gray-600 text-sm">{{ $teaching->user->nig->number ?? '-' }}</div>
				</x-td>
				<x-td>
					<div class="text-gray-900 text-sm font-semibold">{{ $categories[$teaching->category] }}</div>
					<div class="text-gray-600 text-sm">{{ $teaching->description ?? '-' }}</div>
				</x-td>
				<x-td class="text-right text-sm font-medium">
					<div class="flex space-x-4 flex-row justify-end">
						@can('u a absensi')
						@if(($teaching->checker && Auth::id() == $teaching->checker->id) || Auth::user()->hasAnyRole(['developer', 'administrator', 'admin akademik']))
						<x-buttons.button-edit href="{{ route('teaching.edit', $teaching->id) }}"></x-buttons.button-edit>
						@endif
						@endcan
						@can('d a absensi')
						@if(($teaching->checker && Auth::id() == $teaching->checker->id) || Auth::user()->hasAnyRole(['developer', 'administrator', 'admin akademik']))
						<x-buttons.button-delete wire:click="confirmDelete({{ $teaching->id }})"></x-buttons.button-delete>
						@endif
						@endcan
					</div>
				</x-td>
			</tr>
			@empty
			<x-empty-records :colspan="5" />
			@endforelse
		</x-slot>
	</x-table>
	
	@if($teachings->hasPages())
	<div class="mt-4 px-4">
		{{ $teachings->links() }}
	</div>
	@endif
	
	@can('d a absensi')
	<x-jet-confirmation-modal wire:model="modal_confirmation">
		<x-slot name="title">{{ __('Konfirmasi Hapus Absensi') }}</x-slot>
		<x-slot name="content">
			@if ($item)
			<p>{{ __('Anda yakin ingin menghapus data absensi ') }} <span class="text-red-600 font-medium">{{ $categories[$item->category] ?? '' }}</span> {{ __(' atas nama ') }} <span class="text-red-600 font-medium">{{ $item->user->name }}</span>?</p>
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
