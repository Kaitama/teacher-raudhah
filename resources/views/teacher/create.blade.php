<x-app-layout>
	<x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				<x-link href="{{ route('teacher.index') }}">{{ __('Data Guru') }}</x-link> / {{ __('Daftar NIG') }}
			</h2>
	</x-slot>

	<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
					<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
							@livewire('teacher.create')
					</div>
			</div>
	</div>
</x-app-layout>
