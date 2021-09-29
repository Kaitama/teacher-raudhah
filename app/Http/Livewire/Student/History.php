<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\Student;

class History extends Component
{
	public $student;
	
	public function mount($id){
		$this->student = Student::where('id', $id)
		->with('tuitions')
		->with('achievements')
		->with('classroom')
		->with('dormroom')
		->with('offenses')
		->with('permits')
		->with('organizations')
		->with('extracurriculars')
		->first();
	}
    public function render()
    {
        return view('livewire.student.history');
    }
}