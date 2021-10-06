<div class="mt-5 sm:mt-0">
	<x-profile-panel>
		<x-slot name="title">
			{{ __('Perizinan') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Riwayat perizinan ') . ucwords(strtolower($student->name)) }}
		</x-slot>
		
		<x-slot name="content">
			<div class="col-span-6">
				<x-table>		
					<x-slot name="th">
						<x-th>{{ __('#') }}</x-th>
						<x-th>{{ __('Tanggal') }}</x-th>
						<x-th>{{ __('Keterangan') }}</x-th>
					</x-slot>
					<x-slot name="td">
						@forelse ($permits as $k => $pe)
						<tr>
							<x-td>{{ $permits->firstItem() + $k }}</x-td>
							<x-td>
								{{ $pe->signdate->isoFormat('LL') }}
								<div class="text-sm text-gray-500">{{ $pe->datefrom->diffInDays($pe->dateto)}} Hari</div>
							</x-td>
							<x-td>
								<div class="font-semibold">{{ $pe->reason }}</div>
								<div class="text-sm text-gray-500">{{ $pe->description ?? '-' }}</div>
							</x-td>
						</tr>
						@empty
						<tr>
							<x-td colspan="3">{{ __('Data masih kosong.') }}</x-td>
						</tr>
						@endforelse
						@if($permits->hasPages())
						<tr>
							<x-td colspan="3">
								{{ $permits->links('vendor.livewire.simple-tailwind') }}
							</x-td>
						</div>
						@endif
					</x-slot>
				</x-table>
				
			</div>
		</x-slot>
	</x-profile-panel>
</div>
