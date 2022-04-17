<?php

namespace App\Http\Livewire\Scoring;

use Livewire\Component;
use App\Models\User;

class Create extends Component
{
	public $teacher;

	public function mount($id)
	{
		$this->teacher = User::find($id);
	}

	public function render()
	{
		return view('livewire.scoring.create');
	}
}