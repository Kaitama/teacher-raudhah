<div class="py-4">
	
	<div class="px-4">
		<h1 class="text-xl text-left">{{ __('Kepengurusan') }}</h1>
		<div class="text-gray-600">{{ __('Penilaian kepengurusan') }} {{ $teacher->name }}</div>
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
			@unlessrole('guru|supervisor')
			<x-th></x-th>
			@endunlessrole
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
					@php $rt  = round(array_sum([$score->c1, $score->c2, $score->c3, $score->c4, $score->c5, $score->c6]) / 6, 0) @endphp
					<div class="text-gray-900 font-semibold text-right">
						{{ $rt }}
					</div>
				</x-td>
				<x-td>
					@php
					if($rt >= 80) $hrf = 'A'; elseif($rt >= 70) $hrf = 'B'; elseif($rt >= 60) $hrf = 'C'; elseif($rt >= 50) $hrf = 'D'; else $hrf = 'E';
					@endphp
					<div class="text-gray-900 font-semibold text-center">
						{{ $hrf }}
					</div>
				</x-td>
				@unlessrole('guru|supervisor')
				<x-td class="text-right text-sm font-medium">
					<div class="flex space-x-4 flex-row justify-end">
						<x-buttons.button-edit href="{{ route('scoring.edit', [$teacher->id, $score->id, 2]) }}" />
						<x-buttons.button-delete wire:click="confirmDelete({{$score->id}})" />
					</div>
				</x-td>
				@endunlessrole
			</tr>
			@empty
			@unlessrole('guru|supervisor')
			<x-empty-records colspan="{{ 5 + count($categories) }}" />
			@else
			<x-empty-records colspan="{{ 4 + count($categories) }}" />
			@endunlessrole
			@endforelse
			
		</x-slot>
	</x-table>
	
	@if($teacher_scores->hasPages())
	<div class="mt-4">
		{{ $teacher_scores->links() }}
	</div>
	@endif
	
	<div class="mt-4 px-2 px-4">
		<div class="text-gray-900 font-semibold mb-1">{{ __('Keterangan') }}</div>
		<ul class="text-gray-600 text-sm">
			@foreach ($categories as $c => $val)
			<li>{{ strtoupper($c) }} : {{ $val }}</li>
			@endforeach
			<li>{{ __('RT : Rata-rata Nilai') }}</li>
			<li>{{ __('HRF : Nilai Huruf') }}</li>
		</ul>
	</div>


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

</div>