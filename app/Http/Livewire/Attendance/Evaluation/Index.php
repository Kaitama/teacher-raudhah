<?php

namespace App\Http\Livewire\Attendance\Evaluation;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userevaluation;

class Index extends Component
{
	use WithPagination;
	
	public $categories;
	public $search, $perpage = 25;
	public $item;
	public $modal_confirmation = false;
	
	public function mount(){
		$this->categories = Userevaluation::categoryOptions();
	}
	
	public function confirmDelete(Userevaluation $evaluation){
		$this->item = $evaluation;
		$this->modal_confirmation = true;
	}
	
	public function destroy(){
		$this->item->delete();
		$this->modal_confirmation = false;
	}
	
	public function render()
	{
		$s = '%' . $this->search . '%';
		if(strlen($this->search) >= 3){
			$evaluations = Userevaluation::where('description', 'like', $s)
			->orWhere('decree', 'like', $s)
			->orWhereHas('user', function($q) use($s){
				$q->where('name', 'like', $s);
			})
			->orWhereHas('user.nig', function($q) use($s){
				$q->where('number', 'like', $s);
			})
			->with('user.nig')
			->orderByDesc('signed_at')
			->orderByDesc('created_at')
			->paginate($this->perpage);
		} else {
			$evaluations = Userevaluation::with(['user', 'user.nig'])->orderByDesc('signed_at')->orderByDesc('created_at')->paginate($this->perpage);
		}
		return view('livewire.attendance.evaluation.index', ['evaluations' => $evaluations]);
	}
}