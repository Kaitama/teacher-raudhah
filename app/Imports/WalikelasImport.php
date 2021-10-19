<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Classroom;
use App\Models\TeacherNig;

class WalikelasImport implements WithMultipleSheets
{
	public function sheets(): array
	{
		return [
			0 => new SetWalikelas(),
		];
	}
}


class SetWalikelas implements ToModel, WithStartRow
{
	protected $total = 0;
	public function startRow(): int
	{
		return 2;
	}
	
	public function model(array $row)
	{
		
		$teacher = TeacherNig::where('number', $row[1])->first();
		// if($teacher && !$row[3]){
		// 	Classroom::where('user_id', $teacher->user_id)->update(['user_id' => null]);
		// }
		// if($teacher && $row[3]){
		// 	$class = Classroom::find($row[3]);
		// 	if($class){
		// 		$class->update([
		// 			'user_id'	=> $teacher->user_id,
		// 		]);
		// 	}
		// }

		if ($olds = Classroom::where('user_id', $teacher->user_id)->get()) {
			foreach ($olds as $old) {
				$old->update(['user_id' => null]);
			}
		}
		
		if($class = Classroom::find($row[3])){
			$class->update([
				'user_id'	=> $teacher->user_id,
			]);
		}
		return $teacher;
		
	}
}