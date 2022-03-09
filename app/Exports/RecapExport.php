<?php

namespace App\Exports;

use App\Models\User;
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

class RecapExport implements FromQuery, WithTitle, WithMapping, ShouldAutoSize, WithHeadings, WithStyles
{
	private $s, $e, $no = 1;

	public function __construct($s, $e)
	{
		$this->s = $s;
		$this->e = $e;
	}
	public function query()
	{
		$users = User::query()
			->whereHas('nig')
			->role('guru')
			->with('nig')
			->with('permits', function ($q) {
				$q->whereDate('signed_at', '>=', $this->s)->whereDate('signed_at', '<=', $this->e);
			})
			->with('teachings', function ($q) {
				$q->whereDate('signed_at', '>=', $this->s)->whereDate('signed_at', '<=', $this->e);
			})
			->with('tickets', function ($q) {
				$q->whereDate('saved_at', '>=', $this->s)->whereDate('saved_at', '<=', $this->e);
			})
			->orderBy('name');

		return $users;
	}

	public function map($data): array
	{
		return [
			$this->no++,
			$data->nig->number,
			$data->name,
			$data->permits->count(),
			$data->teachings->count(),
			$data->tickets->sum('session'),
		];
	}

	public function headings(): array
	{
		return [
			'No.',
			'No. Induk Guru',
			'Nama Guru',
			'Perizinan',
			'Pengajaran',
			'Jlh. Tiket',
		];
	}

	public function title(): string
	{
		return 'REKAPITULASI';
	}

	public function styles(Worksheet $sheet)
	{
		return [
			1    => ['font' => ['bold' => true, 'size' => 14]],
		];
	}
}