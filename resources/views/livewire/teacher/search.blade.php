<div class="mt-1 relative">
	<div class="">
		<x-jet-input type="text" placeholder="Cari disini.." class="relative w-full" wire:model="search" />
		@if($search)
		<button type="button" class="absolute z-10 right-1 top-1 rounded-full bg-gray-100 hover:bg-gray-200 p-2" wire:click="clearSearch">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>
		@endif
	</div>
	@if(!empty($teachers))
	<ul class="relative z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label">
		<!--
			Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.
			
			Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
		-->
		@forelse($teachers as $k => $teacher)
		<li class="text-gray-900 cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-gray-100" id="listbox-option-{{$k}}" role="option" @if(!in_array($teacher->id, $ids)) wire:click="sendTeacher({{ $teacher->id }})" @endif>
			<div class="flex items-center">
				<img src="{{ $teacher->profile_photo_url }}" alt="" class="flex-shrink-0 h-6 w-6 rounded-full">
				<!-- Selected: "font-semibold", Not Selected: "font-normal" -->
				<span class="font-normal ml-3 block truncate">
					{{ $teacher->name }}
				</span>
			</div>
			
			<!--
				Checkmark, only display for selected option.
				
				Highlighted: "text-white", Not Highlighted: "text-indigo-600"
			-->
			@if (in_array($teacher->id, $ids))
			
			<span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
				<!-- Heroicon name: solid/check -->
				<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
				</svg>
			</span>
			@endif
		</li>
		
		@empty
		<li class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9" id="listbox-option-1" role="option">
			<div class="flex items-center">
				<span class="font-normal italic ml-3 block truncate text-gray-600">
					{{ __('Tidak ada data ditemukan.') }}
				</span>
			</div>
		</li>
		@endforelse
		<!-- More items... -->
	</ul>
	@endif
	
</div>
