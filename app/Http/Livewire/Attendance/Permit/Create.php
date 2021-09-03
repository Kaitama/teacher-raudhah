<?php

namespace App\Http\Livewire\Attendance\Permit;

use Livewire\Component;
use App\Models\Userpermit;
use Carbon\Carbon;

class Create extends Component
{
	public $categories, $signed_at, $category = 1, $description, $started_at, $ended_at;
	public $teachers;

	protected $listeners = ['sendTeacher' => 'setTeachers'];
	
	protected $rules = [
		'signed_at'	=> 'required|date_format:d/m/Y',
		'started_at'	=> 'required|date_format:d/m/Y',
		'ended_at'	=> 'required|date_format:d/m/Y',
		'teachers'	=> 'required',
	];

	protected $messages = [
		'signed_at.required'	=> 'Tanggal perizinan tidak boleh kosong.',
		'signed_at.date_format'	=> 'Format penulisan tanggal salah.',
		'started_at.required'	=> 'Tanggal mulai tidak boleh kosong.',
		'started_at.date_format'	=> 'Format penulisan tanggal salah.',
		'ended_at.required'	=> 'Tanggal berakhir tidak boleh kosong.',
		'ended_at.date_format'	=> 'Format penulisan tanggal salah.',
		'teachers.required'	=> 'Guru yang izin tidak boleh kosong.',
	];

	public function setTeachers($teachers){
		$this->teachers[] = $teachers;
	}

	public function mount(){
		$this->categories = Userpermit::permitOptions();
		$this->prepareDates();
	}

	private function prepareDates()
	{
		$this->started_at = Carbon::today()->format('d/m/Y');
		$this->signed_at = Carbon::today()->format('d/m/Y');
		$this->ended_at = Carbon::tomorrow()->format('d/m/Y');
	}

	public function save(){
		$this->validate();

		foreach ($this->teachers as $teacher) {
			Userpermit::create([
				'user_id'	=> $teacher['id'],
				'category'	=> $this->category,
				'description'	=> $this->description,
				'signed_at'	=> Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'),
				'started_at'	=> Carbon::createFromFormat('d/m/Y', $this->started_at)->format('Y-m-d'),
				'ended_at'	=> Carbon::createFromFormat('d/m/Y', $this->ended_at)->format('Y-m-d'),
			]);
		}
		$this->reset(['category', 'description', 'teachers']);
		$this->prepareDates();
		$this->emit('resetTeachers');
		$this->emit('saved');
	}
	
	public function render()
	{
		return view('livewire.attendance.permit.create');
	}

	public function remove($i){
		unset($this->teachers[$i]);
		$this->emit('removeTeacher', $i);
	}
	
}