<x-app-layout>
	<x-slot name="header">
		<div class="md:flex md:justify-between md:items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				<x-link href="{{ route('assignment.index') }}">{{ __('Absensi Penugasan') }}</x-link> / {{ __('Tambah Penugasan') }}
			</h2>
			<x-navigation-attendance />
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
			<div class="overflow-hidden">
				@livewire('attendance.assignment.create')
			</div>
		</div>
	</div>
</x-app-layout>
