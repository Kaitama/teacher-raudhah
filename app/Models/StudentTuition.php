<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTuition extends Model
{
    use HasFactory;

    protected $table = 'tuitions';

    protected $dates = ['paydate'];
}
