<x-app-layout>
	<x-slot name="header">
		<div class="md:flex md:justify-between md:items-center">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Riwayat Absensi') }}
		</h2>
		<x-navigation-history />
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="overflow-hidden">
				@livewire('teacher.history.gathering', ['id' => Auth::id()])
				<x-jet-section-border />
				@livewire('teacher.history.teaching', ['id' => Auth::id()])
				<x-jet-section-border />
				@livewire('teacher.history.assignment', ['id' => Auth::id()])
				<x-jet-section-border />
				@livewire('teacher.history.permit', ['id' => Auth::id()])
				<x-jet-section-border />
				@livewire('teacher.history.evaluation', ['id' => Auth::id()])
			</div>
		</div>
	</div>
</x-app-layout>
