<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'jumlah', 'nomor', 'customer_id', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoiceDetail()
    {
        return $this->hasMany(Invoice::class);
    }
}
