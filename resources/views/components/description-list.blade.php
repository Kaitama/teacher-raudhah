<div class="bg-white shadow overflow-hidden sm:rounded-lg">
	<div class="flex justify-between items-center">
		<div class="px-4 py-5 sm:px-6">
			<h3 class="text-lg leading-6 font-medium text-gray-900">
				{{ $title }}
			</h3>
			<p class="mt-1 max-w-2xl text-sm text-gray-500">
				{{ $description }}
			</p>
		</div>
		<div class="px-6">
			{{ $button ?? null }}
		</div>
	</div>
	<div class="border-t border-gray-200">
		<dl>
			{{ $content }}
		</dl>
	</div>
</div>