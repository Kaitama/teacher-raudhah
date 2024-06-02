<?php

namespace App\Http\Livewire\Teacher\Details;

use Livewire\Component;

class Data1 extends Component
{
	public $teacher;
    public $photo;
	public function render()
	{
		return view('livewire.teacher.details.data1');
	}
}
