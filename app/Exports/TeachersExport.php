<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;

class TeachersExport implements FromCollection, WithTitle, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
	use RegistersEventListeners;
	private $no = 0;
	
	public function collection()
	{
		//
		$teachers = User::role('guru')->has('nig')->with('classroom')->orderBy('name')->get();
		
		return $teachers;
		// return 
	}
	
	public function map($t): array
	{
		$f = $t->profile->ftitle ? $t->profile->ftitle . ' ' : null;
		$l = $t->profile->ltitle ? ', ' . $t->profile->ltitle : null;
		return [
			++$this->no,
			$t->nig->number,
			// $f . $t->name . $l,
			$t->name,
			$t->classroom->id ?? null
		];
	}
	
	public function styles(Worksheet $sheet)
	{
		return [
			// Style the first row as bold text.
			1    => ['font' => ['bold' => true, 'size' => 16]],
		];
	}
	public function title(): string
	{
		return 'DATA GURU';
	}
	
	public function headings(): array
	{
		return [
			'NO',
			'NO. INDUK GURU',
			'NAMA LENGKAP',
			'ID KELAS'
		];
	}

	public static function afterSheet(AfterSheet $event)
	{
		$sheet = $event->sheet->getDelegate();
		$sheet->getStyle('D1')->getFont()->getColor()->setRGB('ff0000');
		$sheet->getStyle('A1:D1')->getBorders()->getAllBorders()
		->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
		$sheet->getRowDimension('1')->setRowHeight(24);
	}
}