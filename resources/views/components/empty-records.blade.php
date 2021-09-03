@props(['colspan'])

<tr>
	<x-td colspan="{{ $colspan }}">
		<div class="text-gray-600 text-sm italic">
			{{ __('Data tidak ditemukan atau masih kosong.') }}
		</div>
	</x-td>
</tr>