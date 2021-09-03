<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\TeacherNig;
use App\Models\User;

class Index extends Component
{
	public $user;
	// public $user_nig;
	public $modal_set_nig = false;
	public $nig;

	protected $rules = [
		'nig'	=> 'required|exists:teacher_nigs,number',
	];

	protected $messages = [
		'nig.required'	=> 'NIG tidak boleh kosong.',
		'nig.exists'	=> 'NIG tidak terdaftar.'
	];

	// public function mount(){
	// 	$this->user_nig = $this->user->nig()->exists();
	// }

	public function render()
	{
		$user_nig = $this->user->nig;
		return view('livewire.dashboard.index', ['user_nig' => $user_nig]);
	}

	public function setNig(){
		$this->resetErrorBag();
		$this->validate();
		$teacher_nig = TeacherNig::where('number', $this->nig)->where('user_id', null)->first();
		
		if($teacher_nig){
			$teacher_nig->update([
				'user_id'	=> $this->user->id,
			]);
			$this->reset('nig');
			$this->modal_set_nig = false;
			return redirect()->route('dashboard');
		} else {
			$this->addError('nig', 'NIG telah terdaftar pada akun lain.');
		}
	}
}