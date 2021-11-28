<?php

namespace App\Http\Livewire\Teacher;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Exports\TeacherProfilesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Carbon\Carbon;
use App\Models\Appdata;
use App\Models\Userpermit;
use App\Models\Userteaching;
use App\Models\Teachingscore;
use App\Models\Userassignment;
use App\Models\Userevaluation;
use App\Models\Managementscore;

class Index extends Component
{
	use WithPagination;
	
	public $confirm_delete = false;
	public $teachers_collection;
	public $user;
	public $alert;
	public $search;
	public $select_gender;
	public $perpage = 25;
	public $modalOptions = false, $guru, $started, $ended;
	
	public function mount(){
		$this->started = Carbon::now()->startOfMonth()->format('d/m/Y');
		$this->ended = Carbon::now()->format('d/m/Y');
	}

	public function setTeacher($id){
		$this->modalOptions = true;
		$this->guru = User::find($id);
	}

	public function printing(){
		$name = strtoupper($this->guru->name);
		$starting = $this->convertDate($this->started);
		$ending = $this->convertDate($this->ended);
		$mscores = Managementscore::where('user_id', $this->guru->id)
		->whereDate('scored_at', '>=', $starting)
		->whereDate('scored_at', '<=', $ending)
		->orderByDesc('scored_at')
		->get();
		$tscores = Teachingscore::where('user_id', $this->guru->id)
		->whereDate('scored_at', '>=', $starting)
		->whereDate('scored_at', '<=', $ending)
		->orderByDesc('scored_at')
		->get();
		$permits = Userpermit::where('user_id', $this->guru->id)
		->whereDate('signed_at', '>=', $starting)
		->whereDate('signed_at', '<=', $ending)
		->orderByDesc('signed_at')
		->get();
		$assignments = Userassignment::where('user_id', $this->guru->id)
		->whereDate('signed_at', '>=', $starting)
		->whereDate('signed_at', '<=', $ending)
		->orderByDesc('signed_at')
		->get();
		$evaluations = Userevaluation::where('user_id', $this->guru->id)
		->whereDate('signed_at', '>=', $starting)
		->whereDate('signed_at', '<=', $ending)
		->orderByDesc('signed_at')
		->get();
		$teachings = Userteaching::where('user_id', $this->guru->id)
		->whereDate('signed_at', '>=', $starting)
		->whereDate('signed_at', '<=', $ending)
		->orderByDesc('signed_at')
		->get();
		$gatherings = $this->guru
		->gatherings()
		->whereDate('held_at', '>=', $starting)
		->whereDate('held_at', '<=', $ending)
		->orderByDesc('held_at')
		->get();
		
		$data = [
			'teacher' => $this->guru,
			'mscores'	=> $mscores,
			'moptions'	=> Managementscore::categoryOptions(),
			'tscores' => $tscores,
			'toptions'	=> Teachingscore::categoryOptions(),
			'gatherings' => $gatherings,
			'teachings'	=> $teachings,
			'teachoptions'	=> Userteaching::categoryOptions(),
			'evaluations'	=> $evaluations,
			'evaloptions'	=> Userevaluation::categoryOptions(),
			'assignments'	=> $assignments,
			'asignoptions'	=> Userassignment::assignmentOptions(),
			'permits'	=> $permits,
			'permitoptions' => Userpermit::permitOptions(),
			'from'	=> Carbon::createFromFormat('d/m/Y', $this->started)->isoFormat('LL'),
			'to'	=> Carbon::createFromFormat('d/m/Y', $this->ended)->isoFormat('LL'),
			'appdata'	=> Appdata::first(),
		];
		$pdfContent = PDF::loadView('pdf.rapor-guru', $data)->output();
		return response()->streamDownload(
			function() use ($pdfContent){
				print($pdfContent);
			},
			'RAPOR_'.$name.'_'.time().'.pdf'
		);
	}
	
	public function render()
	{
		
		$s = '%' . $this->search . '%';
		$teachers = null;
		if(strlen($this->search) >= 3){
			$teachers = User::where('name', 'like', $s)
			->orWhere('email', 'like', $s)
			->orWhereHas('nig', function($q) use($s){
				$q->where('number', 'like', $s);
			})
			->orWhereHas('profile', function($q) use($s){
				$q->where('phone', 'like', $s);
			})
			->has('nig')
			->role('guru')
			->with('nig')
			->with('profile')
			->with('classroom')
			->get();
		} else {
			$teachers = User::has('nig')->role('guru')->with('nig')->with('profile')->with('classroom')->get();
		}
		
		// filter gender
		if($this->select_gender) {
			$teachers = $teachers->filter(function($colls){
				if($this->select_gender == 1) return $colls->profile->gender == true;
				elseif($this->select_gender == 2) return $colls->profile->gender == false;
				else return $colls;
			});
		}
		
		// set teachers available for export
		$this->teachers_collection = $teachers;
		
		// creating pagination
		$items = $teachers->forPage($this->page, $this->perpage)->values();
		$teachers = new LengthAwarePaginator($items, $teachers->count(), $this->perpage, $this->page);
		
		return view('livewire.teacher.index', ['teachers' => $teachers]);
	}
	
	public function exportExcel(){
		$export = new TeacherProfilesExport($this->teachers_collection);
		return Excel::download($export, 'DATA_GURU_' . time() . '.xlsx');
	}
	
	private function convertDate($date)
	{
		return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
	}
	
}