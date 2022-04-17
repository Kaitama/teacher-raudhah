<?php

namespace App\Exports;

use App\Models\Assignmentscore;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AssignmentscoreExport implements FromQuery, WithTitle, WithMapping, WithColumnFormatting, ShouldAutoSize, WithHeadings, WithStyles
{
	private $user, $no = 1;
	public function __construct($id)
	{
		$this->user = $id;
	}
	public function query()
	{
		return Assignmentscore::query()
			->where('user_id', $this->user)
			->orderBy('scored_at');
	}

	public function map($data): array
	{
		return [
			$this->no++,
			Date::dateTimeToExcel($data->scored_at),
			$data->activity ?? '-',
			$data->score ?? 0,
			$data->description ?? '-'
		];
	}

	public function headings(): array
	{
		return [
			'No.', 'Tanggal', 'Nama Kegiatan', 'Nilai', 'Keterangan'
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
		return 'PENUGASAN';
	}

	public function styles(Worksheet $sheet)
	{
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}
}