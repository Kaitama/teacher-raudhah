<x-description-list>
	<x-slot name="title">{{ __('Data Pendidikan') }}</x-slot>
	<x-slot name="description">{{ __('Informasi data pendidikan ') . ucwords(strtolower($teacher->name)) }}</x-slot>
	<x-slot name="button">
		{{--  --}}
	</x-slot>
	<x-slot name="content">
		@php $i = 0; @endphp
		@if($edu = $teacher->educations->sortByDesc('level')->where('out', null)->first())
		
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Pendidikan Aktif') }}</x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Jenjang') }}</div>
				<div class="font-medium">{{ $levels[$edu['level']] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Nama Universitas') }}</div>
				<div class="font-medium">{{ $edu['name'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Fakultas') }}</div>
				<div class="font-medium">{{ $edu['faculty'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Jurusan') }}</div>
				<div class="font-medium">{{ $edu['focus'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Semester') }}</div>
				<div class="font-medium">{{ $edu['semester'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		
		@endif
		
		@if($last = $teacher->educations->sortByDesc('level')->sortByDesc('out')->where('out', '!=', null)->first())
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Ijazah Terakhir') }}</x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Jenjang') }}</div>
				<div class="font-medium">{{ $levels[$last['level']] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Nama Universitas') }}</div>
				<div class="font-medium">{{ $last['name'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Fakultas') }}</div>
				<div class="font-medium">{{ $last['faculty'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Jurusan') }}</div>
				<div class="font-medium">{{ $last['focus'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="text-gray-600">{{ __('Nomor Ijazah') }}</div>
				<div class="font-medium">{{ $last['certificate'] ?? '-' }}</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		
		@endif
		
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Riwayat Pendidikan') }}</x-slot>
			<x-slot name="right">
				
				<x-table>
					<x-slot name="th">
						<x-th>{{ __('#') }}</x-th>
						<x-th>{{ __('Tingkat') }}</x-th>
						<x-th>{{ __('Nama Sekolah/Universitas') }}</x-th>
						<x-th>{{ __('Tahun Masuk') }}</x-th>
						<x-th>{{ __('Tahun Keluar') }}</x-th>
					</x-slot>
					<x-slot name="td">
						@php $no = 1 @endphp
						@foreach ($teacher->educations->sortBy('level') as $history)
						<tr>
							<x-td>{{ $no++ }}</x-td>
							<x-td>{{ $levels[$history->level] }}</x-td>
							<x-td>
								<div class="text-sm font-medium text-gray-900">
									{{ $history->name ?? '-' }}
								</div>
								<div class="text-sm text-gray-500">
									{{ $history->address ?? '-' }}
								</div>
							</x-td>
							<x-td>{{ $history->in ?? '-' }}</x-td>
							<x-td>
								@if($history->out)
								{{ $history->out }}
								@else
								<x-pill color="green">{{ __('Aktif') }}</x-pill>
								@endif
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