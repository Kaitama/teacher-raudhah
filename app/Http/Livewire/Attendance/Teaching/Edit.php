<?php

namespace App\Http\Livewire\Attendance\Teaching;

use Livewire\Component;
use App\Models\Userteaching;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
	public $teaching, $categories, $signed_at, $category, $description;
	public $teacher, $ids = [];

	protected $rules = [
		'signed_at'	=> 'required|date_format:d/m/Y',
	];

	protected $messages = [
		'signed_at.required'	=> 'Tanggal perizinan tidak boleh kosong.',
		'signed_at.date_format'	=> 'Format penulisan tanggal salah.',
	];

	public function mount($id)
	{
		$teaching = Userteaching::find($id);
		if (Auth::id() != $teaching->checker->id) {
			if (!Auth::user()->hasAnyRole(['developer', 'administrator', 'admin akademik'])) {
				return abort(403);
			}
		}
		$this->categories = Userteaching::categoryOptions();
		$this->teaching = $teaching;
		$this->signed_at = $teaching->signed_at->format('d/m/Y');
		$this->category = $teaching->category;
		$this->description = $teaching->description;

		$this->teacher = $teaching->user;
	}

	public function update()
	{
		// dd(Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'));
		$this->validate();
		$this->teaching->update([
			'signed_at'	=> Carbon::createFromFormat('d/m/Y', $this->signed_at)->format('Y-m-d'),
			'category'	=> $this->category,
			'description'	=> $this->description,
		]);
		if (!$this->teaching->checker) {
			$this->teaching->update([
				'checked_by'	=> Auth::id(),
			]);
		}
		$this->emit('saved');
	}

	public function render()
	{
		return view('livewire.attendance.teaching.edit');
	}
}