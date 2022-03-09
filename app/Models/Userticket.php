<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userticket extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected $dates = ['saved_at'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}