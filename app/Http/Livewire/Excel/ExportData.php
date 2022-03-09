<?php

namespace App\Http\Livewire\Excel;

use Livewire\Component;
use Carbon\Carbon;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportData extends Component
{
	public $s_date, $e_date, $data_options = [], $all_options = true;

	protected $rules = [
		's_date'	=> 'required|date_format:d/m/Y',
		'e_date'	=> 'required|date_format:d/m/Y',
		'data_options'	=> 'required',
	];

	protected $messages = [
		's_date.required'	=> 'Tanggal tidak boleh kosong.',
		's_date.date_format'	=> 'Format tanggal tidak valid.',
		'e_date.required'	=> 'Tanggal tidak boleh kosong.',
		'e_date.date_format'	=> 'Format tanggal tidak valid.',
		'data_options.required'	=> 'Minimal pilih satu data absensi.',
	];

	public function mount()
	{
		$this->s_date = Carbon::yesterday()->format('d/m/Y');
		$this->e_date = Carbon::today()->format('d/m/Y');
		$this->data_options = ['1', '2', '3', '4', '5', '6', '7'];
	}

	public function render()
	{
		return view('livewire.excel.export-data');
	}

	public function toggleOptions()
	{
		$this->all_options = !$this->all_options;
		if ($this->all_options)  $this->data_options = ['1', '2', '3', '4', '5', '6', '7'];
		else $this->data_options = [];
	}

	public function toggleRecaps()
	{
		$this->recaps = !$this->recaps;
	}

	public function checkOptions()
	{
		if (count($this->data_options) == 7) $this->all_options = true;
		else $this->all_options = false;
	}

	public function exportExcel()
	{
		$this->validate();
		$export = new AbsensiExport($this->data_options, $this->s_date, $this->e_date);

		return Excel::download($export, 'ABSENSI_GURU_' . time() . '.xlsx');
	}
}