<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query)
    {
        if (request('search')) {
            return $query->where('name', 'like', '%' . request('search') . '%');
        }
        if (request("start_date") || request("end_date")) {
            return $query->whereBetween('created_at', [request("start_date"), request("end_date")]);
        }
    }
    public function getCreatedAtAttribute()

    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y');
        //merubah tanggal menjadi format indonesia
    }

    public function Order()
    {
        return $this->hasMany(Order::class);
    }
}
