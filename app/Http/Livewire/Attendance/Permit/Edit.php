<?php

namespace App\Http\Livewire\Attendance\Permit;

use Livewire\Component;
use App\Models\Userpermit;
use App\Models\User;
use Carbon\Carbon;

class Edit extends Component
{
	public $permit, $categories, $signed_at, $category = 1, $description, $started_at, $ended_at;
	public $teacher, $ids = [];

	protected $rules = [
		'signed_at'	=> 'required|date_format:d/m/Y',
		'started_at'	=> 'required|date_format:d/m/Y',
		'ended_at'	=> 'required|date_format:d/m/Y',
	];

	protected $messages = [
		'signed_at.required'	=> 'Tanggal perizinan tidak boleh kosong.',
		'signed_at.date_format'	=> 'Format penulisan tanggal salah.',
		'started_at.required'	=> 'Tanggal mulai tidak boleh kosong.',
		'started_at.date_format'	=> 'Format penulisan tanggal salah.',
		'ended_at.required'	=> 'Tanggal berakhir tidak boleh kosong.',
		'ended_at.date_format'	=> 'Format penulisan tanggal salah.',
	];

	public function mount($id)
	{
		$permit = Userpermit::find($id);
		$this->categories = Userpermit::permitOptions();
		$this->permit = $permit;
		$this->signed_at = $permit->signed_at->format('d/m/Y');
		$this->category = $permit->category;
		$this->description = $permit->description;
		$this->started_at = $permit->started_at->format('d/m/Y');
		$this->ended_at = $permit->ended_at->format('d/m/Y');

		$this->teacher = $permit->user;
	}

	public function update()
	{
		$this->validate();
		$this->permit->update([
			'signed_at'	=> Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'),
			'category'	=> $this->category,
			'description'	=> $this->description,
			'started_at'	=> Carbon::createFromFormat('d/m/Y', $this->started_at)->format('Y-m-d'),
			'ended_at'	=> Carbon::createFromFormat('d/m/Y', $this->ended_at)->format('Y-m-d'),
		]);
		$this->emit('saved');
	}

	public function render()
	{
		return view('livewire.attendance.permit.edit');
	}
}