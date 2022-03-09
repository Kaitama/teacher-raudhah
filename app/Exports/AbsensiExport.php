<?php

namespace App\Exports;

use App\Exports\GatheringExport;
use App\Exports\PermitExport;
use App\Exports\AssignmentExport;
use App\Exports\TeachingExport;
use App\Exports\EvaluationExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AbsensiExport implements WithMultipleSheets
{
	use Exportable;

	protected $options, $s_date, $e_date;
	protected $data_sheets;

	public function __construct(array $options, $s, $e)
	{
		$opt = $options;
		sort($opt);
		$this->options = $opt;
		$this->s_date = $this->convertDate($s);
		$this->e_date = $this->convertDate($e);
		$this->data_sheets = array(
			1	=> new GatheringExport($this->s_date, $this->e_date),
			2 => new PermitExport($this->s_date, $this->e_date),
			3 => new AssignmentExport($this->s_date, $this->e_date),
			4 => new TeachingExport($this->s_date, $this->e_date),
			5 => new EvaluationExport($this->s_date, $this->e_date),
			6	=> new TicketExport($this->s_date, $this->e_date),
			7 => new RecapExport($this->s_date, $this->e_date),
		);
	}

	public function array(): array
	{
		return $this->options;
	}

	public function sheets(): array
	{
		$sheets = [];

		foreach ($this->options as $key => $val) {
			$sheets[] = $this->data_sheets[$val];
		}

		return $sheets;
	}

	protected function convertDate($d)
	{
		return Carbon::createFromFormat('d/m/Y', $d)->format('Y-m-d');
	}
}