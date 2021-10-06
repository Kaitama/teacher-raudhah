<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOrganization extends Model
{
    use HasFactory;

		protected $table = 'organizations';

		static function position()
		{
			return [
				1 => 'Ketua',
				2 => 'Wakil Ketua',
				3 => 'Sekretaris',
				4 => 'Bendahara',
				5 => 'Anggota'
			];
		}
}