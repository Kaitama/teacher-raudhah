<?php

namespace App\Http\Livewire\Attendance\Assignment;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Userassignment;

class Create extends Component
{
	public $categories, $signed_at, $category = 1, $decree, $description, $started_at, $ended_at;
	public $teachers;
	
	protected $listeners = ['sendTeacher' => 'setTeachers'];
	
	protected $rules = [
		'decree'	=> 'required|unique:userassignments',
		'signed_at'	=> 'required|date_format:d/m/Y',
		'started_at'	=> 'required|date_format:d/m/Y',
		'ended_at'	=> 'nullable|date_format:d/m/Y',
		'teachers'	=> 'required',
	];
	
	protected $messages = [
		'decree.required'	=> 'Nomor SK tidak boleh kosong.',
		'decree.unique'	=> 'Nomor SK sudah terdaftar.',
		'signed_at.required'	=> 'Tanggal perizinan tidak boleh kosong.',
		'signed_at.date_format'	=> 'Format penulisan tanggal salah.',
		'started_at.required'	=> 'Tanggal mulai tidak boleh kosong.',
		'started_at.date_format'	=> 'Format penulisan tanggal salah.',
		'ended_at.date_format'	=> 'Format penulisan tanggal salah.',
		'teachers.required'	=> 'Guru yang ditugaskan tidak boleh kosong.',
	];
	
	public function setTeachers($teachers){
		// if(!empty($this->teachers)) {
		// 	$this->remove(array_key_first($this->teachers));
		// }
		$this->teachers[] = $teachers;
	}
	
	public function mount(){
		$this->categories = Userassignment::assignmentOptions();
		$this->prepareDates();
	}
	
	private function prepareDates()
	{
		$this->started_at = Carbon::today()->format('d/m/Y');
		$this->signed_at = Carbon::today()->format('d/m/Y');
		// $this->ended_at = Carbon::tomorrow()->format('d/m/Y');
	}
	
	public function remove($i){
		unset($this->teachers[$i]);
		$this->emit('removeTeacher', $i);
	}
	
	public function save(){
		$this->validate();
		$ended_at = null;
		if($this->ended_at) $ended_at = Carbon::createFromFormat('d/m/Y', $this->ended_at)->format('Y-m-d');
		
		foreach ($this->teachers as $teacher) {
			Userassignment::create([
				'user_id'	=> $teacher['id'],
				'decree'	=> $this->decree,
				'category'	=> $this->category,
				'description'	=> $this->description,
				'signed_at'	=> Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'),
				'started_at'	=> Carbon::createFromFormat('d/m/Y', $this->started_at)->format('Y-m-d'),
				'ended_at'	=> $ended_at,
			]);
		}
		$this->reset(['category', 'decree', 'description', 'teachers']);
		$this->prepareDates();
		$this->emit('resetTeachers');
		$this->emit('saved');
		
		$this->emit('saved');
	}
	
	public function render()
	{
		return view('livewire.attendance.assignment.create');
	}
}