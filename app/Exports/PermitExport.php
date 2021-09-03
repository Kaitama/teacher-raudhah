<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Userpermit;
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

class PermitExport implements FromQuery, WithTitle, WithMapping, WithColumnFormatting, ShouldAutoSize, WithHeadings, WithStyles
{
	
	private $cats, $s, $e, $no = 1;  
	
	public function __construct($s, $e){
		$this->s = $s;
		$this->e = $e;
		$this->cats = Userpermit::permitOptions();
	}
	public function query()
	{
		return Userpermit::query()
		->whereDate('signed_at', '>=', $this->s)
		->whereDate('signed_at', '<=', $this->e)
		->orderBy('signed_at');
	}
	
	public function columnFormats(): array
	{
		return [
			'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
		];
	}
	
	public function map($data): array{
		return [
			$this->no++,
			Date::dateTimeToExcel($data->signed_at),
			$data->user->nig->number,
			$data->user->name,
			$this->cats[$data->category],
			$data->description,
			Date::dateTimeToExcel($data->started_at),
			Date::dateTimeToExcel($data->ended_at),
		];
	}
	
	public function headings(): array
	{
		return [
			'No.',
			'Tanggal',
			'No. Induk Guru',
			'Nama Guru',
			'Alasan Izin',
			'Keterangan',
			'Mulai Tanggal',
			'Sampai Tanggal'
		];
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