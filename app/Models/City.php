<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'cities';

    protected $fillable = [
        'city_name',
        'type'
    ];

    public function receiver()
    {
        return $this->hasMany(Receiver::class);
    }
    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }
}
