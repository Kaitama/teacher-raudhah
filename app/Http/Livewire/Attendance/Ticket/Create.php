<?php

namespace App\Http\Livewire\Attendance\Ticket;

use App\Models\Userticket;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{

	public $teachers, $saved_at, $session, $description;

	protected $listeners = ['sendTeacher' => 'setTeachers'];

	protected $rules = [
		'saved_at'	=> 'required|date_format:d/m/Y',
		'teachers'	=> 'required',
		'session'		=> 'required|integer|min:0',
		'description'	=> 'nullable',
	];

	protected $validationAttributes = [
		'saved_at'	=> 'Tanggal',
		'teachers'	=> 'Guru',
		'session'		=> 'Jumlah Les',
	];

	protected $messages = [
		'*.required' => 'Kolom :attribute tidak boleh kosong.',
		'*.date_format'	=> 'Format :attribute tidak valid.',
		'*.integer'	=> 'Kolom :attribute hanya boleh diisi angka.',
		'*.min'	=> 'Data kolom :attribute tidak valid.',
	];

	public function setTeachers($teachers)
	{
		if (!empty($this->teachers)) {
			$this->remove(array_key_first($this->teachers));
		}
		$this->teachers[] = $teachers;
	}

	public function remove($i)
	{
		unset($this->teachers[$i]);
		$this->emit('removeTeacher', $i);
	}

	private function prepareDates()
	{
		$this->saved_at = Carbon::today()->format('d/m/Y');
	}

	public function mount()
	{
		$this->prepareDates();
	}

	public function save()
	{
		$this->validate();

		Userticket::create([
			'user_id'	=> $this->teachers[0]['id'],
			'saved_at'	=> Carbon::createFromFormat('d/m/Y', $this->saved_at)->format('Y-m-d'),
			'session'	=> $this->session,
			'description'	=> $this->description,
		]);

		$this->reset(['session', 'description', 'teachers']);
		$this->prepareDates();
		$this->emit('resetTeachers');
		$this->emit('saved');
	}

	public function render()
	{
		return view('livewire.attendance.ticket.create');
	}
}