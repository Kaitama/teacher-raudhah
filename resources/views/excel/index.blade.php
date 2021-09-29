<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('Export / Import Data') }}
			</h2>
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
			@can('c a excel')
			<div class="mb-8 md:mb-0">
				@livewire('excel.import-data')
			</div>
			<x-jet-section-border />
			<div class="mb-8 md:mb-0">
				@livewire('excel.import-scoring')
			</div>
			<x-jet-section-border />
			@endcan
			@can('u a guru')
			<div class="mb-8 md:mb-0">
				@livewire('teacher.setclass')
			</div>
			<x-jet-section-border />
			@endcan
			<div class="mb-8 md:mb-0">
				@livewire('excel.export-data')
			</div>
		</div>
	</div>
</x-app-layout>
