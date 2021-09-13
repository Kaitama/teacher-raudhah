<?php

namespace App\Http\Livewire\Attendance\Gathering;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\GatheringImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Gathering;

class Create extends Component
{
	use WithFileUploads;
	
	public $teachers, $excel;
	public $name, $held_at, $description, $manual_input = 'manual';
	
	protected $listeners = ['sendTeacher' => 'setTeachers'];
	
	protected $rules = [
		'name'	=> 'required',
		'held_at'	=> 'required|date_format:d/m/Y',
		'excel'	=> 'nullable|file|mimes:xls,xlsx'
	];
	
	protected $messages = [
		'held_at.required'	=> 'Tanggal kegiatan tidak boleh kosong.',
		'held_at.date_format'	=> 'Format penulisan tanggal salah.',
		'name.required'	=> 'Nama kegiatan tidak boleh kosong.',
		'excel.file'	=> 'Format file tidak valid.',
		'excel.mimes'	=> 'Hanya file Excel yang dapat diupload.'
	];
	
	public function setTeachers($teachers){
		$this->teachers[] = $teachers;
	}
	
	public function mount(){
		$this->held_at = Carbon::today()->format('d/m/Y');
	}
	
	public function save(){
		
		$this->validate();
		
		$gath = Gathering::create([
			'held_at'	=> Carbon::createFromFormat('d/m/Y', $this->held_at)->format('Y-m-d'),
			'name'	=> $this->name,
			'description'	=> $this->description,
		]);
		if($this->manual_input == 'manual'){
			if(!empty($this->teachers)){
				$ids = array();
				foreach ($this->teachers as $t) {
					$ids[] = $t['id'];
				}
				$gath->users()->sync($ids);
			}
		} else {
			if($this->excel) { 
				$ids = $this->importExcel($gath); 
				$gath->users()->sync($ids);
			}
		}
		$this->reset(['name', 'held_at', 'description', 'teachers']);
		$this->held_at = Carbon::today()->format('d/m/Y');
		$this->emit('resetTeachers');
		$this->emit('saved');
	}
	
	public function remove($i){
		unset($this->teachers[$i]);
		$this->emit('removeTeacher', $i);
	}
	
	public function render()
	{
		return view('livewire.attendance.gathering.create');
	}
	
	public function importExcel(Gathering $gathering){
		$import =  new GatheringImport($gathering);
		Excel::import($import, $this->excel);
		$this->reset('excel');
		return $import->getIds();
	}
	
	public function downloadTemplate(){
		return Storage::disk('public')->download('excel/TEMPLATE_KUMPUL.xlsx', 'TEMPLATE_KUMPUL_' . time() . '.xlsx');
	}
	
}