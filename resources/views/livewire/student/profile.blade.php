<div>
	<x-profile-panel class="mt-6 sm:mt-0">
		<x-slot name="title">{{ __('Biodata') }}</x-slot>
		<x-slot name="description">
			{{ __('Informasi biodata santri.') }}
		</x-slot>
		<x-slot name="content">
			@php $i = 1 @endphp
			<div class="col-span-6">
				<dl>
					@php 
						$i = $i+1; 
					$photo = $student->gender == 'L' ? 'male.jpg' : 'female.jpg';	
					@endphp
					<x-dl i={{$i}}>
						<x-slot name="left"></x-slot>
						<x-slot name="right">
							<img src="https://sisfo.raudhah.ac.id/assets/img/student/{{ $student->photo ?? $photo }}" class="h-40 w-40 object-cover" alt="">
						</x-slot>
					</x-dl>
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Stambuk') }}</x-slot>
						<x-slot name="right">{{ $student->stambuk }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{ $i }}>
						<x-slot name="left">{{ __('Nama Lengkap') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->name)) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Kelas') }}</x-slot>
						<x-slot name="right">{{ $student->classroom ? $student->classroom->name : '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Asrama') }}</x-slot>
						<x-slot name="right">{{ $student->dormroom ? $student->dormroom->name : '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Tempat, Tanggal Lahir') }}</x-slot>
						<x-slot name="right">{{ $student->birthplace ? ucwords(strtolower($student->birthplace)) : '-' }}, {{ $student->birthdate ? $student->birthdate->isoFormat('LL') : '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Jenis Kelamin') }}</x-slot>
						<x-slot name="right">{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nomor Induk Siswa Nasional') }}</x-slot>
						<x-slot name="right">{{ $student->profile->nisn ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nama Panggilan') }}</x-slot>
						<x-slot name="right">{{ $student->profile->nickname ? ucwords(strtolower($student->profile->nickname)) : '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Golongan Darah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->blood ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Tinggi / Berat Badan') }}</x-slot>
						<x-slot name="right">{{ $student->profile->height ?? '00' }} CM / {{ $student->profile->weight ?? '00' }} KG</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Hobby') }}</x-slot>
						<x-slot name="right">{{ $student->profile->hobby ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Cita-cita') }}</x-slot>
						<x-slot name="right">{{ $student->profile->wishes ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Saudara Kandung') }}</x-slot>
						<x-slot name="right">
							@if ($student->profile->siblings == 0)
							{{ __('Tidak ada (tunggal)') }}
							@else
							{{ __('Anak ke-') }}{{ $student->profile->numposition }} {{ __('dari') }} {{ $student->profile->siblings + 1 }} {{ __('bersaudara') }}
							@endif	
						</x-slot>
					</x-dl>
				</dl>
			</div>
		</x-slot>
	</x-profile-panel>
	
	<x-jet-section-border />
	
	{{-- father --}}
	<x-profile-panel class="mt-6 sm:mt-0">
		<x-slot name="title">{{ __('Data Ayah') }}</x-slot>
		<x-slot name="description">{{ __('Informasi ayah kandung santri.') }}</x-slot>
		<x-slot name="content">
			@php $i = 1 @endphp
			<div class="col-span-6">
				<dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nama Ayah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->flive == false ? 'Alm.' : null }} {{ ucwords(strtolower($student->profile->fname ?? '')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Agama Ayah') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->freligion ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Telepon Ayah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->fphone ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('WhatsApp Ayah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->fwa ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Pendidikan Ayah') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->fedu ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Pekerjaan Ayah') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->fwork ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Alamat Ayah') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->fadd ?? '-')) }}</x-slot>
					</x-dl>
					
				</dl>
			</div>
		</x-slot>
	</x-profile-panel>
	
	<x-jet-section-border />
	
	{{-- mother --}}
	<x-profile-panel class="mt-6 sm:mt-0">
		<x-slot name="title">{{ __('Data Ibu') }}</x-slot>
		<x-slot name="description">{{ __('Informasi ibu kandung santri.') }}</x-slot>
		<x-slot name="content">
			@php $i = 1 @endphp
			<div class="col-span-6">
				<dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nama Ibu') }}</x-slot>
						<x-slot name="right">{{ $student->profile->mlive == false ? 'Alm.' : null }} {{ ucwords(strtolower($student->profile->mname ?? '')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Agama Ibu') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->mreligion ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Telepon Ibu') }}</x-slot>
						<x-slot name="right">{{ $student->profile->mphone ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('WhatsApp Ibu') }}</x-slot>
						<x-slot name="right">{{ $student->profile->mwa ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Pendidikan Ibu') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->medu ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Pekerjaan Ibu') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->mwork ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Alamat Ibu') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->madd ?? '-')) }}</x-slot>
					</x-dl>
					
				</dl>
			</div>
		</x-slot>
	</x-profile-panel>
	
	
	@if ($student->profile->donatur)
	<x-jet-section-border />
	
	{{-- donatur --}}
	<x-profile-panel class="mt-6 sm:mt-0">
		<x-slot name="title">{{ __('Data Donatur') }}</x-slot>
		<x-slot name="description">{{ __('Informasi pembiaya santri.') }}</x-slot>
		<x-slot name="content">
			@php $i = 1 @endphp
			<div class="col-span-6">
				<dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nama Donatur') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->dname ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Hubungan') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->drelation ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Telepon') }}</x-slot>
						<x-slot name="right">{{ $student->profile->dphone ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Alamat') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->dadd ?? '-')) }}</x-slot>
					</x-dl>
					
				</dl>
			</div>
		</x-slot>
	</x-profile-panel>
	@endif
	
	<x-jet-section-border />
	
	{{-- school --}}
	<x-profile-panel class="mt-6 sm:mt-0">
		<x-slot name="title">{{ __('Asal Sekolah') }}</x-slot>
		<x-slot name="description">{{ __('Informasi asal sekolah santri.') }}</x-slot>
		<x-slot name="content">
			@php $i = 1 @endphp
			<div class="col-span-6">
				<dl>
					@if($student->profile->transfer == true)
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Status') }}</x-slot>
						<x-slot name="right">{{ __('Pindahan') }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Alasan Pindah') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->preason ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Keterangan') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->pdescription ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Asal Sekolah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->sfrom ?? '' }} {{ $student->profile->slevel ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nama Sekolah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->pfrom ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Alamat Sekolah') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->padd ?? '-')) }}</x-slot>
					</x-dl>

					@else
					
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Asal Sekolah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->sfrom ?? '' }} {{ $student->profile->slevel ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nama Sekolah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->sname ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Alamat Sekolah') }}</x-slot>
						<x-slot name="right">{{ ucwords(strtolower($student->profile->sadd ?? '-')) }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nomor Pokok Sekolah Nasional') }}</x-slot>
						<x-slot name="right">{{ $student->profile->snpsn ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nomor Ujian Nasional') }}</x-slot>
						<x-slot name="right">{{ $student->profile->sun ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nomor Ijazah') }}</x-slot>
						<x-slot name="right">{{ $student->profile->sijazah ?? '-' }}</x-slot>
					</x-dl>
					@php $i = $i+1 @endphp
					<x-dl i={{$i}}>
						<x-slot name="left">{{ __('Nomor SKHUN') }}</x-slot>
						<x-slot name="right">{{ $student->profile->sskhun ?? '-' }}</x-slot>
					</x-dl>
					
					@endif
				</dl>
			</div>
		</x-slot>
	</x-profile-panel>
</div>
