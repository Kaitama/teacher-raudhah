<div class="py-4">
	<div class="px-4">
		<h1 class="text-xl text-left">{{ __('Penugasan') }}</h1>
		<div class="text-gray-600">{{ __('Riwayat penugasan') }} {{ $user->name }} {{ __('pada struktural / fungsional pesantren.') }}</div>
	</div>
	
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>#</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('No. SK') }}</x-th>
			<x-th>{{ __('Tugas') }}</x-th>
			<x-th>{{ __('Keterangan') }}</x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($assignments as $k => $assign)
			<tr>
				<x-td>{{ $assignments->firstItem() + $k }}</x-td>
				<x-td>{{ $assign->signed_at->isoFormat('LL') }}</x-td>
				<x-td>{{ $assign->decree ?? '-' }}</x-td>
				<x-td>{{ $categories[$assign->category] }}</x-td>
				<x-td>{{ $assign->description ?? '-' }}</x-td>
			</tr>
			@empty
			<tr>
				<x-empty-records :colspan="5" />
			</tr>
			@endforelse
		</x-slot>
	</x-table>
	@if($assignments->hasPages())
	<div class="mt-4 px-4">
		{{ $assignments->links() }}
	</div>
	@endif
</div>
