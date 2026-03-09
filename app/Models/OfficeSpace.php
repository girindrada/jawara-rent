<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class OfficeSpace extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'city_id',
        'is_open',
        'is_full_booked',
        'price',
        'duration',
        'address',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function officeSpacePhotos()
    {
        return $this->hasMany(OfficeSpacePhoto::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function officeSpaceBenefits()
    {
        return $this->hasMany(OfficeSpaceBenefit::class);
    }
}
