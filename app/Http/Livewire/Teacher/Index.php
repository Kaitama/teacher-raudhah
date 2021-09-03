<?php

namespace App\Http\Livewire\Teacher;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
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
	public $select_gender;
	public $perpage = 25;
	
	public function render()
	{
		
		$s = '%' . $this->search . '%';
		$teachers = null;
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
			$teachers = User::has('nig')->role('guru')->with('nig')->with('profile')->get();
		}

		// filter gender
		if($this->select_gender) {
			$teachers = $teachers->filter(function($colls){
				if($this->select_gender == 1) return $colls->profile->gender == true;
				elseif($this->select_gender == 2) return $colls->profile->gender == false;
				else return $colls;
			});
		}

		// creating pagination
		$items = $teachers->forPage($this->page, $this->perpage)->values();
		$teachers = new LengthAwarePaginator($items, $teachers->count(), $this->perpage, $this->page);

		return view('livewire.teacher.index', ['teachers' => $teachers]);
	}
	
	
}