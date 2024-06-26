<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

		protected $guarded = [];

		// public function userteachings(){
		// 	return $this->hasMany(Classroom::class);
		// }

		public function teacher(){
			return $this->belongsTo(User::class);
		}

		public function students(){
			return $this->hasMany(Student::class);
		}
}