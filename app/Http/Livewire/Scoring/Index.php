<?php

namespace App\Http\Livewire\Scoring;

use Livewire\Component;
use App\Models\User;

class Index extends Component
{
	public $teacher;
	
	public function mount($id){
		$this->teacher = User::find($id);
	}
	public function render()
	{
		return view('livewire.scoring.index');
	}
}