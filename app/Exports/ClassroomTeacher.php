<?php

namespace App\Exports;

use App\Exports\TeachersExport;
use App\Exports\ClassroomExport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ClassroomTeacher implements WithMultipleSheets
{
	use Exportable;
	
	
	public function sheets(): array
    {
		//
		$sheets = [
			new TeachersExport,
			new ClassroomsExport
		];
		return $sheets;
	}
}