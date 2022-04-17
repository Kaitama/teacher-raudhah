<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userevaluation extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected $dates = ['signed_at'];

	static function categoryOptions()
	{
		return [
			'1' => 'Pemanggilan',
			'2' => 'Surat Peringatan',
			'3' => 'Pemberhentian dengan Tidak Hormat',
			'4'	=> 'Lain-lain'
		];
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}