<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use App\Exports\ClassroomTeacher;
use App\Models\User;
use App\Models\Classroom;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Imports\WalikelasImport;
use Illuminate\Support\Facades\Storage;

class Setclass extends Component
{
	use WithFileUploads;
	public $excel;
	public function render()
	{
		return view('livewire.teacher.setclass');
	}
	
	public function downloadTemplate(){
		return Excel::download(new ClassroomTeacher, 'SET_WALI_KELAS_' . time() . '.xlsx');
	}
	
	public function importExcel(){
		$this->validate([
			'excel'	=> 'required|file|mimes:xls,xlsx'
		], [
			'excel.required'	=> 'File tidak boleh kosong.',
			'excel.file'	=> 'Format file tidak valid.',
			'excel.mimes'	=> 'Hanya file Excel yang dapat diupload.'
		]);
		
		$import =  Excel::import(new WalikelasImport, $this->excel);
		$this->excel = null;
		$this->emit('saved');
	}
}