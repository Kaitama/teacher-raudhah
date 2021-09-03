<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userassignment extends Model
{
    use HasFactory;

		protected $guarded = [];

		protected $dates = ['signed_at', 'started_at', 'ended_at'];

		static function assignmentOptions(){
			return ['1' => 'Kepanitiaan', '2' => 'Struktural', '3' => 'Wali Kelas'];
		}

		public function user(){
			return $this->belongsTo(User::class);
		}
}