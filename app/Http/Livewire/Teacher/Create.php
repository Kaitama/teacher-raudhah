<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TeacherNig;

class Create extends Component
{
	use WithPagination;

	public $addNIGModal = false, $deleteNIGModal = false, $editNIGModal = false;
	
	public $nigs, $nig, $data_edit, $number_to_update;
	
	protected $rules = [
		'nigs'	=> 'required',
	];
	
	protected $messages = [
		'nigs.required'	=> 'NIG tidak boleh kosong.',
	];
	
	public function render()
	{
		$data = TeacherNig::orderByDesc('created_at')->orderBy('number')->paginate(25);
		return view('livewire.teacher.create', ['data' => $data]);
	}
	
	public function create(){
		$this->validate();
		// sanitize and convert nigs to array
		$nigs = $this->nigs;
		$trim_spaces = str_replace(' ', '', $nigs);
		$nigs_to_array = explode(',', $trim_spaces);
		$nigs_filter = array_filter($nigs_to_array, function($value){return !is_null($value) && $value !== '';});
		$nigs_array = array_values($nigs_filter);
		
		foreach ($nigs_array as $nig) {
			if(!TeacherNig::where('number', $nig)->first()){
				TeacherNig::create([
					'number'	=> $nig,
				]);
			}
		}
		
		$this->reset('nigs');
		$this->emit('saved');
		
	}

	public function editing(TeacherNig $nig){
		$this->data_edit = $nig;
		$this->number_to_update = $nig->number;
		$this->editNIGModal = true;
	}

	public function update(){
		$this->validate([
			'number_to_update' => 'required|unique:teacher_nigs,number,' . $this->data_edit->id,
		], [
			'number_to_update.required'	=> 'NIG tidak boleh kosong.',
			'number_to_update.unique'	=> 'NIG sudah terdaftar.'
		]);
		$this->data_edit->update([
			'number'	=> $this->number_to_update,
		]);
		$this->reset('data_edit', 'number_to_update', 'editNIGModal');
	}

	public function confirmDelete(TeacherNig $nig){
		$this->nig = $nig;
		$this->deleteNIGModal = true;
	}

	public function destroy(){
		$this->nig->delete();
		$this->reset('nig');
		$this->deleteNIGModal = false;
	}
}