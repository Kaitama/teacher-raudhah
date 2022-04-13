<?php

namespace App\Http\Livewire\Attendance\Teaching;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Userteaching;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
	public $categories, $signed_at, $category = 4, $description;
	public $teachers;

	protected $listeners = ['sendTeacher' => 'setTeachers'];

	protected $rules = [
		'signed_at'	=> 'required|date_format:d/m/Y',
		'teachers'	=> 'required',
	];

	protected $messages = [
		'signed_at.required'	=> 'Tanggal perizinan tidak boleh kosong.',
		'signed_at.date_format'	=> 'Format penulisan tanggal salah.',
		'teachers.required'	=> 'Guru yang izin tidak boleh kosong.',
	];

	public function setTeachers($teachers)
	{
		if (!empty($this->teachers)) {
			$this->remove(array_key_first($this->teachers));
		}
		$this->teachers[] = $teachers;
	}

	public function mount()
	{
		$this->categories = Userteaching::categoryOptions();

		$this->prepareDates();
	}

	private function prepareDates()
	{
		$this->signed_at = Carbon::today()->format('d/m/Y');
	}

	public function remove($i)
	{
		unset($this->teachers[$i]);
		$this->emit('removeTeacher', $i);
	}

	public function save()
	{

		$this->validate();

		foreach ($this->teachers as $teacher) {
			Userteaching::create([
				'user_id'	=> $teacher['id'],
				'checked_by'	=> Auth::id(),
				'category'	=> $this->category,
				'description'	=> $this->description,
				'signed_at'	=> Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'),
			]);
		}
		$this->reset(['category', 'description', 'teachers']);
		$this->prepareDates();
		$this->emit('resetTeachers');
		$this->emit('saved');
	}

	public function render()
	{
		return view('livewire.attendance.teaching.create');
	}
}