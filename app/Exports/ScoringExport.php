<?php

namespace App\Exports;

use App\Exports\Scorings\TeachingExport;
use App\Exports\Scorings\ManagementExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ScoringExport implements WithMultipleSheets
{
	use Exportable;
	public $user;
	
	public function __construct($id){
		$this->user = $id;
	}
	
	public function sheets(): array
	{
		$sheets = [
			new TeachingExport($this->user),
			new ManagementExport($this->user),
		];
		
		return $sheets;
	}
}