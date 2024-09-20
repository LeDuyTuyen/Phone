<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'rams';

    protected $fillable = [
        'ram',
    ];



    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }
}
