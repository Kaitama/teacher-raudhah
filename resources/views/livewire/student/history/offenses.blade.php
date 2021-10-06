<div class="mt-5 sm:mt-0">
	<x-profile-panel>
		<x-slot name="title">
			{{ __('Pelanggaran') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Riwayat pelanggaran ') . ucwords(strtolower($student->name)) }}
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
						@forelse ($offenses as $k => $of)
						<tr>
							<x-td>{{ $offenses->firstItem() + $k }}</x-td>
							<x-td>
								{{ $of->date->isoFormat('LL') }}
								<div class="text-sm text-gray-500">{{ $of->name }}</div>
							</x-td>
							<x-td>
								<div class="font-semibold">{{ __('Hukuman:') }} {{ $of->punishment ?? '-' }}</div>
								<div class="text-sm text-gray-500">{{ $of->description ?? '-' }}</div>
							</x-td>
						</tr>
						@empty
						<tr>
							<x-td colspan="3">{{ __('Data masih kosong.') }}</x-td>
						</tr>
						@endforelse
						@if($offenses->hasPages())
						<tr>
							<x-td colspan="3">
								{{ $offenses->links('vendor.livewire.simple-tailwind') }}
							</x-td>
						</div>
						@endif
					</x-slot>
				</x-table>
				
			</div>
		</x-slot>
	</x-profile-panel>
</div>
