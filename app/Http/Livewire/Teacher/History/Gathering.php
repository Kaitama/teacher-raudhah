<?php

namespace App\Http\Livewire\Teacher\History;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gathering as Gath;
use App\Models\User;

class Gathering extends Component
{
	use WithPagination;

	public $user;
	
	public function mount($id){
		$this->user = User::find($id);
	}

	public function render()
	{
		$gatherings = $this->user->gatherings()->orderByDesc('held_at')->paginate(10);
		return view('livewire.teacher.history.gathering', ['gatherings' => $gatherings]);
	}
}