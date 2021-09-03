<?php

namespace App\Http\Livewire\Scoring\Create;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Teachingscore;

class Teachery extends Component
{
	public $teacher, $categories, $scored_at, $columns, $description;

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
	
	public function mount($teacher){
		$this->teacher = $teacher;
		$this->categories = Teachingscore::categoryOptions();
		$this->setData();
	}

	private function setData(){
		$this->scored_at = Carbon::today()->format('d/m/Y');
		$this->columns = array();
		foreach ($this->categories as $key => $value) {
			$this->columns[$key] = 0;
		}
	}

	public function save(){
		
		$this->validate();
		$this->columns['user_id'] = $this->teacher->id;
		$this->columns['scored_at'] = Carbon::createFromFormat('d/m/Y', $this->scored_at)->format('Y-m-d');
		$this->columns['description'] = $this->description;

		// dd($this->columns);
		Teachingscore::create($this->columns);

		$this->setData();
		$this->reset(['description']);
		$this->emit('saved');

	}
	
	public function render()
	{
		// dd($this->columns);
		return view('livewire.scoring.create.teachery');
	}
}