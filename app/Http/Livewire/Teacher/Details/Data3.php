<?php

namespace App\Http\Livewire\Teacher\Details;

use Livewire\Component;

class Data3 extends Component
{
	public $teacher;
	public $educations_level = ['TK', 'SD/MI', 'SMP/MTs', 'SMA/MA', 'S1', 'S2', 'S3'];
	public function render()
	{
		return view('livewire.teacher.details.data3');
	}
}