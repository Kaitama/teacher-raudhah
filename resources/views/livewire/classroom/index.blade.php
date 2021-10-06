<div>
	<x-table class="mt-4 px-0 md:px-4">
		<x-slot name="th">
			<x-th>{{ __('#') }}</x-th>
			<x-th>{{ __('Stambuk') }}</x-th>
			<x-th>{{ __('Nama Lengkap') }}</x-th>
			<x-th>{{ __('Asrama') }}</x-th>
			<x-th></x-th>
		</x-slot>
		<x-slot name="td">
			@forelse ($students as $k => $student)
					<tr>
						<x-td class="text-gray-600">{{ $k + 1 }}</x-td>
						<x-td class="text-gray-600 font-semibold text-sm">{{ $student->stambuk }}</x-td>
						<x-td>
							<div class="text-sm font-medium text-gray-900">
								<x-link class="font-bold" href="{{ route('student.show', $student->id) }}">{{ ucwords(strtolower($student->name)) }}</x-link>
							</div>
							<div class="text-sm text-gray-500">
								{{ $student->birthplace ? ucwords(strtolower($student->birthplace)) : '-' }}, {{ $student->birthdate ? $student->birthdate->isoFormat('LL') : '-' }}
							</div>
						</x-td>
						<x-td class="text-gray-600 font-semibold text-sm">
							{{ $student->dormroom['name'] ?? '-' }}
						</x-td>
						<x-td class="text-right">
							<div class="flex items-center justify-end">
								<x-buttons.button-profile href="{{ route('student.show', $student->id) }}"><span class="ml-3">{{ __('Profil') }}</span></x-buttons.button-profile>
							<x-button-link-secondary href="{{ route('student.history', $student->id) }}" class="ml-3">{{ __('Riwayat') }}</x-button-link-secondary>
							</div>
						</x-td>
					</tr>
			@empty
			<x-empty-records :colspan="4" />
			@endforelse
		</x-slot>
		</x-table>
</div>
