<?php

namespace App\Imports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Teachingscore;
use App\Models\TeacherNig;

class TeacheryImport implements ToModel, WithStartRow
{
	public function startRow(): int
	{
		return 2;
	}

	public function model(array $row)
	{
		$teacher = TeacherNig::where('number', $row[2])->first();
		$options = Teachingscore::categoryOptions();

		if ($teacher && $teacher->user_id) {
			return new Teachingscore([
				'scored_at'	=> $this->convertDate($row[1]),
				'user_id'	=> $teacher->user_id,
				'c1'	=> $row[3] ?? 0,
				'c2'	=> $row[4] ?? 0,
				'c3'	=> $row[5] ?? 0,
				'c4'	=> $row[6] ?? 0,
				'c5'	=> $row[7] ?? 0,
				'c6'	=> $row[8] ?? 0,
				'description'	=> $row[9] ?? null,
			]);
		}
	}

	private function convertDate($date)
	{
		return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
	}
}