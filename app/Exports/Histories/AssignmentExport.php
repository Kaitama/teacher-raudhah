<?php

namespace App\Exports\Histories;

use App\Models\Userassignment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssignmentExport implements FromView, WithTitle, WithStyles, ShouldAutoSize
{
	public $data, $categories;
	
	public function __construct($id){
		$this->data = Userassignment::where('user_id', $id)->get();
		$this->categories = Userassignment::assignmentOptions();
	}
	
	public function view(): View
	{
		return view('excel.histories.assignments', [
			'data' => $this->data,
			'categories'	=> $this->categories
		]);
	}

	public function title(): string
	{
		return 'PENUGASAN';
	}
	
	public function styles(Worksheet $sheet)
	{
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}
	
}