<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('Permission Setting') }}
			</h2>
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
			@livewire('developer.permission.index')
		</div>
	</div>
</x-app-layout>
