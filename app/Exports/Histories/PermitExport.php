<?php

namespace App\Exports\Histories;

use App\Models\Userpermit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PermitExport implements FromView, WithTitle, WithStyles, ShouldAutoSize
{
	public $data, $categories;
	
	public function __construct($id){
		$this->data = Userpermit::where('user_id', $id)->get();
		$this->categories = Userpermit::permitOptions();
	}
	
	public function view(): View
	{
		return view('excel.histories.permit', [
			'data' => $this->data,
			'categories'	=> $this->categories
		]);
	}

	public function title(): string
	{
		return 'PERIZINAN';
	}
	
	public function styles(Worksheet $sheet)
	{
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}
}