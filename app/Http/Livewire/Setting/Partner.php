<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Userchildren;


class Partner extends Component
{
	
	public $userId;
	public $partner;
	// public $childs;
	public $add_children = false;
	
	public $child_name, $child_gender = 1, $child_birthplace, $child_birthdate;

	public $listeners = ['refreshMe' => 'render'];
	
	protected $rules = [
		'partner.name' => 'nullable',
		'partner.phone'	=> 'nullable',
		'partner.education'	=> 'nullable',
		'partner.work'	=> 'nullable',
	];
	
	public function render()
	{
		$childs = Userchildren::where('user_id', $this->userId)->orderBy('birthdate')->get();
		return view('livewire.setting.partner', ['childs' => $childs]);
	}
	
	public function save(){
		$this->partner->update();
		$this->emit('saved');
	}
	
	public function saveChildren(){
		
		$this->validate([
			'child_name'	=> 'required',
			'child_gender'	=> 'required',
			'child_birthplace'	=> 'required',
			'child_birthdate'	=> 'required|date_format:d/m/Y',
		], [
			'child_name.required' => 'Nama anak tidak boleh kosong.',
			'child_birthplace.required' => 'Tempat lahir anak tidak boleh kosong.',
			'child_birthdate.required' => 'Tanggal lahir anak tidak boleh kosong.',
			'child_birthdate.date_format' => 'Format penulisan tanggal salah.',
		]);

		Userchildren::create([
			'user_id'	=> $this->userId,
			'name'	=> $this->child_name,
			'gender'	=> $this->child_gender,
			'birthplace'	=> $this->child_birthplace,
			'birthdate'	=> Carbon::createFromFormat('d/m/Y', $this->child_birthdate)->toDateTimeString(),
		]);
		$this->add_children = false;
		$this->reset(['child_name', 'child_gender', 'child_birthplace', 'child_birthdate']);
		$this->emit('refreshMe');
	}

	public function deleteChildren(Userchildren $child){
		$child->delete();
		$this->emit('refreshMe');
	}
	
}