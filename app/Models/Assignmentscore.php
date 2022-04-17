<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignmentscore extends Model
{
	use HasFactory;
	protected $guarded = [];
	protected $dates = ['scored_at'];

	static function scoreRange()
	{
		return [
			'81 - 90' => 'Sangat Baik',
			'71 - 80'	=> 'Baik',
			'61 - 70' => 'Cukup',
			'51 - 60' => 'Kurang',
			'0 - 50' => 'Sangat Kurang',
		];
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}