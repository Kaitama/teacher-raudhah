<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	use HasFactory;
	
	protected $table = 'Userprofiles';
	protected $guarded = [];
	protected $dates = ['birthdate'];
	
	
	// protected $casts = [
	// 	'birthdate' => 'date:d-m-Y'
	// ];
	
	
	// protected $dateFormat = 'd-m-Y';
	
	public function user(){
		return $this->belongsTo(User::class);
	}
}