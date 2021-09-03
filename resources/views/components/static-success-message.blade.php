@if (session()->has('success'))
<div {{ $attributes->merge(['class' => 'text-sm text-green-600 w-full bg-green-50 p-4 my-2 border border-transparent rounded-md flex items-center']) }}>
	<div class="flex-shrink-0 h-10 w-10">
		<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
			<svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
			</svg>
		</div>
	</div>
	<div class="ml-4">
		<div class="font-bold">{{ __('Registrasi berhasil, silahkan login.') }}</div>
	</div>
</div>
@endif