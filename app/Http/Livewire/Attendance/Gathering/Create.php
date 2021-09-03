<?php

namespace App\Http\Livewire\Attendance\Gathering;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Gathering;

class Create extends Component
{
	public $teachers;
	public $name, $held_at, $description;
	
	protected $listeners = ['sendTeacher' => 'setTeachers'];
	
	protected $rules = [
		'name'	=> 'required',
		'held_at'	=> 'required|date_format:d/m/Y',
	];

	protected $messages = [
		'held_at.required'	=> 'Tanggal kegiatan tidak boleh kosong.',
		'held_at.date_format'	=> 'Format penulisan tanggal salah.',
		'name.required'	=> 'Nama kegiatan tidak boleh kosong.',
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
		
		if(!empty($this->teachers)){
			$ids = array();
			foreach ($this->teachers as $t) {
				$ids[] = $t['id'];
			}
			$gath->users()->sync($ids);
		}
		$this->reset(['name', 'held_at', 'description', 'teachers']);
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
}