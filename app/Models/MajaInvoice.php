<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajaInvoice extends Model
{
    use HasFactory;

    protected $table = 'maja_invoices';

    protected $casts = [
        'paid_at'   => 'datetime',
    ];

    public static $kinds = [
        1 => 'Uang Sekolah',
        2 => 'Uang Tahunan',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
