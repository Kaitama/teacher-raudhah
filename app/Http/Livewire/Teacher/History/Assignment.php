<?php

namespace App\Http\Livewire\Teacher\History;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userassignment;
use App\Models\User;

class Assignment extends Component
{
	use WithPagination;
	
	public $user, $categories;
	
	public function mount($id){
		$this->user = User::find($id);
		$this->categories = Userassignment::assignmentOptions();
	}
	
	public function render()
	{
		$assignments = $this->user->assignments()->orderByDesc('signed_at')->paginate(10);
		return view('livewire.teacher.history.assignment', ['assignments' => $assignments]);
	}
}