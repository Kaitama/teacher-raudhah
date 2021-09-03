<x-app-layout>
	<x-slot name="header">
		<div class="md:flex md:justify-between md:items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				<x-link href="{{ route('teaching.index') }}">{{ __('Absensi Mengajar') }}</x-link> / {{ __('Ubah Absensi') }}
			</h2>
			<x-navigation-attendance />
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="overflow-hidden">
				@livewire('attendance.teaching.edit', ['id' => $id])
			</div>
		</div>
	</div>
</x-app-layout>
