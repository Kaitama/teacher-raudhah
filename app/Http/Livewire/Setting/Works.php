<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

use App\Models\Userwork;

class Works extends Component
{

	public $userId, $add_work = false;

	public $name, $position, $description, $address, $in, $out;

	public $listeners = ['refreshWork' => 'render'];

	public function create(){
		$this->validate([
			'name'	=> 'required',
			'in'	=> 'required|numeric|digits:4',
			'out'	=> 'nullable|numeric|digits:4'
		], [
			'name.required'	=> 'Nama perusahaan tidak boleh kosong.',
			'in.required'	=> 'Tahun masuk tidak boleh kosong.',
			'in.numeric'	=> 'Tahun masuk tidak valid.',
			'in.digits'	=> 'Tahun masuk tidak valid.',
			'out.numeric'	=> 'Tahun keluar tidak valid.',
			'out.digits'	=> 'Tahun keluar tidak valid.'
		]);
		
		if($this->out == '') $this->out = null;

		Userwork::create([
			'user_id'	=> $this->userId,
			'name'	=> $this->name,
			'position'	=> $this->position ?? null,
			'description'	=> $this->description ?? null,
			'address'	=> $this->address ?? null,
			'in'	=> $this->in,
			'out'	=> $this->out ?? null,
		]);
		
		$this->add_work = false;
		$this->reset(['name', 'position', 'address', 'in', 'out', 'description']);
		$this->emit('refreshWork');
	}

	public function destroy($id){
		Userwork::find($id)->delete();
		$this->emit('refreshWork');
	}


	public function render()
	{
		$works = Userwork::where('user_id', $this->userId)->orderByDesc('in')->orderByDesc('created_at')->get();
		return view('livewire.setting.works', ['works' => $works]);
	}
}