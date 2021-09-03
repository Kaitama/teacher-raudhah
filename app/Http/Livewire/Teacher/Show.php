<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use App\Models\User;

class Show extends Component
{

	public $teacher;

	public function mount($id){
		$this->teacher = User::where('id', $id)
		->with('profile')
		->with('partner')
		->with('childrens')
		->with('educations')
		->with('works')
		->first();
	}

	public function render()
	{
		return view('livewire.teacher.show');
	}
}