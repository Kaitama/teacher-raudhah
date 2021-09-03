<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Userteaching;
use App\Models\Userpermit;
use App\Models\Gathering;
use App\Models\Userassignment;
use App\Models\Userevaluation;
use App\Models\Teachingscore;
use App\Models\Managementscore;
use Auth;

class Attendance extends Component
{
	public $gathering, $permit, $teaching, $assignment, $evaluation, $teachingscore, $managementscore;
	public $permit_options, $teaching_options, $assignment_options, $evaluation_options, $teach_options, $manage_options;

	public function mount(){
		$this->gathering = Auth::user()->gatherings()->latest()->first();
		$this->permit_options = Userpermit::permitOptions();
		$this->permit = Auth::user()->permits()->latest()->first();
		$this->teaching_options = Userteaching::categoryOptions();
		$this->teaching = Auth::user()->teachings()->latest()->first();
		$this->assignment_options = Userassignment::assignmentOptions();
		$this->assignment = Auth::user()->assignments()->latest()->first();
		$this->evaluation_options = Userevaluation::categoryOptions();
		$this->evaluation = Auth::user()->evaluations()->latest()->first();
		$this->assignment = Auth::user()->assignments()->latest()->first();
		$this->teach_options = Teachingscore::categoryOptions();
		$this->teachingscore = Auth::user()->teachingScores()->latest()->first();
		$this->manage_options = Managementscore::categoryOptions();
		$this->managementscore = Auth::user()->managementScores()->latest()->first();
	}
	public function render()
	{
		return view('livewire.dashboard.attendance');
	}
}