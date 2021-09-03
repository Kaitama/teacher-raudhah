<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherNig extends Model
{
	use HasFactory;
	protected $table = 'teacher_nigs';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo(User::class);
	}
}