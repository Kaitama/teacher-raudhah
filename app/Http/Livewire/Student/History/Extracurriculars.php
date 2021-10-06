<?php

namespace App\Http\Livewire\Student\History;

use Livewire\Component;
use Livewire\WithPagination;

class Extracurriculars extends Component
{
	use WithPagination;
	
	public $student;
	
	public function render()
	{
		$extracurriculars = $this->student->extracurriculars()->orderByDesc('joindate')->paginate(10, ['*'], 'extracurriculars');
		return view('livewire.student.history.extracurriculars', ['extracurriculars' => $extracurriculars]);
	}
}