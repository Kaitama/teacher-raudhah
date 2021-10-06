<?php

namespace App\Http\Livewire\Student\History;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentOrganization;

class Organizations extends Component
{
	use WithPagination;
	
	public $student;
	
	public function render()
	{
		$positions = StudentOrganization::position();
		$organizations = $this->student->organizations()->orderByDesc('joindate')->paginate(10, ['*'], 'organizations');
		return view('livewire.student.history.organizations', ['organizations' => $organizations, 'positions' => $positions]);
	}
}