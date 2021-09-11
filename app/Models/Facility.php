<?php

namespace App\Models;

use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Facility extends Model
{
    use HasFactory, HasSlug, HasPrice;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $fillable = ['name', 'slug', 'category_id', 'price', 'content'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function images() {
        return $this->hasMany(FacilityImage::class);
    }
}
