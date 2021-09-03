<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use App\Models\User;

class Search extends Component
{
	public $search = '';
	public $teachers = [];
	public $ids = [];

	protected $listeners = [
		'removeTeacher' => 'unsetIdFromTeachers', 
		'resetTeachers' => 'unsetAllFromTeachers',
	];

	public function unsetIdFromTeachers($i){
		unset($this->ids[$i]);
	}

	public function unsetAllFromTeachers(){
		unset($this->ids);
		$this->ids = array();
	}
	
	public function render()
	{
		return view('livewire.teacher.search');
	}
	
	public function updatedSearch($teachers){
		$s = '%' . $this->search . '%';
		if(strlen($this->search) >= 3){
			$teachers = User::where('name', 'like', $s)
			->orWhere('email', 'like', $s)
			->orWhere('username', 'like', $s)
			->orWhereHas('nig', function($q) use($s){
				$q->where('number', 'like', $s);
			})
			->orWhereHas('profile', function($q) use($s){
				$q->where('phone', 'like', $s);
			})
			->has('nig')
			->role('guru')
			->with('nig')
			->with('profile')
			->get();
		} else {
			$teachers = [];
		}
		
		$this->teachers = $teachers;
	}
	
	public function sendTeacher(User $user){
		$this->emit('sendTeacher', $user);
		$this->ids[] = $user->id;
	}
	
	public function clearSearch(){
		$this->reset(['search', 'teachers']);
	}
	
}