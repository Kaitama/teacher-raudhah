<?php

namespace App\Imports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Userpermit;
use App\Models\TeacherNig;

class PermitImport implements ToModel, WithStartRow
{
	public function startRow(): int
	{
		return 2;
	}

	public function model(array $row)
	{
		$teacher = TeacherNig::where('number', $row[1])->first();
		$options = Userpermit::permitOptions();
		// dd($teacher->user_id);
		if ($teacher && $teacher->user_id) {
			return new Userpermit([
				'signed_at'	=> $this->convertDate($row[0]),
				'user_id'	=> $teacher->user_id,
				'category' => array_search($row[2], $options),
				'started_at'	=> $this->convertDate($row[3]),
				'ended_at'	=> $this->convertDate($row[4]),
				'description'	=> $row[5] ?? null,
			]);
		}
	}

	private function convertDate($date)
	{
		return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
	}
}