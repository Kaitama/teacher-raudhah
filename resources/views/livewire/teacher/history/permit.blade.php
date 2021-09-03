<div class="py-4">
	<div class="px-4">
		<h1 class="text-xl text-left">{{ __('Absensi Perizinan') }}</h1>
		<div class="text-gray-600">{{ __('Riwayat perizinan') }} {{ $user->name }} {{ __('selama di pesantren.') }}</div>
	</div>
	
	
	<x-table class="mt-4 px-0 md:px-4">
		
		<x-slot name="th">
			<x-th>#</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			<x-th>{{ __('Alasan') }}</x-th>
			<x-th>{{ __('Durasi') }}</x-th>
			<x-th>{{ __('Keterangan') }}</x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($permits as $k => $perm)
			<tr>
				<x-td>{{ $permits->firstItem() + $k }}</x-td>
				<x-td>{{ $perm->signed_at->isoFormat('LL') }}</x-td>
				<x-td>{{ $categories[$perm->category] }}</x-td>
				<x-td>{{ $perm->started_at->format('d/m/Y') }} - {{ $perm->ended_at->format('d/m/Y') }}</x-td>
				<x-td>{{ $perm->description ?? '-' }}</x-td>
			</tr>
			@empty
			<tr>
				<x-empty-records :colspan="5" />
			</tr>
			@endforelse
		</x-slot>
	</x-table>
	@if($permits->hasPages())
	<div class="mt-4 px-4">
		{{ $permits->links() }}
	</div>
	@endif
</div>
