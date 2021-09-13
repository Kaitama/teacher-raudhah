<?php

namespace App\Http\Livewire\Teacher\History;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userevaluation;
use App\Models\User;

class Evaluation extends Component
{
	use WithPagination;
	
	public $user, $categories;
	
	public function mount($id){
		$this->user = User::find($id);
		$this->categories = Userevaluation::categoryOptions();
	}

    public function render()
    {
			$evaluations = $this->user->evaluations()->orderByDesc('signed_at')->paginate(10);
        return view('livewire.teacher.history.evaluation', ['evaluations' => $evaluations]);
    }
}