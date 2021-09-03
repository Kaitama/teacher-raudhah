<x-description-list>
	<x-slot name="title">{{ __('Data Keluarga') }}</x-slot>
	<x-slot name="description">{{ __('Informasi data keluarga ') . ucwords(strtolower($teacher->name)) }}</x-slot>
	<x-slot name="button">
		{{--  --}}
	</x-slot>
	<x-slot name="content">
		@php $i = 0 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Nama Istri/Suami') }}</x-slot>
			<x-slot name="right">{{ $teacher->partner->name ? ucwords(strtolower($teacher->partner->name)) : '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Nomor HP') }}</x-slot>
			<x-slot name="right">{{ $teacher->partner->phone ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Pendidikan Terakhir') }}</x-slot>
			<x-slot name="right">{{ $teacher->partner->education ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Pekerjaan') }}</x-slot>
			<x-slot name="right">{{ $teacher->partner->work ?? '-' }}</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		<x-dl i={{$i}}>
			<x-slot name="left">{{ __('Jumlah Anak') }}</x-slot>
			<x-slot name="right">
				@if ($teacher->childrens->count() == 0)
				{{ __('Tidak ada') }}
				@else
				{{ $teacher->childrens->count() }} {{ __('orang') }}
				@endif
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		
		@if ($teacher->childrens->count() > 0)
		@foreach ($teacher->childrens->sortBy('birthdate') as $child)
		<x-dl i={{$i}}>
			<x-slot name="left"></x-slot>
			<x-slot name="right">
				<div class="flex justify-between items-center">
					<div>
						<div class="font-medium">{{ $child->name ?? '-' }}</div>
						<div class="text-gray-600">{{ $child->birthplace ?? '-' }}, {{ $child->birthdate ? $child->birthdate->isoFormat('LL') : '-' }}</div>
					</div>
					<x-pill color="{{ $child->gender ? 'blue' : 'pink' }}">{{ $child->gender ? 'Putra' : 'Putri' }}</x-pill>
				</div>
			</x-slot>
		</x-dl>
		@php $i = $i+1 @endphp
		@endforeach
		@endif
		
	</x-slot>
</x-description-list>