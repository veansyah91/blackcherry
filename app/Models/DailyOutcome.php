<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyOutcome extends Model
{
    use HasFactory;

    protected $fillable = ['keterangan', 'jumlah', 'tanggal'];

    public function scopeGetCount($query, $date){
        return $query->where('tanggal', $date)->sum('jumlah');
    }
}
