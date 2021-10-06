<?php

namespace App\Http\Livewire\Student\History;

use Livewire\Component;
use Livewire\WithPagination;

class Offenses extends Component
{
	use WithPagination;
	
	public $student;
	
	public function render()
	{
		$offenses = $this->student->offenses()->orderByDesc('date')->paginate(10, ['*'], 'offenses');
		return view('livewire.student.history.offenses', ['offenses' => $offenses]);
	}
}