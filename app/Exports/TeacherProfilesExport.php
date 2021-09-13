<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class TeacherProfilesExport extends DefaultValueBinder implements FromCollection, WithMapping, WithColumnFormatting, WithCustomValueBinder, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
	use RegistersEventListeners;
	
	protected $teachers, $no = 0;
	protected $educations_level = ['TK', 'SD/MI', 'SMP/MTs', 'SMA/MA', 'S1', 'S2', 'S3'];
	
	public function __construct($teachers){
		$this->teachers = $teachers;
	}
	
	public function map($t): array
	{
		++$this->no;
		$back_title = $t->profile->ltitle ? ', ' . $t->profile->ltitle : '';
		if($edu = $t->educations->sortByDesc('level')->where('out', null)->first()){
			$a_lev = $this->educations_level[$edu['level'] - 1] ?? null;
			$a_uni = $edu['name'] ?? null;
			$a_fac = $edu['faculty'] ?? null;
			$a_foc = $edu['focus'] ?? null;
			$a_sem = $edu['semester'] ?? null;
		} else {
			$a_lev = null; $a_uni = null; $a_fac = null; $a_foc = null; $a_sem = null;
		}

		if($las = $t->educations->sortByDesc('level')->sortByDesc('out')->where('out', '!=', null)->first()){
			$l_lev = $this->educations_level[$las['level'] - 1] ?? null;
			$l_uni = $las['name'] ?? null;
			$l_fac = $las['faculty'] ?? null;
			$l_foc = $las['focus'] ?? null;
			$l_sem = $las['semester'] ?? null;
			$l_ijz = $las['certificate'] ?? null;
		} else {
			$l_lev = null; $l_uni = null; $l_fac = null; $l_foc = null; $l_sem = null; $l_ijz = null;
		}

		return [
			$this->no,
			$t->nig->number,
			$t->profile->ftitle . ' ' . $t->name . $back_title,
			$t->email,
			// profile
			$t->profile->phone,
			$t->profile->birthplace,
			$t->profile->birthdate ? Date::dateTimeToExcel($t->profile->birthdate) : '',
			$t->profile->gender ? 'Laki-laki' : 'Perempuan',
			$t->profile->marriage,
			$t->profile->address,
			$t->profile->ktp,
			$t->profile->npwp,
			$t->profile->blood,
			$t->profile->childnum,
			$t->profile->siblings,
			$t->profile->fname,
			$t->profile->fphone,
			$t->profile->fstatus ? 'Masih Hidup' : 'Sudah Meninggal',
			$t->profile->mname,
			$t->profile->mphone,
			$t->profile->mstatus ? 'Masih Hidup' : 'Sudah Meninggal',
			$t->profile->paddress,
			$t->profile->arts,
			$t->profile->sports,
			$t->profile->organizations,
			$t->profile->others,
			// partner
			$t->partner->name,
			$t->partner->phone,
			$t->partner->education,
			$t->partner->work,
			$t->childrens->count() == 0 ? 0 : $t->childrens->count(),
			// active educations
			$a_lev,
			$a_uni,
			$a_fac,
			$a_foc,
			$a_sem,
			// last educations
			$l_lev,
			$l_uni,
			$l_fac,
			$l_foc,
			$l_sem,
			$l_ijz,
			
		];
		
		
	}
	
	public function headings(): array
	{
		return [
			['NO', 'DATA PRIBADI', '', '', '', '', '', '', '', '', '', '', '', '', '', 'DATA ORANG TUA', '', '', '', '', '', '', 'HOBBY DAN LAINNYA', '', '', '', 'DATA KELUARGA', '', '', '', '', 'PENDIDIKAN AKTIF', '', '', '', '', 'IJAZAH TERAKHIR', '', '', '', '', ],
			['', 'NIG', 'NAMA LENGKAP', 'EMAIL', 'TELEPON/HP', 'TEMPAT LAHIR', 'TANGGAL LAHIR', 'JENIS KELAMIN', 'STATUS PERNIKAHAN', 'ALAMAT LENGKAP', 'NOMOR KTP', 'NOMOR NPWP', 'GOL. DARAH', 'ANAK KE', 'JLH. SAUDARA', 'NAMA AYAH', 'TELEPON', 'KEBERADAAN', 'NAMA IBU', 'TELEPON', 'KEBERADAAN', 'ALAMAT ORANG TUA', 'BIDANG SENI', 'BIDANG OLAHRAGA', 'BIDANG ORGANISASI', 'BIDANG LAINNYA', 'NAMA ISTRI/SUAMI', 'TELEPON/HP', 'PENDIDIKAN TERAKHIR', 'PEKERJAAN', 'JUMLAH ANAK', 'JENJANG', 'UNIVERSITAS', 'FAKULTAS', 'JURUSAN', 'SEMESTER', 'JENJANG', 'UNIVERSITAS', 'FAKULTAS', 'JURUSAN', 'SEMESTER', 'NOMOR IJAZAH']
		];
	}
	
	public function styles(Worksheet $sheet) { 
		return [
			1 => ['font' => ['bold' => true, 'size' => 16]], 
			2 => ['font' => ['bold' => true, 'size' => 14]],
			'A1:ZZ1' => ['alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],]
		]; 
	}
	
	public static function afterSheet(AfterSheet $event)
	{
		$event->sheet->mergeCells('A1:A2');
		$event->sheet->mergeCells('B1:O1');
		$event->sheet->mergeCells('P1:V1');
		$event->sheet->mergeCells('W1:Z1');
		$event->sheet->mergeCells('AA1:AE1');
		$event->sheet->mergeCells('AF1:AJ1');
		$event->sheet->mergeCells('AK1:AP1');
		$sheet = $event->sheet->getDelegate();
		$sheet->getStyle('A1:AP2')->getFont()->getColor()->setRGB('ff0000');
		$sheet->getStyle('A1:AP2')->getBorders()->getAllBorders()
		->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
		$sheet->getRowDimension('1')->setRowHeight(36);
	}
	
	public function columnFormats(): array
	{
		return [
			'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
		];
	}
	
	public function bindValue(Cell $cell, $value)
	{
		
		if(strlen((string)$value) > 10){ // if (is_numeric($value)) {
			$cell->setValueExplicit($value, DataType::TYPE_STRING);
			return true;
		}
		
		// if (is_numeric($value)) {
			// 	$cell->setValueExplicit($value, DataType::TYPE_STRING);
			// 	return true;
			// }
			
			// else return default behavior
			return parent::bindValue($cell, $value);
		}
		
		public function collection()
		{
			//
			return $this->teachers;
		}
	}