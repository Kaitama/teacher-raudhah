<x-app-layout>
	<x-slot name="header">
		<div class="flex items-center justify-between">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			<x-link href="{{ route('teacher.index') }}">{{ __('Data Guru') }}</x-link> / {{ __('Riwayat Absensi') }}
		</h2>
		@can('r a excel')
		<x-nav-link-settings href="{{route('excel.export', $id)}}">Export Excel</x-nav-link-settings>
		@endcan
	</div>
	</x-slot>
	
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="overflow-hidden">
				@can('r a kumpul')
				@livewire('teacher.history.gathering', ['id' => $id])
				<x-jet-section-border />
				@endcan

				@can('r a absensi')
				@livewire('teacher.history.teaching', ['id' => $id])
				<x-jet-section-border />
				@endcan

				@can('r a penugasan')
				@livewire('teacher.history.assignment', ['id' => $id])
				<x-jet-section-border />
				@endcan
				
				@can('r a perizinan')
				@livewire('teacher.history.permit', ['id' => $id])
				<x-jet-section-border />
				@endcan
				
				@can('r a evaluasi')
				@livewire('teacher.history.evaluation', ['id' => $id])
				<x-jet-section-border />
				@endcan
			</div>
		</div>
	</div>
</x-app-layout>
