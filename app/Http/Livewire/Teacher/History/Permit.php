<?php

namespace App\Http\Livewire\Teacher\History;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userpermit;
use App\Models\User;

class Permit extends Component
{
	use WithPagination;
	
	public $user, $categories;
	
	public function mount($id){
		$this->user = User::find($id);
		$this->categories = Userpermit::permitOptions();
	}
	
	public function render()
	{
		$permits = $this->user->permits()->orderByDesc('signed_at')->paginate(10);
		return view('livewire.teacher.history.permit', ['permits' => $permits]);
	}
}