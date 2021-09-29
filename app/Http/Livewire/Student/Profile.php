<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\Student;

class Profile extends Component
{
	public $student;
	
	public function mount($id){
		$this->student = Student::where('id', $id)->with('profile')->first();
	}
	
	public function render()
	{
		return view('livewire.student.profile');
	}
}