<?php

namespace App\Http\Livewire\Student\History;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Tuitions extends Component
{
	use WithPagination;

	public $student;

    public function render()
    {
        $old_tuitions = $this->student->tuitions()->orderByDesc('paydate')->get();
        $bsi_tuitions = $this->student->invoices()->where('status', 2)->orderByDesc('paid_at')->get();
//        dd($bsi_tuitions);
        $array_payments = array();
        foreach ($old_tuitions as $old) {
            $string_desc = $old->formonth > 12 ? ('XX ' . $old->foryear) : Carbon::create($old->foryear, $old->formonth, null)->isoFormat('MMMM Y');
            $array_payments[] = [
                'header' => 'SPP Bulan ' . $string_desc,
                'sub' => $old->paydate->isoFormat('LL'),
                'date' => $old->paydate->format('Y-m-d'),
            ];
        }
        foreach ($bsi_tuitions as $bsi) {
//            if ($bsi->category == 2) {
//                $header = 'Uang Tahunan ' . $bsi->year;
//            } else {
//                $header = 'SPP Bulan ' . Carbon::create($bsi->year, $bsi->month, null)->isoFormat('MMMM Y');
//            }
            $array_payments[] = [
                'header' => $bsi->additional_info,
                'sub' => $bsi->paid_at->isoFormat('LL'),
                'date' => $bsi->paid_at->format('Y-m-d'),
            ];
        }

        $per_page = 10;

        usort($array_payments, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });
        $collections = collect($array_payments);

        $offset = max(0, ($this->page - 1) * $per_page);

        $items = $collections->slice($offset, $per_page + 1);

        $tuitions = new Paginator($items, $per_page, $this->page, ['pageName' => 'tuitions']);

//        $tuitions = collect($array_payments)
//            ->sortByDesc('date')
//            ->paginate(10, ['*'], 'tuitions');
//            ->paginate(10, null, null, 'tuitions');
//        $old_tuitions = $this->student->tuitions()->orderByDesc('foryear')->orderByDesc('formonth')->paginate(10, ['*'], 'tuitions');
//        dd($tuitions);
        return view('livewire.student.history.tuitions', ['tuitions' => $tuitions]);
    }
}
