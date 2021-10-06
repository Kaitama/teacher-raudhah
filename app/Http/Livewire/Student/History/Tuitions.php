<?php

namespace App\Http\Livewire\Student\History;

use Livewire\Component;
use Livewire\WithPagination;

class Tuitions extends Component
{
	use WithPagination;
	
	public $student;

    public function render()
    {
			$tuitions = $this->student->tuitions()->orderByDesc('foryear')->orderByDesc('formonth')->paginate(10);
        return view('livewire.student.history.tuitions', ['tuitions' => $tuitions]);
    }
}