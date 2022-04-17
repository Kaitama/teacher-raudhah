<x-app-layout>
	<x-slot name="header">
		<div class="md:flex md:justify-between md:items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				<x-link href="{{ route('teacher.index') }}">{{ __('Data Guru') }}</x-link> / 	<x-link href="{{ route('scoring.index', ['id' => $id]) }}">{{ __('Penilaian Guru') }}</x-link> / {{ __('Ubah') }}
			</h2>
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="overflow-hidden">
			@livewire('scoring.edit.assignment', ['id' => $id, 'score' => $score])
		</div>
	</div>
</div>
</x-app-layout>
