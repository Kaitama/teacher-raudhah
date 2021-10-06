<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOffense extends Model
{
    use HasFactory;

		protected $table = 'offenses';

		protected $dates = ['date'];
}