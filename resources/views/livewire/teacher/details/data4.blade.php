<x-description-list>
	<x-slot name="title">{{ __('Pengalaman Kerja') }}</x-slot>
	<x-slot name="description">{{ __('Informasi data riwayat pekerjaan ') . ucwords(strtolower($teacher->name)) }}</x-slot>
	<x-slot name="button">
		{{--  --}}
	</x-slot>
	<x-slot name="content">
		@php $i = 0; @endphp
		
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Riwayat Pekerjaan') }}</x-slot>
			<x-slot name="right">
				
				<x-table>
					<x-slot name="th">
						<x-th>{{ __('#') }}</x-th>
						<x-th>{{ __('Instansi / Perusahaan') }}</x-th>
						<x-th>{{ __('Jabatan / Tahun') }}</x-th>
						<x-th>{{ __('Keterangan') }}</x-th>
					</x-slot>
					<x-slot name="td">
						@php $no = 1 @endphp
						@foreach ($teacher->works->sortBy('in') as $work)
								<tr>
									<x-td>{{ $no++ }}</x-td>
									<x-td>
										<div class="text-sm font-medium text-gray-900">
											{{ $work->name ?? '-' }}
										</div>
										<div class="text-sm text-gray-500">
											{{ $work->address ?? '-' }}
										</div>	
									</x-td>
									<x-td>
										@if($work->position)
											{{ $work->position ?? '-' }}
										@endif
										<div class="text-sm text-gray-500">
										{{ $work->in ?? '-' }} - {{ $work->out ?? 'Sekarang' }}
									</div>
									</x-td>
									<x-td>
										<div class="text-sm text-gray-500">
										{{ $work->description ?? '-' }}
									</div>
									</x-td>
								</tr>
						@endforeach
					</x-slot>
				</x-table>

			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp

	</x-slot>
</x-description-list>