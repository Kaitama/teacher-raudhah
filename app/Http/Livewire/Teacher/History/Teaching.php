<?php

namespace App\Http\Livewire\Teacher\History;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userteaching;
use App\Models\User;

class Teaching extends Component
{
	use WithPagination;
	
	public $user, $categories;
	
	public function mount($id){
		$this->user = User::find($id);
		$this->categories = Userteaching::categoryOptions();
	}
	
	public function render()
	{
		$teachings = $this->user->teachings()->orderByDesc('signed_at')->paginate(10);
		return view('livewire.teacher.history.teaching', ['teachings' => $teachings]);
	}
}