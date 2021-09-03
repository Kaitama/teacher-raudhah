<?php

namespace App\Http\Livewire\Attendance\Evaluation;

use Livewire\Component;
use App\Models\Userevaluation;
use App\Models\User;
use Carbon\Carbon;

class Edit extends Component
{
	public $evaluation, $decree, $categories, $signed_at, $category = 1, $description;
	public $teacher, $ids = [];
	
	protected function rules()
	{
		return [
			'signed_at'	=> 'required|date_format:d/m/Y',
			'decree'	=> 'nullable|unique:userevaluations,decree,' . $this->evaluation->id,
		];
	}
	
	protected $messages = [
		'signed_at.required'	=> 'Tanggal perizinan tidak boleh kosong.',
		'signed_at.date_format'	=> 'Format penulisan tanggal salah.',
		'decree.unique'	=> 'Nomor SK sudah terdaftar.'
	];
	
	public function mount($id){
		$evaluation = Userevaluation::find($id);
		$this->categories = Userevaluation::categoryOptions();
		$this->evaluation = $evaluation;
		$this->signed_at = $evaluation->signed_at->format('d/m/Y');
		$this->decree = $evaluation->decree;
		$this->category = $evaluation->category;
		$this->description = $evaluation->description;
		
		$this->teacher = $evaluation->user;
	}
	
	public function update(){
		$this->validate();
		$this->evaluation->update([
			'category'	=> $this->category,
			'decree'	=> $this->decree,
			'description'	=> $this->description,
			'signed_at'	=> Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'),
		]);
		$this->emit('saved');
	}
	
	public function render()
	{
		return view('livewire.attendance.evaluation.edit');
	}
}