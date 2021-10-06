<div class="mt-5 sm:mt-0">
	<x-profile-panel>
		<x-slot name="title">
			{{ __('Ekstrakurikuler') }}
		</x-slot>
		
		<x-slot name="description">
			{{ __('Riwayat ekstrakurikuler ') . ucwords(strtolower($student->name)) }}
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
						@forelse ($extracurriculars as $k => $ex)
						<tr>
							<x-td>{{ $extracurriculars->firstItem() + $k }}</x-td>
							<x-td>
								{{ \Carbon\Carbon::parse($ex->extracurricular_student->joindate)->isoFormat('LL') }}
								<div class="text-sm text-gray-500">{{ $ex->extracurricular_student->isactive ? 'Aktif' : 'Nonaktif' }}</div>
							</x-td>
							<x-td>
								<div class="font-semibold">{{ $ex->name ?? '-' }}</div>
								<div class="text-sm text-gray-500">{{ $ex->description ?? '-' }}</div>
							</x-td>
						</tr>
						@empty
						<tr>
							<x-td colspan="3">{{ __('Data masih kosong.') }}</x-td>
						</tr>
						@endforelse
						@if($extracurriculars->hasPages())
						<tr>
							<x-td colspan="3">
								{{ $extracurriculars->links('vendor.livewire.simple-tailwind') }}
							</x-td>
						</div>
						@endif
					</x-slot>
				</x-table>
				
			</div>
		</x-slot>
	</x-profile-panel>
</div>
