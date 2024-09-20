<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'deliveries';

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'address',
        'city_id',
        'district_id',
        'ward_id',
        'user_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
