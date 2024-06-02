<?php

namespace App\Http\Livewire\Teacher;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\User;

class Show extends Component
{

	public $teacher;

    public $photo;

	public function mount($id){
		$this->teacher = User::where('id', $id)
		->with('profile')
		->with('partner')
		->with('childrens')
		->with('educations')
		->with('works')
		->first();

        if ($this->teacher) {
            $response = Http::get('https://sisfo.raudhah.ac.id/api/user/' . $this->teacher->nig->number . '/profile-picture')->json();

            if ($response && $response['success']) {
                $this->photo = $response['photo'];
            } else {
                $this->photo = url(asset('img/nopic.png'));
            }
        }
	}

	public function render()
	{
		return view('livewire.teacher.show');
	}
}
