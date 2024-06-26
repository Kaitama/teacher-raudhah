<?php

namespace App\Http\Livewire\Scoring\Index;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Managementscore;

class Management extends Component
{
	use WithPagination;

	public $perpage = 10, $teacher, $categories, $item, $confirmation_modal = false;

	public function mount($teacher)
	{
		$this->teacher = $teacher;
		$this->categories = Managementscore::categoryOptions();
	}

	public function confirmDelete($id)
	{
		$this->item = Managementscore::find($id);
		$this->confirmation_modal = true;
	}

	public function destroy()
	{
		$this->item->delete();
		$this->confirmation_modal = false;
	}

	public function render()
	{
		$teacher_scores = Managementscore::where('user_id', $this->teacher->id)
			->orderByDesc('scored_at')
			->orderByDesc('created_at')
			->paginate($this->perpage);
		return view('livewire.scoring.index.management', [
			'teacher_scores' => $teacher_scores,
			'score_ranges'	=> Managementscore::scoreRange(),
		]);
	}
}