<?php

namespace App\Http\Livewire\Scoring\Create;

use App\Models\Assignmentscore;
use Carbon\Carbon;
use Livewire\Component;

class Assignment extends Component
{
	public $teacher, $score, $scored_at, $activity, $description;

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

	public function mount($teacher)
	{
		$this->teacher = $teacher;
		$this->setData();
	}

	private function setData()
	{
		$this->scored_at = Carbon::today()->format('d/m/Y');
		$this->score = 0;
		$this->activity = null;
		$this->description = null;
	}

	public function save()
	{
		$this->validate();

		Assignmentscore::create([
			'user_id'	=> $this->teacher->id,
			'scored_at'	=> Carbon::createFromFormat('d/m/Y', $this->scored_at)->format('Y-m-d'),
			'activity'	=> $this->activity,
			'score'	=> $this->score,
			'description'	=> $this->description,
		]);

		$this->setData();
		$this->emit('saved');
	}

	public function render()
	{
		return view('livewire.scoring.create.assignment');
	}
}