<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

class Hobbies extends Component
{
	
	public $profile;
	
	protected $rules = [
		'profile.arts'	=> 'nullable',
		'profile.sports'	=> 'nullable',
		'profile.organizations'	=> 'nullable',
		'profile.others'	=> 'nullable',
	];
	
	public function render()
	{
		return view('livewire.setting.hobbies');
	}

	public function save(){
		$this->validate();
		$this->profile->save();
		$this->emit('saved');
	}
}