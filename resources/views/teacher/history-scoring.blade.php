<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Riwayat Penilaian') }}
		</h2>
		<x-navigation-history />
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="overflow-hidden">
				@livewire('scoring.index', ['id' => Auth::id()])
				<x-jet-section-border />
				
			</div>
		</div>
	</div>
</x-app-layout>
