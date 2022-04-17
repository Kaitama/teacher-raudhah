<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachingscore extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected $dates = ['scored_at'];

	static function categoryOptions()
	{
		return [
			'c1'	=> 'Penyampaian Materi',
			'c2'	=> 'Penguasaan Materi dan Kelas',
			'c3'	=> 'Persiapan Mengajar',
			'c4'	=> 'Keteladanan Berpakaian / Ibadah',
		];
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}