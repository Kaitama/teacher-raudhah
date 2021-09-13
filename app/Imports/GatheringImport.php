<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\TeacherNig;

class GatheringImport implements ToModel, WithStartRow
{

	protected $gath, $ids = [];

	public function startRow(): int
	{
		return 2;
	}
	
	public function __construct($gathering){
		$this->gath = $gathering;
	}

	public function model(array $row)
	{
		$teacher = TeacherNig::where('number', $row[1])->first();

		if($teacher) 
		// $this->gath->users()->attach($teacher->user_id);
		$this->ids[] = $teacher->user_id;
		
	}

	public function getIds(): array{
		return $this->ids;
	}
}