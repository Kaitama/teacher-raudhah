<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
	
	<x-card-panel>
		<x-slot name="svgpath">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
		</x-slot>
		<x-slot name="title">{{ __('Absensi Kumpul') }}</x-slot>
		<x-slot name="content">
			@if($gathering)
			Anda terakhir absen pada kegiatan <span class="font-semibold">{{ $gathering->name }}</span> di tanggal <span class="font-semibold">{{ $gathering->held_at->isoFormat('LL') }}</span>.
			<br>
			Keterangan: {{ $gathering->description ?? '-' }}
			@else
			Anda belum pernah absen pada kegiatan apapun.
			@endif
		</x-slot>
	</x-card-panel>
	
	
	<x-card-panel class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
		<x-slot name="svgpath">
			<path d="M12 14l9-5-9-5-9 5 9 5z" />
			<path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
		</x-slot>
		<x-slot name="title">{{ __('Absensi Pengajaran') }}</x-slot>
		<x-slot name="content">
			@if($teaching)
			Anda terakhir <span class="font-semibold">{{ $teaching_options[$teaching->category] }}</span> pada tanggal <span class="font-semibold">{{ $teaching->signed_at->isoFormat('LL') }}</span>.
			<br>
			Keterangan: {{ $teaching->description ?? '-' }}
			@else
			Anda belum pernah absen saat mengajar di kelas.
			@endif
		</x-slot>
	</x-card-panel>
	
	<x-card-panel class="p-6 border-t border-gray-200">
		<x-slot name="svgpath">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
		</x-slot>
		<x-slot name="title">{{ __('Absensi Perizinan') }}</x-slot>
		<x-slot name="content">
			@if($permit)
			Anda terakhir kali izin karena <span class="font-semibold">{{ $permit_options[$permit->category] }}</span> dari tanggal <span class="font-semibold">{{ $permit->started_at->isoFormat('LL') }}</span> sampai tanggal <span class="font-semibold">{{ $permit->ended_at->isoFormat('LL') }}</span>.
			<br>
			Keterangan: {{ $permit->description ?? '-' }}
			@else
			Anda belum pernah izin keluar dari pesantren.
			@endif
		</x-slot>
	</x-card-panel>
	
	
	<x-card-panel class="p-6 border-t border-gray-200 md:border-l">
		<x-slot name="svgpath">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
		</x-slot>
		<x-slot name="title">{{ __('Absensi Penugasan') }}</x-slot>
		<x-slot name="content">
			@if($assignment)
			Anda terakhir ditugaskan sebagai <span class="font-semibold">{{ $assignment_options[$assignment->category] }}</span> pada tanggal <span class="font-semibold">{{ $assignment->signed_at->isoFormat('LL') }}</span>. Mulai tanggal {{ $assignment->started_at->isoFormat('LL') }} sampai {{ $assignment->ended_at->isoFormat('LL') }}.
			<br>
			Keterangan: {{ $assignment->description ?? '-' }}
			@else
			Anda belum pernah mendapatkan penugasan apapun.
			@endif
		</x-slot>
	</x-card-panel>

	
	<x-card-panel class="p-6 border-t border-gray-200 md:col-span-2">
		<x-slot name="svgpath">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
		</x-slot>
		<x-slot name="title">{{ __('Evaluasi') }}</x-slot>
		<x-slot name="content">
			@if($evaluation)
			Anda terakhir mendapatkan <span class="font-semibold">{{ $evaluation_options[$evaluation->category] }}</span> pada tanggal <span class="font-semibold">{{ $evaluation->signed_at->isoFormat('LL') }}</span> dengan nomor surat <span class="font-semibold">{{ $evaluation->decree ?? '-' }}</span>.
			<br>
			Keterangan: {{ $evaluation->description ?? '-' }}
			@else
			Anda belum pernah mendapatkan evaluasi apapun.
			@endif
		</x-slot>
	</x-card-panel>

	{{-- scoring teaching --}}
	<x-card-panel class="p-6 border-t border-gray-200">
		<x-slot name="svgpath">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
		</x-slot>
		<x-slot name="title">{{ __('Penilaian Keguruan') }}</x-slot>
		<x-slot name="content">
			@if($teachingscore)
			<div class="font-semibold text-base">Penilaian terakhir tanggal {{ $teachingscore->scored_at->isoFormat('LL') }}</div>
			<div class="text-sm">
				Keterangan: {{ $teachingscore->description ?? '-' }}
				</div>
			<div class="border-t border-gray-200 mt-2">
				@foreach ($teach_options as $k => $opt)
				<dl>
					<div class="bg-gray-50 px-0 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
						<dt class="text-sm font-medium text-gray-500 sm:col-span-2">
							{{ $opt }}
						</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:mt-0">
							{{ $teachingscore->$k }}
						</dd>
					</div>
				</dl>
				@endforeach
			</div>
			@else
			Anda belum pernah mendapatkan penilaian apapun.
			@endif
		</x-slot>
	</x-card-panel>
	
	{{-- scoring management --}}
	<x-card-panel class="p-6 border-t border-gray-200 md:border-l">
		<x-slot name="svgpath">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
		</x-slot>
		<x-slot name="title">{{ __('Penilaian Manajemen') }}</x-slot>
		<x-slot name="content">
			@if($managementscore)
			<div class="font-semibold text-base">Penilaian terakhir tanggal {{ $managementscore->scored_at->isoFormat('LL') }}</div>
			<div class="text-sm">
			Keterangan: {{ $managementscore->description ?? '-' }}
			</div>
			<div class="border-t border-gray-200 mt-2">
				@foreach ($manage_options as $k => $opt)
				<dl>
					<div class="bg-gray-50 px-0 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
						<dt class="text-sm font-medium text-gray-500 sm:col-span-2">
							{{ $opt }}
						</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:mt-0">
							{{ $managementscore->$k }}
						</dd>
					</div>
				</dl>
				@endforeach
			</div>
			@else
			Anda belum pernah mendapatkan penilaian apapun.
			@endif
		</x-slot>
	</x-card-panel>
	
</div>