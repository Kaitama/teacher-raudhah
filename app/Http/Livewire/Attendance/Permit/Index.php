<?php

namespace App\Http\Livewire\Attendance\Permit;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userpermit;

class Index extends Component
{
	use WithPagination;
	public $categories;
	public $search, $perpage = 25;
	public $item;
	public $modal_confirmation = false;
	
	public function mount(){
		$this->categories = Userpermit::permitOptions();
	}
	
	public function render()
	{
		$s = '%' . $this->search . '%';
		if(strlen($this->search) >= 3){
			$permits = Userpermit::where('description', 'like', $s)
			->orWhereHas('user', function($q) use($s){
				$q->where('name', 'like', $s);
			})
			->orWhereHas('user.nig', function($q) use($s){
				$q->where('number', 'like', $s);
			})
			->with('user.nig')
			->with('user')
			->orderByDesc('signed_at')
			->orderByDesc('created_at')
			->paginate($this->perpage);
		} else {
			$permits = Userpermit::with(['user', 'user.nig'])->orderByDesc('signed_at')->orderByDesc('created_at')->paginate($this->perpage);
		}
		return view('livewire.attendance.permit.index', ['permits' => $permits]);
	}

	public function confirmDelete(Userpermit $permit){
		$this->item = $permit;
		$this->modal_confirmation = true;
	}

	public function destroy(){
		$this->item->delete();
		$this->modal_confirmation = false;
	}
}