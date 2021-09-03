<?php

namespace App\Http\Livewire\Attendance\Gathering;

use Livewire\Component;
use App\Models\Gathering;
use App\Models\User;
use Carbon\Carbon;

class Edit extends Component
{
	public $gath, $name, $held_at, $description;
	public $teachers;
	public $ids = [];
	
	protected $listeners = ['sendTeacher' => 'setTeachers'];
	
	protected $rules = [
		'held_at'	=> 'required|date_format:d/m/Y',
		'name'	=> 'required',
	];
	
	protected $messages = [
		'held_at.required'	=> 'Tanggal kegiatan tidak boleh kosong.',
		'held_at.date_format'	=> 'Format penulisan tanggal salah.',
		'name.required'	=> 'Nama kegiatan tidak boleh kosong.',
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
		if(!empty($this->teachers)) {
			$ids = array();
			foreach ($this->teachers as $t) {
				$ids[] = $t['id'];
			}
			$this->gath->users()->sync($ids);
		} else {
			$this->gath->users()->detach();
		}
		$this->emit('saved');
	}
	
	public function render()
	{
		return view('livewire.attendance.gathering.edit');
	}
}