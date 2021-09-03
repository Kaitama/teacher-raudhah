<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			@hasanyrole('developer|administrator|supervisor')
			<x-link href="{{ route('teacher.index') }}">{{ __('Data Guru') }}</x-link> / 
			@endhasanyrole
			{{ __('Profil') }}
		</h2>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="overflow-hidden">
				@livewire('teacher.show', ['id' => $id])
			</div>
		</div>
	</div>
</x-app-layout>
