<?php

namespace App\Exports\Histories;

use App\Models\Userteaching;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TeachingExport implements FromView, WithTitle, WithStyles, ShouldAutoSize
{
	public $data, $categories;
	
	public function __construct($id){
		$this->data = Userteaching::where('user_id', $id)->get();
		$this->categories = Userteaching::categoryOptions();
	}
	
	public function view(): View
	{
		return view('excel.histories.teaching', [
			'data' => $this->data,
			'categories'	=> $this->categories
		]);
	}

	public function title(): string
	{
		return 'PENGAJARAN';
	}
	
	public function styles(Worksheet $sheet)
	{
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}
}