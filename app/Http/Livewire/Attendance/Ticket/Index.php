<?php

namespace App\Http\Livewire\Attendance\Ticket;

use App\Models\Userticket;
use Livewire\Component;

class Index extends Component
{
	public $perpage = 25, $search, $item, $modal_confirmation = false;

	public function confirmDelete(Userticket $ticket)
	{
		$this->item = $ticket;
		$this->modal_confirmation = true;
	}

	public function destroy()
	{
		$this->item->delete();
		$this->modal_confirmation = false;
	}

	public function render()
	{
		$s = '%' . $this->search . '%';
		if (strlen($this->search) >= 3) {
			$tickets = Userticket::where('description', 'like', $s)
				->orWhereHas('user', function ($q) use ($s) {
					$q->where('name', 'like', $s);
				})
				->orWhereHas('user.nig', function ($q) use ($s) {
					$q->where('number', 'like', $s);
				})
				->with('user.nig')
				->orderByDesc('saved_at')
				->orderByDesc('created_at')
				->paginate($this->perpage);
		} else {
			$tickets = Userticket::orderByDesc('saved_at')->orderByDesc('created_at')->paginate($this->perpage);
		}
		return view('livewire.attendance.ticket.index', ['tickets' => $tickets]);
	}
}