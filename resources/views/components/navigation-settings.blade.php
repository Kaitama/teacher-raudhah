<div class="flex flex-row space-x-4">
	@if(Auth::user()->nig()->exists())
	<x-nav-link-settings href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.edit')">Profil</x-nav-link-settings>
	@endif
	<x-nav-link-settings href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">Akun</x-nav-link-settings>
</div>