<?php

namespace App\Exports;
use App\Models\Classroom;
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

class ClassroomsExport implements FromCollection, WithTitle, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
	use RegistersEventListeners;

	private $no = 0;
	
	public function collection()
	{
		//
		return Classroom::with('students')->get();
	}
	public function map($c): array
	{
		return [
			++$this->no,
			$c->id,
			$c->name,
			$c->students->count()
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
		return 'DATA KELAS';
	}
	
	public function headings(): array
	{
		return [
			'NO',
			'ID KELAS',
			'NAMA KELAS',
			'JUMLAH SANTRI'
		];
	}
	public static function afterSheet(AfterSheet $event)
	{
		$sheet = $event->sheet->getDelegate();
		$sheet->getStyle('B1')->getFont()->getColor()->setRGB('ff0000');
		$sheet->getStyle('A1:D1')->getBorders()->getAllBorders()
		->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
		$sheet->getRowDimension('1')->setRowHeight(24);
	}

}