<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\TeacherNig;
use App\Models\Userassignment;
use App\Models\Userevaluation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AssignmentImport implements ToModel, WithStartRow
{
	public function startRow(): int
	{
		return 2;
	}

	/**
	 * @param Collection $collection
	 */
	public function model(array $row)
	{
		//
		$teacher = TeacherNig::where('number', $row[1])->first();
		$options = Userassignment::assignmentOptions();

		return new Userassignment([
			'signed_at'	=> $this->convertDate($row[0]),
			'user_id'	=> $teacher->user_id,
			'decree'	=> $row[2] ?? null,
			'category' => array_search($row[3], $options),
			'started_at'	=> $this->convertDate($row[4]),
			'ended_at'	=> $this->convertDate($row[5]),
			'description'	=> $row[6] ?? null,
		]);
	}

	private function convertDate($date)
	{
		return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
	}
}