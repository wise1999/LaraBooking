<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingsStatus extends Model
{
    use HasFactory;

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    protected $fillable = [
        'name'
    ];
}
