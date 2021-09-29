<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('Data Guru') }}
			</h2>
			<div class="flex flex-col space-y-2 mt-3 md:mt-0 md:space-y-0 md:flex-row md:space-x-2">
				@can('c a guru')
				<x-nav-link-settings href="{{ route('teacher.create') }}" :active="request()->routeIs('teacher.create')">
					{{ __('Daftar NIG') }}
				</x-nav-link-settings>
				@endcan
			</div>
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				@livewire('teacher.index')
			</div>
		</div>
	</div>
</x-app-layout>
