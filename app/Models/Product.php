<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
