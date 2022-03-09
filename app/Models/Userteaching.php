<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userteaching extends Model
{
	use HasFactory;

	protected $guarded = [];
	protected $dates = ['signed_at'];

	static function categoryOptions()
	{
		return [
			'1' => 'Terlambat Masuk',
			'2' => 'Meninggalkan Kelas',
			'3' => 'Tidak Hadir',
			'4'	=> 'Absen Mengajar',
			'5'	=> 'Absen Dengan Tiket',
			'6'	=> 'Terlambat Mengajar',
			'7'	=> 'Terlambat Dengan Tiket',
			'8'	=> 'Tidak Belajar Malam',
		];
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function checker()
	{
		return $this->belongsTo(User::class, 'checked_by', 'id');
	}

	// public function classroom(){
	// 	return $this->belongsTo(Classroom::class);
	// }
}