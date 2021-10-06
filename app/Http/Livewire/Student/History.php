<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class History extends Component
{
	use WithPagination;
	
	public $student;
	
	public function mount($id){
		$this->student = Student::where('id', $id)
		->with('classroom')
		->with('dormroom')
		->first();
	}
	
	public function render()
	{
		return view('livewire.student.history');
	}
}