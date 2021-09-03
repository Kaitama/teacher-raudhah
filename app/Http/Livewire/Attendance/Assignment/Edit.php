<?php

namespace App\Http\Livewire\Attendance\Assignment;

use Livewire\Component;
use App\Models\Userassignment;
use App\Models\User;
use Carbon\Carbon;

class Edit extends Component
{
	public $assignment, $categories, $signed_at, $category = 1, $decree, $description, $started_at, $ended_at;
	public $teacher, $ids = [];
	
	protected function rules()
	{
		return [
			'decree'	=> 'required|unique:userassignments,decree,' . $this->assignment->id,
			'signed_at'	=> 'required|date_format:d/m/Y',
			'started_at'	=> 'required|date_format:d/m/Y',
			'ended_at'	=> 'nullable|date_format:d/m/Y',
		];
	}
	
	protected $messages = [
		'decree.required'	=> 'Nomor SK tidak boleh kosong.',
		'decree.unique'	=> 'Nomor SK sudah terdaftar.',
		'signed_at.required'	=> 'Tanggal perizinan tidak boleh kosong.',
		'signed_at.date_format'	=> 'Format penulisan tanggal salah.',
		'started_at.required'	=> 'Tanggal mulai tidak boleh kosong.',
		'started_at.date_format'	=> 'Format penulisan tanggal salah.',
		'ended_at.date_format'	=> 'Format penulisan tanggal salah.',
	];
	
	public function mount($id){
		$assignment = Userassignment::find($id);
		$this->categories = Userassignment::assignmentOptions();
		$this->assignment = $assignment;
		$this->signed_at = $assignment->signed_at->format('d/m/Y');
		$this->decree = $assignment->decree;
		$this->category = $assignment->category;
		$this->description = $assignment->description;
		$this->started_at = $assignment->started_at->format('d/m/Y');
		$this->ended_at = $assignment->ended_at ? $assignment->ended_at->format('d/m/Y') : null;
		
		$this->teacher = $assignment->user;
	}

	public function update(){
		$this->validate();
		$ended_at = null;
		if($this->ended_at) $ended_at = Carbon::createFromFormat('d/m/Y', $this->ended_at)->format('Y-m-d');
		$this->assignment->update([
			'category'	=> $this->category,
			'decree'	=> $this->decree,
			'description'	=> $this->description,
			'signed_at'	=> Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'),
			'started_at'	=> Carbon::createFromFormat('d/m/Y', $this->started_at)->format('Y-m-d'),
			'ended_at'	=> $ended_at,
		]);
		$this->emit('saved');
	}
	
	public function render()
	{
		return view('livewire.attendance.assignment.edit');
	}
}