<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\TeacherNig;
use App\Models\Userticket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TicketImport implements ToModel, WithStartRow
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
		$teacher = TeacherNig::where('number', $row[1])->first();

		if ($teacher) {
			return new Userticket([
				'saved_at'	=> $this->convertDate($row[0]),
				'user_id'	=> $teacher->user_id,
				'session'	=> $row[2],
				'description'	=> $row[3] ?? null,
			]);
		}
	}

	private function convertDate($date)
	{
		return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
	}
}