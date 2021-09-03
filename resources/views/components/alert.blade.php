@props(['on', 'type'])

@php
switch ($type) {
	case 'success':
	$color = 'green';
	$stroke = 'M5 13l4 4L19 7';
	break;
	case 'error':
	$color = 'red';
	$stroke = 'M6 18L18 6M6 6l12 12';
	break;
	case 'warning':
	$color = 'yellow';
	$stroke = 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z';
	break;
	case 'info':
	$color = 'blue';
	$stroke = 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
	break;
	default:
	$color = 'gray';
	$stroke = 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z';
	break;
}
@endphp

<div x-data="{ shown: false, timeout: null }" x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 4000);  })" x-show.transition.opacity.out.duration.1500ms="shown" style="display: none;" {{ $attributes->merge(['class' => 'text-sm text-' . $color . '-600 w-full bg-' . $color . '-50 p-4 my-2 border border-transparent rounded-md flex items-center']) }}>
	<div class="flex-shrink-0 h-10 w-10">
		<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-{{ $color }}-100 sm:mx-0 sm:h-10 sm:w-10">
			<svg class="h-6 w-6 text-{{ $color }}-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stroke }}"/>
			</svg>
		</div>
	</div>
	<div class="ml-4">
		<div class="font-bold">{{ $title }}</div>
		<div>{{ $content }}</div>
	</div>
</div>