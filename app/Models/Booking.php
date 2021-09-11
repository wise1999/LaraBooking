<?php

namespace App\Models;

use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasPrice;

    public function status() {
        return $this->belongsTo(BookingsStatus::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function facility() {
        return $this->belongsTo(Facility::class);
    }

    protected $fillable = [
        'facility_id',
        'user_id',
        'status_id',
        'price',
        'date',
    ];
}
