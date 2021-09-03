<?php

namespace App\Http\Livewire\Attendance\Gathering;

use Livewire\Component;
use App\Models\Gathering;
use App\Models\User;
use Carbon\Carbon;

class Show extends Component
{
	public $gath, $name, $held_at, $description;
	public $teachers = [];
	public $ids = [];
	
	
	public function mount($id){
		$gath = Gathering::find($id);
		$this->gath = $gath;
		$this->held_at = $gath->held_at;
		$this->name = $gath->name;
		$this->description = $gath->description;
		
		foreach ($gath->users as $u) {
			$this->teachers[] = $u;
			$this->ids[] = $u->id;
		}
	}
	
	
	public function render()
	{
		return view('livewire.attendance.gathering.show');
	}
}