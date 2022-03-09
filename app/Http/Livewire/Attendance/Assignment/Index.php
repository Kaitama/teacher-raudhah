<?php

namespace App\Http\Livewire\Attendance\Assignment;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userassignment;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
	use WithPagination;

	public $item, $search, $perpage = 25;
	public $modal_confirmation = false;
	public $categories;

	public function mount()
	{
		$this->categories = Userassignment::assignmentOptions();
	}

	public function render()
	{
		$s = '%' . $this->search . '%';
		if (strlen($this->search) >= 3) {
			$assignments = Userassignment::where('decree', 'like', $s)
				->orwhere('description', 'like', $s)
				->orWhereHas('user', function ($q) use ($s) {
					$q->where('name', 'like', $s);
				})
				->with('user')
				->orderByDesc('signed_at')
				->orderByDesc('created_at')
				->get();
		} else {
			$assignments = Userassignment::with('user')->orderByDesc('signed_at')->orderByDesc('created_at')->get();
		}

		// creating pagination
		$items = $assignments->forPage($this->page, $this->perpage)->values();
		$assignments = new LengthAwarePaginator($items, $assignments->count(), $this->perpage, $this->page);


		return view('livewire.attendance.assignment.index', ['assignments' => $assignments]);
	}

	public function confirmDelete(Userassignment $assignment)
	{
		$this->item = $assignment;
		$this->modal_confirmation = true;
	}

	public function destroy()
	{
		$this->item->delete();
		$this->modal_confirmation = false;
	}
}