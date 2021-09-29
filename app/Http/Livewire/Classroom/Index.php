<?php

namespace App\Http\Livewire\Classroom;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Student;

class Index extends Component
{
	public $classroom, $students;

	public function mount($id){
		$this->classroom = Classroom::find($id);
		$this->students = Student::where('classroom_id', $id)->with('dormroom')->orderBy('name')->get();
	}
    public function render()
    {
        return view('livewire.classroom.index');
    }
}