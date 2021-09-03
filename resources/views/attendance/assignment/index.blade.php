<x-app-layout>
	<x-slot name="header">
		<div class="md:flex md:justify-between md:items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('Absensi Penugasan') }}
			</h2>
			<x-navigation-attendance />
		</div>
	</x-slot>
	
	<div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
			@livewire('attendance.assignment.index')
		</div>
	</div>
</div>
</x-app-layout>
