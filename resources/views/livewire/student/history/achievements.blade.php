<div class="mt-5 sm:mt-0">
	<x-profile-panel>
		<x-slot name="title">
			{{ __('Prestasi') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Riwayat prestasi ') . ucwords(strtolower($student->name)) }}
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
						@forelse ($achievements as $k => $ac)
						<tr>
							<x-td>{{ $achievements->firstItem() + $k }}</x-td>
							<x-td>
								{{ $ac->date->isoFormat('LL') }}
								@if($ac->rank)<div class="text-sm text-gray-500">{{ __('Peringkat') }} {{ $ac->rank }}</div>@endif
							</x-td>
							<x-td>
								<div class="font-semibold">{{ $ac->name }}</div>
								<div class="text-sm text-gray-500">{{ $ac->description ?? '-' }}</div>
							</x-td>
						</tr>
						@empty
						<tr>
							<x-td colspan="3">{{ __('Data masih kosong.') }}</x-td>
						</tr>
						@endforelse
						@if($achievements->hasPages())
						<tr>
							<x-td colspan="3">
								{{ $achievements->links('vendor.livewire.simple-tailwind') }}
							</x-td>
						</div>
						@endif
					</x-slot>
				</x-table>
				
			</div>
		</x-slot>
	</x-profile-panel>
</div>
