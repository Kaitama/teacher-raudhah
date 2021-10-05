<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usereducation extends Model
{
	use HasFactory;
	protected $guarded = [];
	
	static function educationLevels()
	{
		return [1 => 'SD', 2 => 'SMP', 3 => 'SMA', 4 => 'Diploma', 5 => 'Sarjana', 6 => 'Magister', 7 => 'Doktoral'];
	}
	
	public function user(){
		return $this->belongsTo(User::class);
	}
}