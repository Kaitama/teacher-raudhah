<x-description-list>
	<x-slot name="title">{{ __('Detail Kegiatan') }}</x-slot>
	<x-slot name="description">
		{{ __('Detail absensi keguruan pada Kumpul Kamisan atau kegiatan lainnya.') }}
	</x-slot>
	<x-slot name="content">
		@php $i = 1 @endphp
		<x-dl i="{{ $i }}">
			<x-slot name="left">{{ __('Tanggal') }}</x-slot>
			<x-slot name="right">{{ $held_at->isoFormat('LL') }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i="{{ $i }}">
			<x-slot name="left">{{ __('Nama Kegiatan') }}</x-slot>
			<x-slot name="right">{{ $name }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i="{{ $i }}">
			<x-slot name="left">{{ __('Keterangan') }}</x-slot>
			<x-slot name="right">{{ $description ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i="{{ $i }}">
			<x-slot name="left">{{ __('Guru yang Absen') }} ({{ count($teachers ?? []) }})</x-slot>
			<x-slot name="right">
				<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
					@forelse ($teachers as $teacher)
					<li class="pl-3 pr-4 py-3 flex flex-row items-center text-sm">
						<!-- Heroicon name: solid/paper-clip -->
						<img src="{{ $teacher['profile_photo_url'] }}" alt="" class=" rounded-full h-8 w-8" />
						<div class="ml-2 flex flex-col items-start">
							<x-link href="{{ route('teacher.show', $teacher->id) }}" class="text-gray-900 font-semibold text-sm">
								{{ $teacher['name'] }}
							</x-link>
							<div class="text-gray-600 text-sm">{{ $teacher->nig ? $teacher->nig['number'] : '' }}</div>
						</div>
					</li>
					
					@empty
					<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
						{{ __('Tidak ada guru yang absen.') }}
					</li>
					@endforelse
				</ul>
				
			</x-slot>
		</x-dl>
	</x-slot>
</x-description-list>