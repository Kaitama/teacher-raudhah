<div class="py-4">
	<div class="px-4 grid justify-items-end">
		<x-jet-button wire:click="$toggle('addNIGModal')">{{ __('Daftarkan NIG Baru') }}</x-jet-button>
	</div>
	
	{{-- Dialog Modal --}}
	<x-jet-dialog-modal wire:model="addNIGModal">
		<x-slot name="title">
			{{ __('Daftarkan NIG') }}
		</x-slot>
		
		<x-slot name="content">
			{{ __('Daftarkan NIG tiap guru sehingga guru dapat mendaftar ulang untuk melengkapi data diri pada akunnya sendiri. Sistem tidak akan menyimpan NIG yang sudah terdaftar.') }}
			
			<div class="text-sm py-2 text-gray-600">
				{{ __('Jika NIG yang didaftarkan lebih dari satu, pisahkan tiap NIG dengan tanda koma.') }}
				<br>
				{{ __('Contoh: 000001, 000002, 000003') }}
			</div>
			<x-textarea class="mt-4 block w-full" id="nigs" wire:model="nigs" placeholder="Nomor Induk Guru" />
			<x-jet-input-error for="nigs" class="mt-2" />
		</x-slot>
		
		<x-slot name="footer">
			<x-modal-action-message class="mr-3" on="saved">
				{{ __('Tersimpan.') }}
			</x-modal-action-message>
			
			<x-jet-secondary-button wire:click="$toggle('addNIGModal')" wire:loading.attr="disabled">
				{{ __('Batal') }}
			</x-jet-secondary-button>
			
			<x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
				{{ __('Simpan') }}
			</x-jet-button>
		</x-slot>
	</x-jet-dialog-modal>
	
	{{-- list nigs --}}
	<x-table class="mt-4 mx-0 md:mx-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Nomor Induk Guru') }}</x-th>
			<x-th>{{ __('Status') }}</x-th>
			<x-th></x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($data as $k => $d)
			<tr>
				<x-td class="text-gray-600">{{ $data->firstItem() + $k }}</x-td>
				<x-td>{{ $d->number }}</x-td>
				<x-td>
					@if ($d->user)
					<x-pill color="green">{{ __('Aktif') }}</x-pill>
					@else
					<x-pill color="gray">{{ __('Pending') }}</x-pill>
					@endif
				</x-td>
				<x-td class="text-right text-sm font-medium">
					<div class="space-x-4">

						<x-buttons.button-edit href="#" />
						
						@if(!$d->user)
						<x-buttons.button-delete />
						@else
						<x-buttons.button-delete disabled="true" class="cursor-default" />
						@endif
					</div>
				</x-td>
			</tr>
			@empty
			<x-empty-records :colspan="4" />
			@endforelse
		</x-slot>
	</x-table>
	
	@if($data->hasPages())
	<div class="mt-4">
		{{ $data->links() }}
	</div>
	@endif
	
</div>
