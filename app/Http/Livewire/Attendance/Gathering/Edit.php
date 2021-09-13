<?php

namespace App\Http\Livewire\Attendance\Gathering;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\GatheringImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Models\Gathering;
use App\Models\User;
use Carbon\Carbon;

class Edit extends Component
{
	use WithFileUploads;
	
	public $gath, $name, $held_at, $description;
	public $teachers, $excel, $manual_input = 'manual';
	public $ids = [];
	
	protected $listeners = ['sendTeacher' => 'setTeachers', 'reRender' => '$refresh'];
	
	protected $rules = [
		'held_at'	=> 'required|date_format:d/m/Y',
		'name'	=> 'required',
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
	
	public function mount($id){
		$gath = Gathering::find($id);
		$this->gath = $gath;
		$this->held_at = $gath->held_at->format('d/m/Y');
		$this->name = $gath->name;
		$this->description = $gath->description;
		
		foreach ($gath->users as $u) {
			$this->teachers[] = $u;
			$this->ids[] = $u->id;
		}
	}
	
	public function remove($i){
		unset($this->teachers[$i]);
		$this->emit('removeTeacher', $i);
	}
	
	public function update(){
		$this->validate();
		$this->gath->update([
			'name'	=> $this->name,
			'held_at'	=> Carbon::createFromFormat('d/m/Y', $this->held_at)->format('Y-m-d'),
			'description'	=> $this->description,
		]);
		if($this->manual_input == 'manual'){
			if(!empty($this->teachers)) {
				$ids = array();
				foreach ($this->teachers as $t) {
					$ids[] = $t['id'];
				}
				$this->gath->users()->sync($ids);
			} else {
				$this->gath->users()->detach();
			}
		} else {
			if($this->excel){ 
				$ids = $this->importExcel();
				$this->gath->users()->sync($ids);
			}
		}
		$this->emit('saved');
		return redirect()->route('gathering.edit', $this->gath->id);
		
	}
	
	public function render()
	{
		return view('livewire.attendance.gathering.edit');
	}
	
	public function importExcel(){
		$import =  new GatheringImport($this->gath);
		Excel::import($import, $this->excel);
		$this->reset('excel');
		return $import->getIds();
	}
	
	public function downloadTemplate(){
		return Storage::disk('public')->download('excel/TEMPLATE_KUMPUL.xlsx', 'TEMPLATE_KUMPUL_' . time() . '.xlsx');
	}
}