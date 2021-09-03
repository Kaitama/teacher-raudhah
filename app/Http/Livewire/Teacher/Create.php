<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TeacherNig;

class Create extends Component
{
	use WithPagination;

	public $addNIGModal = false;
	
	public $nigs;
	
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
}