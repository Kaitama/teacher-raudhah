<?php

namespace App\Http\Livewire\Attendance\Teaching;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Userteaching;

class Index extends Component
{
	use WithPagination;

	public $categories;
	public $search, $perpage = 25;
	public $item;
	public $modal_confirmation = false;
	public $order_by = 'created_at';
	public $sort = 'desc';

	public function mount()
	{
		$this->categories = Userteaching::categoryOptions();
	}

	public function confirmDelete(Userteaching $teaching)
	{
		$this->item = $teaching;
		$this->modal_confirmation = true;
	}

	public function destroy()
	{
		$this->item->delete();
		$this->modal_confirmation = false;
	}

	public function render()
	{
		$s = '%' . $this->search . '%';
		if (strlen($this->search) >= 3) {
			$teachings = Userteaching::where('description', 'like', $s)
				->orWhereHas('user', function ($q) use ($s) {
					$q->where('name', 'like', $s);
				})
				->with('user.nig')
				->with('checker')
				->orderBy($this->order_by, $this->sort)
				->paginate($this->perpage);
		} else {
			$teachings = Userteaching::with(['user', 'user.nig'])
				->with('checker')
				->orderBy($this->order_by, $this->sort)
				->paginate($this->perpage);
		}
		return view('livewire.attendance.teaching.index', ['teachings' => $teachings]);
	}
}