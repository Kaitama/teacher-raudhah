<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('Pengaturan') }}
			</h2>
			<x-navigation-settings />
		</div>
	</x-slot>
	
	<div>
		<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
			@livewire('setting.profile', ['user' => Auth::user()])
		</div>
	</div>
</x-app-layout>