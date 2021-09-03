<div {{ $attributes->merge(['class' => 'p-6']) }}>
	<div class="flex items-center">
			<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
				{{ $svgpath }}
			</svg>
			<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
				{{ $title }}
			</div>
	</div>

	<div class="ml-12">
			<div class="mt-2 text-sm text-gray-500">
					{{ $content }}
			</div>
	</div>
</div>