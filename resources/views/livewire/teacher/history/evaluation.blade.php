<div class="py-4">
	<div class="px-4">
		<h1 class="text-xl text-left">{{ __('Evaluasi') }}</h1>
		<div class="text-gray-600">{{ __('Riwayat evaluasi') }} {{ $user->name }} {{ __('selama di pesantren.') }}</div>
	</div>
	
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>#</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('No. SK') }}</x-th>
			<x-th>{{ __('Evaluasi') }}</x-th>
			<x-th>{{ __('Keterangan') }}</x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($evaluations as $k => $eval)
			<tr>
				<x-td>{{ $evaluations->firstItem() + $k }}</x-td>
				<x-td>{{ $eval->signed_at->isoFormat('LL') }}</x-td>
				<x-td>{{ $eval->decree ?? '-' }}</x-td>
				<x-td>{{ $categories[$eval->category] }}</x-td>
				<x-td>{{ $eval->description ?? '-' }}</x-td>
			</tr>
			@empty
			<tr>
				<x-empty-records :colspan="5" />
			</tr>
			@endforelse
		</x-slot>
	</x-table>
	@if($evaluations->hasPages())
	<div class="mt-4 px-4">
		{{ $evaluations->links() }}
	</div>
	@endif
</div>
