<div class="flex flex-col space-y-2 mt-3 md:mt-0 md:space-y-0 md:flex-row md:space-x-2">
	
	@can('r a kumpul')
	<x-nav-link-settings href="{{ route('gathering.index') }}" :active="request()->routeIs('gathering.*')">
		{{ __('Kumpul') }}
	</x-nav-link-settings>
	@endcan
	
	@can('r a perizinan')
	<x-nav-link-settings href="{{ route('permit.index') }}" :active="request()->routeIs('permit.*')">{{ __('Perizinan') }}</x-nav-link-settings>
	@endcan
	
	@can('r a penugasan')
	<x-nav-link-settings href="{{ route('assignment.index') }}" :active="request()->routeIs('assignment.*')">{{ __('Penugasan') }}</x-nav-link-settings>
	@endcan
	
	@can('r a absensi')
	<x-nav-link-settings href="{{ route('teaching.index') }}" :active="request()->routeIs('teaching.*')">{{ __('Mengajar') }}</x-nav-link-settings>
	@endcan
	
	@can('r a evaluasi')
	<x-nav-link-settings href="{{ route('evaluation.index') }}" :active="request()->routeIs('evaluation.*')">{{ __('Evaluasi') }}</x-nav-link-settings>
	@endcan

	@can('r a tiket')
	<x-nav-link-settings href="{{ route('ticket.index') }}" :active="request()->routeIs('ticket.*')">{{ __('Tiket') }}</x-nav-link-settings>
	@endcan
	
</div>