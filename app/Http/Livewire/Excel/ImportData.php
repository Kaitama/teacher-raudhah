<?php

namespace App\Http\Livewire\Excel;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\AbsensiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class ImportData extends Component
{
	use WithFileUploads;
	
	public $excel;
	public $excelName = 'Pilih file Excel';
	
	public function render()
	{
		return view('livewire.excel.import-data');
	}

	public function importExcel(){
		$this->validate([
			'excel'	=> 'required|file|mimes:xls,xlsx'
		], [
			'excel.required'	=> 'File tidak boleh kosong.',
			'excel.file'	=> 'Format file tidak valid.',
			'excel.mimes'	=> 'Hanya file Excel yang dapat diupload.'
		]);

		$import =  Excel::import(new AbsensiImport, $this->excel);
		$this->reset('excel');
		$this->emit('saved');
	}

	public function downloadTemplate(){
		return Storage::disk('public')->download('excel/TEMPLATE_GURU.xlsx', 'TEMPLATE_GURU_' . time() . '.xlsx');
	}
}