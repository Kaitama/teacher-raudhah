<x-app-layout>
	<x-slot name="header">
		<div class="md:flex md:justify-between md:items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				<x-link href="{{ route('teacher.index') }}">{{ __('Data Guru') }}</x-link> / 	{{ __('Penilaian Guru') }}
			</h2>
			<div class="space-x-4">
				@role('developer|administrator')
				<x-nav-link-settings href="{{ route('scoring.create', ['id' => $id]) }}">{{ __('Tambah Penilaian') }}</x-nav-link-settings>
				@endrole
				@role('developer|administrator|supervisor')
				<x-nav-link-settings href="{{ route('excel.nilai', $id) }}">{{ __('Export Excel') }}</x-nav-link-settings>
				@endrole
			</div>
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="overflow-hidden">
				@livewire('scoring.index', ['id' => $id])
			</div>
		</div>
	</div>
</x-app-layout>
