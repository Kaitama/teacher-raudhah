<x-description-list>
	<x-slot name="title">{{ __('Data Pribadi') }}</x-slot>
	<x-slot name="description">{{ __('Informasi data pribadi ') . ucwords(strtolower($teacher->name)) }}</x-slot>
	<x-slot name="button">
		@role('guru')
		<x-buttons.button-edit href="{{ route('profile.edit') }}">
			<span class="ml-2">{{ __('Edit Profil') }}</span>
		</x-buttons.button-edit>
		@endrole
	</x-slot>
	<x-slot name="content">
		@php $i = 0 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Photo') }}</x-slot>
			<x-slot name="right">
				<img src="{{ $photo }}" class="h-64 w-auto" alt="">
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Nama Lengkap') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->ftitle ? $teacher->profile->ftitle : '' }} {{ ucwords(strtolower($teacher->name)) }}{{ $teacher->profile->ltitle ? ', ' . $teacher->profile->ltitle : '' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Nomor Induk Guru') }}</x-slot>
			<x-slot name="right">{{ $teacher->nig ? $teacher->nig->number : '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Username') }}</x-slot>
			<x-slot name="right">{{ $teacher->username }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Email') }}</x-slot>
			<x-slot name="right">{{ $teacher->email }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Telepon') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->phone ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Tempat, Tanggal Lahir') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->birthplace ? ucwords(strtolower($teacher->profile->birthplace)) : '-' }}, {{ $teacher->profile->birthdate ? $teacher->profile->birthdate->isoFormat('LL') : '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Jenis Kelamin') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->gender ? 'Pria' : 'Wanita' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Status Pernikahan') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->marriage }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Alamat') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->address ? ucwords(strtolower($teacher->profile->address)) : '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Nomor KTP') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->ktp ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('NPWP') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->npwp ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Golongan Darah') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->blood ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Anak Ke') }}</x-slot>
			<x-slot name="right">{{ $teacher->profile->childnum }} {{ __(' dari ') }} {{ $teacher->profile->siblings + 1 }} {{ __(' bersaudara') }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
	</x-slot>
</x-description-list>
