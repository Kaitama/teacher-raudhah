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
			@role('developer|administrator')
			@livewire('excel.import-data')
			<x-jet-section-border />
			@endrole
			@livewire('excel.export-data')
		</div>
	</div>
</x-app-layout>
