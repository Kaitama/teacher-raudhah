<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoryExport;
use App\Exports\ScoringExport;

class ExcelController extends Controller
{
    //
		public function index(){
			return view('excel.index');
		}

		public function export($id){
			$user = User::find($id);
			return Excel::download(new HistoryExport($id), 'ABSENSI_' . $user->nig->number . '_' . strtoupper($user->name) . '_' . time() . '.xlsx');
		}

		public function nilai($id){
			$user = User::find($id);
			return Excel::download(new ScoringExport($id), 'PENILAIAN_' . $user->nig->number . '_' . strtoupper($user->name) . '_' . time() . '.xlsx');
		}
}