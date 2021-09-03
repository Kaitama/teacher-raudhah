<x-jet-form-section submit="importExcel" x-data="{excelName: null, excelPreview: null}">
	<x-slot name="title">{{ __('Import Excel') }}</x-slot>
	<x-slot name="description">
		{{ __('Upload data absensi dari file Excel.') }}
		<div class="mt-2">
			<x-jet-secondary-button wire:click.prevent="downloadTemplate">{{ __('Download Template') }}</x-jet-secondary-button>
		</div>
	</x-slot>
	
	<x-slot name="form">
		<div class="m-4 rounded-md bg-gray-100 py-8 items-center col-span-12">
			<div class="overflow-hidden relative w-full mt-4 mb-4">
				<input type="file" class="hidden"
				wire:model="excel"
				x-ref="excel"
				x-on:change="
				excelName = $refs.excel.files[0].name;
				const reader = new FileReader();
				reader.onload = (e) => {
					excelPreview = e.target.result;
				};
				reader.readAsDataURL($refs.excel.files[0]);
				" />
				
				<button type="button" class="bg-indigo hover:text-indigo-500 text-indigo-700 text-xl py-2 px-4 block w-full inline-flex items-center justify-center font-bold" x-on:click.prevent="$refs.excel.click()">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
					</svg>
					<span class="ml-2" x-text="excelName ?? 'Pilih File Excel'"></span>
				</button>
			</div>
		</div>
		
		<div class="col-span-12">
			<p class="text-gray-600 text-sm">
				Data yang sama akan disimpan dua kali (duplikat), untuk itu selalu pastikan hanya mengisi data yang ingin disimpan dalam file Excel. <span class="font-bold">Tips: </span>Selalu download dan gunakan template baru jika ingin mengisi data melalui import Excel untuk memastikan tidak ada data lama yang tersimpan pada file Excel tersebut.
			</p>
		</div>
		
	</x-slot>
	
	<x-slot name="actions">
		<x-jet-action-message class="mr-3" on="saved">
			{{ __('Sukes.') }}
		</x-jet-action-message>

		<x-jet-input-error for="excel" class="mr-3" />
		
		<x-jet-secondary-button x-show="excelPreview" type="reset" class="mr-3" wire:click="$set('excel', null)" x-on:click="excelName = null, excelPreview = null">{{ __('Batal') }}</x-jet-secondary-button>
		
		<x-jet-button wire:loading.attr="disabled" wire:target="excel">
			{{ __('Upload') }}
		</x-jet-button>
	</x-slot>
</x-jet-form-section>