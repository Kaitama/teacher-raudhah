<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managementscore extends Model
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
//		return [
//			'c1'	=> 'Konsistensi Kinerja',
//			'c2'	=> 'Ketaatan Kepada Atasan',
//			'c3'	=> 'Kreativitas / Inovasi',
//			'c4'	=> 'Ketepatan Laporan Kegiatan / Keuangan',
//			'c5'	=> 'Kerja Sama Tim',
//			'c6'	=> 'Ketuntasan Tugas'
//		];
        return [
            'c1'	=> 'Kualitas Kerja',
            'c2'	=> 'Ketepatan Laporan Kegiatan / Keuangan',
            'c3'	=> 'Integritas',
        ];
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
