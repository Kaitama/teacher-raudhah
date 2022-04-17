<?php

namespace App\Http\Livewire\Scoring\Edit;

use App\Models\Assignmentscore;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Assignment extends Component
{
	public $teacher, $item_id, $scored_at, $score, $description, $activity;

	protected $rules = [
		'scored_at'	=> 'required|date_format:d/m/Y',
		'activity'	=> 'required',
		'score'	=> 'required|integer|min:0|max:100',
	];

	protected $messages = [
		'scored_at.required'	=> 'Tanggal penilaian tidak boleh kosong.',
		'scored_at.date_format'	=> 'Format penulisan tanggal salah.',
		'activity.required'	=> 'Nama kegiatan tidak boleh kosong.',
		'score.required'	=> 'Nilai tidak boleh kosong.',
		'score.integer'	=> 'Nilai harus berupa angka.',
		'score.min'	=> 'Nilai tidak lebih kecil dari 0.',
		'score.max'	=> 'Nilai tidak lebih besar dari 100.',
	];

	public function mount($id, $score)
	{
		$this->teacher = User::find($id);
		$scored = Assignmentscore::find($score);
		$this->setData($scored);
	}

	private function setData($scored)
	{
		$this->item_id = $scored->id;
		$this->scored_at = $scored->scored_at->format('d/m/Y');
		$this->activity = $scored->activity;
		$this->score = $scored->score;
		$this->description = $scored->description;
	}

	public function update()
	{

		Assignmentscore::find($this->item_id)->update([
			'scored_at'	=> Carbon::createFromFormat('d/m/Y', $this->scored_at)->format('Y-m-d'),
			'activity'	=> $this->activity,
			'score'	=> $this->score,
			'description'	=> $this->description,
		]);
		$this->emit('saved');
	}

	public function render()
	{
		return view('livewire.scoring.edit.assignment');
	}
}