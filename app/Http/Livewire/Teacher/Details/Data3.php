<?php

namespace App\Http\Livewire\Teacher\Details;

use Livewire\Component;
use App\Models\Usereducation;

class Data3 extends Component
{
	public $teacher;
	public function render()
	{
		$levels = Usereducation::educationLevels();
		return view('livewire.teacher.details.data3', ['levels' => $levels]);
	}
}