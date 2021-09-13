<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\TeacheryImport;
use App\Imports\ManagementImport;

class ScoringImport implements WithMultipleSheets
{
	public function sheets(): array
	{
		return [
			0 => new TeacheryImport(),
			1 => new ManagementImport(),
		];
	}
}