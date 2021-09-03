<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gathering extends Model
{
    use HasFactory;

		protected $guarded = [];
		protected $dates = ['held_at'];

		public function users(){
			return $this->belongsToMany(User::class);
		}
}