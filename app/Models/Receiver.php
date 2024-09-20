<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'receivers';

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'address',
        'note',
        'city_id',
        'district_id',
        'ward_id'
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
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
