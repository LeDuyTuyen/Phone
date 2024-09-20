<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'wards';

    protected $fillable = [
        'wards_name',
        'district_id'
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
