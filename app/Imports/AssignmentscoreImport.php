<?php

namespace App\Imports;

use App\Models\Assignmentscore;
use App\Models\TeacherNig;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AssignmentscoreImport implements ToModel, WithStartRow
{
	public function startRow(): int
	{
		return 2;
	}

	public function model(array $row)
	{
		$teacher = TeacherNig::where('number', $row[2])->first();

		if ($teacher && $teacher->user_id) {
			return new Assignmentscore([
				'scored_at'	=> $this->convertDate($row[1]),
				'user_id'	=> $teacher->user_id,
				'activity'	=> $row[3],
				'score'	=> $row[4],
				'description'	=> $row[5],
			]);
		}
	}

	private function convertDate($date)
	{
		return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
	}
}