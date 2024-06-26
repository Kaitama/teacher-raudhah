@props(['dark' => false])

@php

if ($dark) {
	$themeClasses = 'bg-gray-900 text-white border-gray-800';
} else {
	$themeClasses = 'bg-gray-50 text-gray-800 border-gray-200';
}


@endphp

<span class="tooltip rounded shadow-lg px-4 py-2 border {{ $themeClasses }} -mt-10 -ml-5">
	<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $dark ? 'text-gray-900' : 'text-gray-50' }} absolute -bottom-2" viewBox="0 0 20 20" fill="currentColor">
		<path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
	</svg>
	{{ $slot }}
</span>