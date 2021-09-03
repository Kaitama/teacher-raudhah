<?php

namespace App\Http\Livewire\Attendance\Gathering;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Gathering;

class Index extends Component
{
	use WithPagination;
	public $search, $perpage = 25;
	public $item;
	public $modal_confirmation = false;
	public function render()
	{
		$s = '%' . $this->search . '%';
		if(strlen($this->search) >= 3){
		$gatherings = Gathering::where('name', 'like', $s)
		->orWhere('description', 'like', $s)
		->with('users')
		->orderByDesc('held_at')
		->paginate($this->perpage);
		} else {
			$gatherings = Gathering::with('users')->orderByDesc('held_at')->paginate($this->perpage);
		}
		return view('livewire.attendance.gathering.index', ['gatherings' => $gatherings]);
	}

	public function confirmDelete(Gathering $gath){
		$this->item = $gath;
		$this->modal_confirmation = true;
	}

	public function destroy(){
		$this->item->delete();
		$this->modal_confirmation = false;
	}
}