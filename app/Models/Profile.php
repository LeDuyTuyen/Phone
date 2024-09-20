<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'profiles';

    protected $fillable = [
        'full_name',
        'phone',
        'address',
        'gender',
        'birthday',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }
}
