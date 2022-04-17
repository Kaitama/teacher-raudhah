<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachingscore extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected $dates = ['scored_at'];

	static function scoreRange()
	{
		return [
			'81 - 90' => 'Sangat Baik',
			'71 - 80'	=> 'Baik',
			'61 - 70' => 'Cukup',
			'51 - 60' => 'Kurang',
			'0 - 50' => 'Sangat Kurang',
		];
	}

	static function categoryOptions()
	{
		return [
			'c1'	=> 'Penyampaian Materi',
			'c2'	=> 'Penguasaan Materi dan Kelas',
			'c3'	=> 'Kehadiran Mengajar',
			'c4'	=> 'Absensi Mengajar',
		];
	}


	public function user()
	{
		return $this->belongsTo(User::class);
	}
}