<x-profile-panel>
	<x-slot name="title">
		{{ __('Uang Sekolah') }}
	</x-slot>
	
	<x-slot name="description">
		{{ __('Riwayat pembayaran uang sekolah ') . ucwords(strtolower($student->name)) }}
	</x-slot>
	
	<x-slot name="content">
		<div class="col-span-6">
			<x-table>		
				<x-slot name="th">
					<x-th>{{ __('#') }}</x-th>
					<x-th>{{ __('Tgl. Pembayaran') }}</x-th>
					<x-th>{{ __('Pembayaran Bulan') }}</x-th>
				</x-slot>
				<x-slot name="td">
					@forelse ($tuitions as $k => $tu)
					<tr>
						<x-td>{{ $tuitions->firstItem() + $k }}</x-td>
						<x-td>{{ $tu->paydate->isoFormat('LL') }}</x-td>
						<x-td>
							@if($tu->formonth > 99 || $tu->foryear > 3000)
							{{ $tu->formonth }} / {{ $tu->foryear }}
							@else
							{{ \Carbon\Carbon::createFromDate($tu->foryear, $tu->formonth, 1)->monthName }} {{ $tu->foryear }}
							@endif
						</x-td>
					</tr>
					@empty
					<tr>
						<x-td colspan="3">{{ __('Data masih kosong.') }}</x-td>
					</tr>
					@endforelse
					@if($tuitions->hasPages())
					<tr>
						<x-td colspan="3">
							{{ $tuitions->links('vendor.livewire.simple-tailwind') }}
						</x-td>
					</div>
					@endif
				</x-slot>
			</x-table>
			
		</div>
	</x-slot>
</x-profile-panel>