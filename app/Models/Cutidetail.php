<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cutidetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuti_id', 'tanggal'
    ];
}
