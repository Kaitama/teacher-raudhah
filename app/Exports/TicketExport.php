<?php

namespace App\Exports;

use App\Models\Userticket;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class TicketExport implements FromQuery, WithTitle, WithMapping, WithColumnFormatting, ShouldAutoSize, WithHeadings, WithStyles
{
	private $s, $e, $no = 1;

	public function __construct($s, $e)
	{
		$this->s = $s;
		$this->e = $e;
	}
	public function query()
	{
		return Userticket::query()
			->whereDate('saved_at', '>=', $this->s)
			->whereDate('saved_at', '<=', $this->e)
			->orderBy('saved_at');
	}

	public function map($data): array
	{
		return [
			$this->no++,
			Date::dateTimeToExcel($data->saved_at),
			$data->user->nig->number,
			$data->user->name,
			$data->session,
			$data->description,
		];
	}

	public function headings(): array
	{
		return [
			'No.',
			'Tanggal',
			'No. Induk Guru',
			'Nama Guru',
			'Jumlah Les',
			'Keterangan'
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
		return 'TIKET';
	}

	public function styles(Worksheet $sheet)
	{
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}
}