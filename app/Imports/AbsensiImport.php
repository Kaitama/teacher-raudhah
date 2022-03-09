<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\PermitImport;
use App\Imports\TeachingImport;
use App\Imports\EvaluationImport;

class AbsensiImport implements WithMultipleSheets
{
	public function sheets(): array
	{
		return [
			0 => new PermitImport(),
			1 => new TeachingImport(),
			2 => new EvaluationImport(),
			3 => new AssignmentImport(),
			4 => new TicketImport(),
		];
	}
}