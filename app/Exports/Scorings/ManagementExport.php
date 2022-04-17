<?php

namespace App\Exports\Scorings;

use App\Models\Managementscore;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ManagementExport implements FromQuery, WithTitle, WithMapping, WithColumnFormatting, ShouldAutoSize, WithHeadings, WithStyles
{
	private $user, $categories, $no = 1;

	public function __construct($id)
	{
		$this->user = $id;
		$this->categories = Managementscore::categoryOptions();
	}
	public function query()
	{
		return Managementscore::query()
			->where('user_id', $this->user)
			->orderBy('scored_at');
	}

	public function map($data): array
	{
		$cats = $this->setCategories($data);
		$dt = [
			$this->no++,
			Date::dateTimeToExcel($data->scored_at),
		];
		$ar = array_merge($dt, $cats);
		$ar[] = $data->description;
		return $ar;
	}

	public function headings(): array
	{
		$t1 = ['No.', 'Tanggal'];
		$t2 = [];
		foreach ($this->categories as $k => $v) {
			$t2[] = $v;
		}
		$t = array_merge($t1, $t2);
		$t[] = 'Keterangan';
		return $t;
	}

	public function columnFormats(): array
	{
		return [
			'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
		];
	}

	public function title(): string
	{
		return 'STRUKTURAL';
	}

	public function styles(Worksheet $sheet)
	{
		// $sheet->getStyle(1)->getAlignment()->setWrapText(true);
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}

	private function setCategories($data)
	{
		$cs = [];
		foreach ($this->categories as $k => $v) {
			$cs[] = $data->$k;
		}
		return $cs;
	}
}