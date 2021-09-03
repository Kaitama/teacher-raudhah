<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managementscore extends Model
{
    use HasFactory;

		protected $guarded = [];

		protected $dates = ['scored_at'];

		static function categoryOptions(){
			return [
				'c1'	=> 'Konsistensi Kinerja',
				'c2'	=> 'Ketaatan Kepada Atasan',
				'c3'	=> 'Kreativitas / Inovasi',
				'c4'	=> 'Ketepatan Laporan Kegiatan / Keuangan',
				'c5'	=> 'Kerja Sama Tim',
				'c6'	=> 'Ketuntasan Tugas'
			];
		}

		public function user(){
			return $this->belongsTo(User::class);
		}
}