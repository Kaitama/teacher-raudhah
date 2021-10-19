<div class="py-4">
	
	<div class="px-4">
		<x-alert type="{{ $alert['type'] ?? '' }}" on="deleted">
			<x-slot name="title">{{ $alert['title'] ?? '' }}</x-slot>
			<x-slot name="content">{{ $alert['message'] ?? '' }}</x-slot>
		</x-alert>
	</div>
	
	<div class="px-4 flex flex-col space-y-2 md:space-y-0 md:flex-row md:items-center items-end md:justify-between">
		
		<div class="flex flex-row space-x-2">
			<x-select wire:model="perpage" class="w-1/8">
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</x-select>
			<x-select wire:model="select_gender" class="w-40">
				<option value="">{{ __('Semua Guru') }}</option>
				<option value="1">{{ __('Laki-laki') }}</option>
				<option value="2">{{ __('Perempuan') }}</option>
			</x-select>
			<x-jet-button type="button" wire:click="exportExcel" class="block bg-green-600 hover:bg-green-700 w-full active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring-green-200">{{ __('Export Excel') }}</x-jet-button>
		</div>
		<x-jet-input type="text" class="block w-full md:w-96" placeholder="Cari disini.." wire:model="search" />
	</div>
	
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Nama Lengkap') }}</x-th>
			<x-th>{{ __('Kontak') }}</x-th>
			<x-th>{{ __('Kelas') }}</x-th>
			<x-th></x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($teachers as $k => $teacher)
			<tr>
				<x-td class="text-gray-600">{{ $teachers->firstItem() + $k }}</x-td>
				<x-td>
					<div class="flex items-center">
						<div class="flex-shrink-0 h-10 w-10">
							@php
							if($teacher->profile_photo_path) $img = url('storage/' . $teacher->profile_photo_path);
							elseif ($teacher->photo) $img = 'https://sisfo.raudhah.ac.id/assets/img/user/' . $teacher->photo;
							else $img = $teacher->profile_photo_url;
							@endphp
							<img class="h-10 w-10 rounded-full" src="{{ $img }}" alt="">
						</div>
						<div class="ml-4">
							<div class="text-sm font-medium text-gray-900">
								<x-link class="font-bold" href="{{ route('teacher.show', $teacher->id) }}">{{ ucwords(strtolower($teacher->name)) }}</x-link>
							</div>
							<div class="text-sm text-gray-500">
								{{ $teacher->nig ? $teacher->nig->number : '' }}
							</div>
						</div>
					</div>
				</x-td>
				<x-td>
					<div class="text-sm text-gray-900">{{ $teacher->profile->phone ?? '-' }}</div>
					<div class="text-sm text-gray-500">{{ $teacher->email }}</div>
				</x-td>
				<x-td>
					@if($teacher->classroom)
					<x-link href="{{ route('classroom.show', $teacher->classroom->id) }}" class="text-sm font-semibold">{{ $teacher->classroom->name }}</x-link>
					@else
					<div class="text-sm text-gray-900">-</div>
					@endif
				</x-td>
				<x-td class="text-right text-sm font-medium">
					<div class="flex items-center justify-end space-x-2">
						@can('m a absensi')
						<x-button-link-secondary href="{{ route('teacher.history.index', $teacher->id) }}">{{ __('Absensi') }}</x-button-link-secondary>
						@endcan

						@can('m a penilaian')
						<x-button-link-secondary href="{{ route('scoring.index', $teacher->id) }}">{{ __('Penilaian') }}</x-button-link-secondary>
						@endcan
						
						@can('r a guru')
						<x-buttons.button-profile href="{{ route('teacher.show', $teacher->id) }}"></x-buttons.button-profile>
						@endcan
					</div>
				</x-td>
			</tr>
			@empty
			<x-empty-records :colspan="5" />
			@endforelse
		</x-slot>
	</x-table>
	
	@if($teachers->hasPages())
	<div class="mt-4 px-4">
		{{ $teachers->links() }}
	</div>
	@endif
	
</div>
