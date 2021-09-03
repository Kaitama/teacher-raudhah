<?php

namespace App\Exports;

use App\Exports\Histories\GatheringExport;
use App\Exports\Histories\TeachingExport;
use App\Exports\Histories\AssignmentExport;
use App\Exports\Histories\PermitExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HistoryExport implements WithMultipleSheets
{
	use Exportable;
	public $user;
	
	public function __construct($id){
		$this->user = $id;
	}
	
	public function sheets(): array
	{
		$sheets = [
			new GatheringExport($this->user),
			new TeachingExport($this->user),
			new AssignmentExport($this->user),
			new PermitExport($this->user),
		];
		
		return $sheets;
	}
}