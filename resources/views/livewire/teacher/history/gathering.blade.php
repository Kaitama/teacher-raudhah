<div class="py-4">
	<div class="px-4">
		<h1 class="text-xl text-left">{{ __('Absensi Kegiatan') }}</h1>
		<div class="text-gray-600">{{ __('Riwayat absensi ketidak-hadiran') }} {{ $user->name }} {{ __('pada kegiatan pesantren.') }}</div>
	</div>
	
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>#</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('Kegiatan') }}</x-th>
			<x-th>{{ __('Keterangan') }}</x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($gatherings as $k => $gath)
			<tr>
				<x-td>{{ $gatherings->firstItem() + $k }}</x-td>
				<x-td>{{ $gath->held_at->isoFormat('LL') }}</x-td>
				<x-td>{{ $gath->name }}</x-td>
				<x-td>{{ $gath->description ?? '-' }}</x-td>
			</tr>
			@empty
			<tr>
				<x-empty-records :colspan="4" />
			</tr>
			@endforelse
		</x-slot>
	</x-table>
	@if($gatherings->hasPages())
	<div class="mt-4 px-4">
		{{ $gatherings->links() }}
	</div>
	@endif
</div>
