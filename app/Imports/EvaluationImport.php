<?php

namespace App\Imports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Userevaluation;
use App\Models\TeacherNig;

class EvaluationImport implements ToModel, WithStartRow
{
  public function startRow(): int
	{
		return 2;
	}
	
	public function model(array $row)
	{
		$teacher = TeacherNig::where('number', $row[1])->first();
		$options = Userevaluation::categoryOptions();
		
		return new Userevaluation([
			'signed_at'	=> $this->convertDate($row[0]),
			'user_id'	=> $teacher->user_id,
			'decree'	=> $row[2] ?? null,
			'category' => array_search($row[3], $options),
			'description'	=> $row[4] ?? null,
		]);  
	}

	private function convertDate($date)
	{
		return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
	}

}