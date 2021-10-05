<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

use App\Models\Usereducation;

class Educations extends Component
{
	public $userId;
	
	public $level = 5, $name, $faculty, $focus, $semester, $address, $in, $out, $certificate;
	
	public $add_education = false;
	
	public $listeners = ['refreshEducation' => 'render'];
	
	
	public function render()
	{
		$levels = Usereducation::educationLevels();
		$educations = Usereducation::where('user_id', $this->userId)->orderByDesc('in')->get();
		return view('livewire.setting.educations', ['educations' => $educations, 'levels' => $levels]);
	}
	
	public function create(){
		$this->validate([
			'name'	=> 'required',
			'in'	=> 'required|numeric|digits:4',
			'out'	=> 'nullable|numeric|digits:4',
			'semester'	=> 'nullable|numeric|digits_between:1,2'
		], [
			'name.required'	=> 'Nama sekolah tidak boleh kosong.',
			'in.required'	=> 'Tahun masuk tidak boleh kosong.',
			'in.numeric'	=> 'Tahun masuk tidak valid.',
			'in.digits'	=> 'Tahun masuk tidak valid.',
			'out.numeric'	=> 'Tahun keluar tidak valid.',
			'out.digits'	=> 'Tahun keluar tidak valid.',
			'semester.numeric'	=> 'Semester tidak valid.',
			'semester.digits_between'	=> 'Semester tidak valid.',
		]);
		
		Usereducation::create([
			'user_id'	=> $this->userId,
			'level'	=> $this->level,
			'name'	=> $this->name,
			'faculty'	=> $this->faculty,
			'focus'	=> $this->focus,
			'semester'	=> $this->semester,
			'address'	=> $this->address,
			'in'	=> $this->in,
			'out'	=> $this->out,
			'certificate'	=> $this->certificate,
		]);
		
		$this->add_education = false;
		$this->reset(['level', 'name', 'faculty', 'focus', 'semester', 'address', 'in', 'out', 'certificate']);
		$this->emit('refreshEducation');
	}

	public function destroy($id){
		Usereducation::find($id)->delete();
		$this->emit('refreshEducation');
	}
}