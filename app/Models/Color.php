<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'colors';

    protected $fillable = [
        'name',
        'code',
    ];

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }
}
