<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'waktu', 'lat', 'long', 'jarak', 'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
