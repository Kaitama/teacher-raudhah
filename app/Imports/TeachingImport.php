<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\TeacherNig;
use App\Models\Userteaching;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TeachingImport implements ToModel, WithStartRow
{
	public function startRow(): int
	{
		return 2;
	}

	public function model(array $row)
	{
		$teacher = TeacherNig::where('number', $row[1])->first();
		$options = Userteaching::categoryOptions();

		if ($teacher) {
			return new Userteaching([
				'signed_at'	=> $this->convertDate($row[0]),
				'checked_by'	=> Auth::id(),
				'user_id'	=> $teacher->user_id,
				'category' => array_search($row[2], $options),
				'description'	=> $row[3] ?? null,
			]);
		}
	}

	private function convertDate($date)
	{
		return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
	}
}