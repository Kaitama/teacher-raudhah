<?php

namespace App\Http\Livewire\Student\History;

use Livewire\Component;
use Livewire\WithPagination;

class Achievements extends Component
{
	use WithPagination;
	
	public $student;

    public function render()
    {
			$achievements = $this->student->achievements()->orderByDesc('date')->paginate(10, ['*'], 'achievements');
        return view('livewire.student.history.achievements', ['achievements' => $achievements]);
    }
}