<div class="flex flex-row space-x-4">
	<x-nav-link-settings href="{{ route('history.attendance') }}" :active="request()->routeIs('history.attendance')">Absensi</x-nav-link-settings>
	
	<x-nav-link-settings href="{{ route('history.scoring') }}" :active="request()->routeIs('history.scoring')">Penilaian</x-nav-link-settings>
</div>