<div class="py-4">

	<div class="px-4">
		<h1 class="text-xl text-left">{{ __('Struktural') }}</h1>
		<div class="text-gray-600">{{ __('Penilaian struktural') }} {{ $teacher->name }}</div>
	</div>



	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Tanggal') }}</x-th>
			@foreach ($categories as $k => $category)
			<x-th class="text-right">
				{{ $k }}
			</x-th>
			@endforeach
			<x-th class="text-right">
				{{ __('RT') }}
			</x-th>
			<x-th class="text-center">
				{{ __('HRF') }}
			</x-th>
			<x-th></x-th>
		</x-slot>
		<x-slot name="td">

			@forelse ($teacher_scores as $i => $score)
			<tr>
				<x-td class="text-gray-600">{{ $teacher_scores->firstItem() + $i }}</x-td>
				<x-td>
					<div class="text-gray-900 text-sm">
						{{ $score->scored_at->isoFormat('LL') }}
					</div>
				</x-td>
				@foreach ($categories as $i => $cat)
				<x-td>
					<div class="text-gray-900 font-semibold text-right">
						{{ $score->$i }}
					</div>
				</x-td>
				@endforeach
				<x-td>
					@php $rt  = round(array_sum([$score->c1, $score->c2, $score->c3]) / count($categories), 1) @endphp
					<div class="text-gray-900 font-semibold text-right">
						{{ $rt }}
					</div>
				</x-td>
				<x-td>
					@php
					if($rt >= 81) $hrf = 'A'; elseif($rt >= 71) $hrf = 'B'; elseif($rt >= 61) $hrf = 'C'; elseif($rt >= 51) $hrf = 'D'; else $hrf = 'E';
					@endphp
					<div class="text-gray-900 font-semibold text-center">
						{{ $hrf }}
					</div>
				</x-td>
				<x-td class="text-right text-sm font-medium">
					<div class="flex space-x-4 flex-row justify-end">
						@can('u a penilaian')
						<x-buttons.button-edit href="{{ route('scoring.edit', [$teacher->id, $score->id, 2]) }}"></x-buttons.button-edit>
						@endcan
						@can('d a penilaian')
						<x-buttons.button-delete wire:click="confirmDelete({{$score->id}})"></x-buttons.button-delete>
						@endcan
					</div>
				</x-td>
			</tr>
			@empty
			<x-empty-records colspan="{{ 5 + count($categories) }}" />
			@endforelse

		</x-slot>
	</x-table>

	@if($teacher_scores->hasPages())
	<div class="mt-4">
		{{ $teacher_scores->links() }}
	</div>
	@endif

	<div class="mt-4 px-2 px-4">
		<div class="flex items-start justify-between">
			<div class="w-1/2">
				<div class="text-gray-900 font-semibold mb-1">{{ __('Rentang Nilai') }}</div>
				<ul class="text-gray-600 text-sm">
					@foreach ($score_ranges as $key => $scr)
					<li>{{ $key }} = {{ $scr }}</li>
					@endforeach
				</ul>
			</div>
			<div class="w-1/2">
				<div class="text-gray-900 font-semibold mb-1">{{ __('Keterangan') }}</div>
				<ul class="text-gray-600 text-sm">
					@foreach ($categories as $c => $val)
					<li>{{ strtoupper($c) }} : {{ $val }}</li>
					@endforeach
					<li>{{ __('RT : Rata-rata Nilai') }}</li>
					<li>{{ __('HRF : Nilai Huruf') }}</li>
				</ul>
			</div>

		</div>
	</div>

	@can('d a penilaian')
	<x-jet-confirmation-modal wire:model="confirmation_modal">
		<x-slot name="title">{{ __('Konfirmasi Hapus Penilaian') }}</x-slot>
		<x-slot name="content">
			<p>{{ __('Anda yakin ingin menghapus data penilaian kepengurusan ') }} <span class="text-red-600 font-medium">{{ $teacher->name ?? '' }}</span> {{ __(' pada tanggal ') }} <span class="text-red-600 font-medium">{{ $item ? $item->scored_at->isoFormat('LL') : '' }}</span>?</p>
		</x-slot>

		<x-slot name="footer">
			<x-jet-secondary-button wire:click="$toggle('confirmation_modal')" wire:loading.attr="disabled">
				{{ __('Batal') }}
			</x-jet-secondary-button>

			<x-jet-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
				{{ __('Ya, Hapus!') }}
			</x-jet-danger-button>
		</x-slot>
	</x-jet-confirmation-modal>
	@endcan
</div>
