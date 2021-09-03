<div class="flex flex-col space-y-2 mt-3 md:mt-0 md:space-y-0 md:flex-row md:space-x-2">
				
	<x-nav-link-settings href="{{ route('gathering.index') }}" :active="request()->routeIs('gathering.*')">
		{{ __('Kumpul') }}
	</x-nav-link-settings>
	
	<x-nav-link-settings href="{{ route('permit.index') }}" :active="request()->routeIs('permit.*')">Perizinan</x-nav-link-settings>

	<x-nav-link-settings href="{{ route('assignment.index') }}" :active="request()->routeIs('assignment.*')">Penugasan</x-nav-link-settings>

	<x-nav-link-settings href="{{ route('teaching.index') }}" :active="request()->routeIs('teaching.*')">Mengajar</x-nav-link-settings>

	<x-nav-link-settings href="{{ route('evaluation.index') }}" :active="request()->routeIs('evaluation.*')">Evaluasi</x-nav-link-settings>
</div>