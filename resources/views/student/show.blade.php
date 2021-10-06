<x-app-layout>
	<x-slot name="header">
		<div class="md:flex md:justify-between md:items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				@if(Auth::user()->classroom)<x-link href="{{ route('classroom.index') }}">{{ __('Kelas') }}</x-link> / @endif{{ request()->routeIs('student.show') ? 'Profil' : 'Riwayat' }} {{ __('Santri') }}
			</h2>
			<div class="flex flex-col space-y-2 mt-3 md:mt-0 md:space-y-0 md:flex-row md:space-x-2">
				<x-nav-link-settings href="{{ route('student.show', $id) }}" :active="request()->routeIs('student.show')">
					{{ __('Profil') }}
				</x-nav-link-settings>
				<x-nav-link-settings href="{{ route('student.history', $id) }}" :active="request()->routeIs('student.history')">
					{{ __('Riwayat') }}
				</x-nav-link-settings>
			</div>
		</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			@if(request()->routeIs('student.show'))
			@livewire('student.profile', ['id' => $id])
			@else
			@livewire('student.history', ['id' => $id])
			@endif
		</div>
	</div>
</x-app-layout>
