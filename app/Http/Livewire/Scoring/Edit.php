<?php

namespace App\Http\Livewire\Scoring;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Teachingscore;
use App\Models\Managementscore;

class Edit extends Component
{
	public $teacher, $score, $page = 1, $categories, $columns;

	public $scored_at, $description;

	protected $rules = [
		'scored_at'	=> 'required|date_format:d/m/Y',
		'columns.*'	=> 'required|integer|min:0|max:100',
	];

	protected $messages = [
		'scored_at.required'	=> 'Tanggal penilaian tidak boleh kosong.',
		'scored_at.date_format'	=> 'Format penulisan tanggal salah.',
		'columns.*.required'	=> 'Nilai tidak boleh kosong.',
		'columns.*.integer'	=> 'Nilai harus berupa angka.',
		'columns.*.min'	=> 'Nilai tidak lebih kecil dari 0.',
		'columns.*.max'	=> 'Nilai tidak lebih besar dari 100.',
	];
	
	public function mount($id, $score, $page){
		$this->teacher = User::find($id);
		if ($page == 1) {
			$this->score = Teachingscore::find($score);
			$this->categories = Teachingscore::categoryOptions();
		} else {
			$this->score = Managementscore::find($score);
			$this->categories = Managementscore::categoryOptions();
		}
		$this->page = $page;
		$this->scored_at = $this->score->scored_at->format('d/m/Y');
		$this->description = $this->score->description;
		$this->setData();
	}

	private function setData(){
		$this->columns = array();
		foreach ($this->categories as $key => $value) {
			$this->columns[$key] = $this->score->$key;
		}
	}

	public function update(){
		$this->validate();
		$this->columns['scored_at'] = Carbon::createFromFormat('d/m/Y', $this->scored_at)->format('Y-m-d');
		$this->columns['description'] = $this->description;
		$this->score->update($this->columns);
		$this->setData();
		$this->emit('saved');
	}
	
	public function render()
	{
		return view('livewire.scoring.edit');
	}
}