<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userpermit extends Model
{
    use HasFactory;

		protected $guarded = [];
		protected $dates = ['signed_at', 'started_at', 'ended_at'];

		static function permitOptions(){
			$permits = [1 => 'Keluarga', 2 => 'Cuti', 3 => 'Sakit', 4 => 'Tugas Pesantren', 5 => 'Lainnya'];
			return $permits;
		}

		public function user(){
			return $this->belongsTo(User::class);
		}
}