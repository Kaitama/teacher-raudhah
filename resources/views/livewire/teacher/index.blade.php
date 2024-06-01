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
{{--							@php--}}
{{--							if($teacher->profile_photo_path) $img = url('storage/' . $teacher->profile_photo_path);--}}
{{--							elseif ($teacher->photo) $img = 'https://sisfo.raudhah.ac.id/assets/img/user/' . $teacher->photo;--}}
{{--							else $img = url('img/nopic.png');--}}
{{--							@endphp--}}
							<img class="h-10 w-10 rounded-full" src="{{ $teacher->photo_url }}" alt="">
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
						<x-jet-secondary-button type="button" wire:click="setTeacher({{ $teacher->id }})">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
							</svg>
							{{ __('Rapor') }}
						</x-jet-secondary-button>
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

	@if($guru)
	<x-jet-dialog-modal wire:model="modalOptions">
		<x-slot name="title">{{ __('Download Rapor') }} {{ ucwords(strtolower($guru->name ?? '')) }}</x-slot>
		<x-slot name="content">
			<div class="mb-3">
				<label>{{ __('Mulai Tanggal') }}</label>
				<x-jet-input type="text" wire:model.lazy="started" class="w-full mt-1" />
			</div>
			<div class="mb-3">
				<label>{{ __('Sampai Tanggal') }}</label>
				<x-jet-input type="text" wire:model.lazy="ended" class="w-full" />
			</div>
		</x-slot>
		<x-slot name="footer">
		<x-jet-secondary-button wire:click="$toggle('modalOptions')">{{ __('Cancel') }}</x-jet-secondary-button>
		<x-jet-button type="button" wire:click="printing">{{ __('Download') }}</x-jet-button>
		</x-slot>
	</x-jet-dialog-modal>
	@endif
</div>
