<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'jenis_cuti', 'image', 'alasan', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
