<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				@role('guru')
				@livewire('dashboard.index', ['user' => Auth::user()])
				@else
				
				<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
					
					<div class="mt-4">
						<div class="grid grid-cols-1 md:grid-cols-2">
							<div class="flex items-center">
								<img class="rounded-full w-16" src="{{ Auth::user()->profile_photo_url }}" alt="">
								<div class="ml-4 text-2xl">
									<x-link class="font-bold">{{ Auth::user()->name }}</x-link>
									<div class="text-xl text-gray-600">
										{{ Auth::user()->email }}
									</div>
								</div>
							</div>
							<div class="flex pt-4 md:pt-0 items-center md:justify-end text-gray-600 text-sm">
								<x-button-link-secondary :disabled="true">
									@foreach (Auth::user()->getRoleNames() as $role)
											{{ $role }} - 
									@endforeach
								</x-button-link-secondary>
							</div>
						</div>
						
					</div>
				</div>
				
				@endrole
			</div>
		</div>
	</div>
</x-app-layout>
