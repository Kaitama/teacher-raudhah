<?php

namespace App\Http\Livewire\Student\History;

use Livewire\Component;
use Livewire\WithPagination;

class Permits extends Component
{
	use WithPagination;
	
	public $student;
	
	public function render()
	{
		$permits = $this->student->permits()->orderByDesc('signdate')->paginate(10, ['*'], 'permits');
		return view('livewire.student.history.permits', ['permits' => $permits]);
	}
}