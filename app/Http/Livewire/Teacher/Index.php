<?php

namespace App\Http\Livewire\Teacher;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Index extends Component
{
	use WithPagination;
	
	public $confirm_delete = false;
	public $user;
	public $alert;
	public $search;
	public $perpage = 25;
	
	public function render()
	{
		
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
			->paginate($this->perpage);
		} else {
			$teachers = User::has('nig')->role('guru')->with('nig')->with('profile')->paginate($this->perpage);
		}
		return view('livewire.teacher.index', ['teachers' => $teachers]);
	}
	
	
}