<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

class Parents extends Component
{
	public $profile;
	
	protected $rules = [
		'profile.fname'	=> 'required',
		'profile.fphone'	=> 'nullable',
		'profile.fstatus'	=> 'required',
		'profile.mname'	=> 'required',
		'profile.mphone'	=> 'nullable',
		'profile.mstatus'	=> 'required',
		'profile.paddress' => 'nullable',
	];

	protected $messages = [
		'profile.fname.required' => 'Nama ayah tidak boleh kosong.',
		'profile.mname.required' => 'Nama ibu tidak boleh kosong.',
	];

	public function render()
	{
		return view('livewire.setting.parents');
	}

	public function save(){
		$this->validate();
		$this->profile->save();
		$this->emit('saved');
	}
}