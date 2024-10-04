<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class Category extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
    ];

    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($category): void {
            $category->slug = Str::slug($category->name);
        });

        self::updating(function ($category): void {
            $category->slug = Str::slug($category->name);
        });
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
