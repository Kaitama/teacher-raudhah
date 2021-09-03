<?php

namespace App\Exports\Histories;

use App\Models\User;
use App\Models\Gathering;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GatheringExport implements FromView, WithTitle, WithStyles, ShouldAutoSize
{
	public $data, $categories;
	
	public function __construct($id){
		$user = User::find($id);
		$this->data = $user->gatherings;
	}
	
	public function view(): View
	{
		return view('excel.histories.gathering', [
			'data' => $this->data,
			'categories'	=> $this->categories
		]);
	}

	public function title(): string
	{
		return 'KUMPUL';
	}
	
	public function styles(Worksheet $sheet)
	{
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}
}