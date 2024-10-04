<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Storage extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'storages';

    protected $fillable = [
        'storage',
    ];

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
