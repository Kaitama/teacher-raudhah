<div class="mt-5 sm:mt-0">
	<x-profile-panel>
		<x-slot name="title">
			{{ __('Organisasi') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Riwayat organisasi ') . ucwords(strtolower($student->name)) }}
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
						@forelse ($organizations as $k => $or)
						<tr>
							<x-td>{{ $organizations->firstItem() + $k }}</x-td>
							<x-td>
								{{ \Carbon\Carbon::parse($or->organization_student->joindate)->isoFormat('LL') }}
								<div class="text-sm text-gray-500">{{ $positions[$or->organization_student->position] }}</div>
							</x-td>
							<x-td>
								<div class="font-semibold">{{ $or->name ?? '-' }}</div>
								<div class="text-sm text-gray-500">{{ $or->organization_student->description ?? '-' }}</div>
							</x-td>
						</tr>
						@empty
						<tr>
							<x-td colspan="3">{{ __('Data masih kosong.') }}</x-td>
						</tr>
						@endforelse
						@if($organizations->hasPages())
						<tr>
							<x-td colspan="3">
								{{ $organizations->links('vendor.livewire.simple-tailwind') }}
							</x-td>
						</div>
						@endif
					</x-slot>
				</x-table>
				
			</div>
		</x-slot>
	</x-profile-panel>
</div>
