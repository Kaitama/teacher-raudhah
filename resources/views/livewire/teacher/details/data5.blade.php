<div>
	<x-description-list>
		<x-slot name="title">{{ __('Data Orang Tua') }}</x-slot>
		<x-slot name="description">{{ __('Informasi data orang tua ') . ucwords(strtolower($teacher->name)) }}</x-slot>
		<x-slot name="button">
			{{--  --}}
		</x-slot>
		<x-slot name="content">
			@php $i = 0; @endphp
			
			<x-dl i={{$i}}>
				<x-slot name="left">{{ __('Data Ayah') }}</x-slot>
				<x-slot name="right">
					<div class="text-gray-600">{{ __('Nama Lengkap') }}</div>
					<div class="text-gray-900">{{ $teacher->profile->fname ? ucwords(strtolower($teacher->profile->fname)) : '-' }}</div>
				</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left"></x-slot>
				<x-slot name="right">
					<div class="text-gray-600">{{ __('Nomor HP') }}</div>
					<div class="text-gray-900">{{ $teacher->profile->fphone ?? '-' }}</div>
				</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left"></x-slot>
				<x-slot name="right">
					<div class="text-gray-600">{{ __('Status Keberadaan') }}</div>
					<div class="text-gray-900">
						@if ($teacher->profile->fname)
						{{ $teacher->profile->fstatus ? 'Masih Hidup' : 'Sudah Meninggal' }}
						@else
						{{ __('-') }}
						@endif
					</div>
				</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left">{{ __('Data Ibu') }}</x-slot>
				<x-slot name="right">
					<div class="text-gray-600">{{ __('Nama Lengkap') }}</div>
					<div class="text-gray-900">{{ $teacher->profile->mname ? ucwords(strtolower($teacher->profile->mname)) : '-' }}</div>
				</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left"></x-slot>
				<x-slot name="right">
					<div class="text-gray-600">{{ __('Nomor HP') }}</div>
					<div class="text-gray-900">{{ $teacher->profile->mphone ?? '-' }}</div>
				</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left"></x-slot>
				<x-slot name="right">
					<div class="text-gray-600">{{ __('Status Keberadaan') }}</div>
					<div class="text-gray-900">
						@if ($teacher->profile->mname)
						{{ $teacher->profile->mstatus ? 'Masih Hidup' : 'Sudah Meninggal' }}
						@else
						{{ __('-') }}
						@endif
					</div>
				</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left">{{ __('Alamat Orang Tua') }}</x-slot>
				<x-slot name="right">{{ $teacher->profile->paddress ?? '-' }}</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
		</x-slot>
	</x-description-list>
	
	<x-vertical-spacer />
	
	<x-description-list>
		<x-slot name="title">{{ __('Hobby dan Lainnya') }}</x-slot>
		<x-slot name="description">{{ __('Informasi data hobby dan kegiatan ') . ucwords(strtolower($teacher->name)) }}</x-slot>
		<x-slot name="button">
			{{--  --}}
		</x-slot>
		<x-slot name="content">
			@php $i = 0; @endphp
			
			<x-dl i={{$i}}>
				<x-slot name="left">{{ __('Bidang Seni') }}</x-slot>
				<x-slot name="right">{{ $teacher->profile->arts ?? '-' }}</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left">{{ __('Bidang Olahraga') }}</x-slot>
				<x-slot name="right">{{ $teacher->profile->sports ?? '-' }}</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left">{{ __('Bidang Organisasi') }}</x-slot>
				<x-slot name="right">{{ $teacher->profile->organizations ?? '-' }}</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
			<x-dl i={{$i}}>
				<x-slot name="left">{{ __('Bidang Lainnya') }}</x-slot>
				<x-slot name="right">{{ $teacher->profile->others ?? '-' }}</x-slot>
			</x-dl>
			@php $i = $i+1; @endphp
		</x-slot>
	</x-description-list>
</div>