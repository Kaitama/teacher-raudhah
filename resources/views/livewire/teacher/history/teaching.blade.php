<div class="py-4">
	<div class="px-4">
		<h1 class="text-xl text-left">{{ __('Absensi Mengajar') }}</h1>
		<div class="text-gray-600">{{ __('Riwayat absensi') }} {{ $user->name }} {{ __('pada kegiatan belajar mengajar.') }}</div>
	</div>
	
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>#</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('Alasan') }}</x-th>
			<x-th>{{ __('Keterangan') }}</x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($teachings as $k => $teach)
			<tr>
				<x-td>{{ $teachings->firstItem() + $k }}</x-td>
				<x-td>{{ $teach->signed_at->isoFormat('LL') }}</x-td>
				<x-td>{{ $categories[$teach->category] }}</x-td>
				<x-td>{{ $teach->description ?? '-' }}</x-td>
			</tr>
			@empty
			<tr>
				<x-empty-records :colspan="4" />
			</tr>
			@endforelse
		</x-slot>
	</x-table>
	@if($teachings->hasPages())
	<div class="mt-4 px-4">
		{{ $teachings->links() }}
	</div>
	@endif
</div>
