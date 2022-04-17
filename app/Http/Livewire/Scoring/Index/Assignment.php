<?php

namespace App\Http\Livewire\Scoring\Index;

use App\Models\Assignmentscore;
use Livewire\Component;
use Livewire\WithPagination;

class Assignment extends Component
{
	use WithPagination;
	public $perpage = 10, $teacher, $item, $confirmation_modal = false;

	public function mount($teacher)
	{
		$this->teacher = $teacher;
	}

	public function confirmDelete($id)
	{
		$this->item = Assignmentscore::find($id);
		$this->confirmation_modal = true;
	}

	public function destroy()
	{
		$this->item->delete();
		$this->confirmation_modal = false;
	}

	public function render()
	{
		$assignment_scores = Assignmentscore::where('user_id', $this->teacher->id)
			->orderByDesc('scored_at')
			->orderByDesc('created_at')
			->paginate($this->perpage);

		return view('livewire.scoring.index.assignment', [
			'assignment_scores' => $assignment_scores,
			'score_ranges' => Assignmentscore::scoreRange(),
		]);
	}
}