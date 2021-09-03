<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Auth;
use App\Models\Profile;

class UpdateBiodataInformationForm extends Component
{
	public $profile = [];

	public function mount(){
		$profile = Auth::user()->profile;
		if(!$profile) {
			$profile = Profile::create([
				'user_id'	=> Auth::id(),
			]);
		}
		$this->profile = $profile->toArray();
	}

	public function render()
	{
		return view('livewire.profile.update-biodata-information-form');
	}

	public function updateBiodataInformation(){
		Auth::user()->profile->update([
			'phone'	=> $this->profile['phone'],
		]);

		$this->emit('saved');
	}
}