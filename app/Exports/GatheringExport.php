<?php

namespace App\Exports;

use App\Models\Gathering;
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

class GatheringExport implements FromQuery, WithTitle, WithMapping, WithColumnFormatting, ShouldAutoSize, WithHeadings, WithStyles
{
	private $s, $e, $no = 1;  
	
	public function __construct($s, $e){
		$this->s = $s;
		$this->e = $e;
	}
	public function query()
	{
		return Gathering::query()
		->whereDate('held_at', '>=', $this->s)
		->whereDate('held_at', '<=', $this->e)
		->orderBy('held_at');
	}
	
	public function map($data): array{
		return [
			$this->no++,
			Date::dateTimeToExcel($data->held_at),
			$data->name,
			$data->description,
			$data->users->count() > 0 ? $this->arrayToString($arr = $data->users) : null
		];
	}
	
	public function headings(): array
	{
		return [
			'No.',
			'Tanggal',
			'Nama Kegiatan',
			'Keterangan',
			'Guru yang Absen'
		];
	}

	public function columnFormats(): array
	{
		return [
			'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
		];
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

	private function arrayToString($arr)
	{
		$u = array();
		foreach ($arr as $a) {
			$u[] = $a->name;
		}
		return implode('; ', $u);
	}
}