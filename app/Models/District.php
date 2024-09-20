<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'districts';

    protected $fillable = [
        'district_name',
        'type',
        'city_id'
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
