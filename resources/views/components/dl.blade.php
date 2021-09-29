@props(['i'])

@php
		if($i % 2 == 0) $c = 'white'; else $c = 'gray';
@endphp

<div class="bg-{{ $c }}-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
	<dt class="text-sm font-medium text-gray-500">
		{{ $left }}
	</dt>
	<dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
		{{ $right }}
	</dd>
</div>