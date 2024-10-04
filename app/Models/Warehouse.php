<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Warehouse extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'warehouses';

    protected $fillable = [
        'price',
        'product_id',
        'color_id',
        'ram_id',
        'storage_id',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function ram()
    {
        return $this->belongsTo(Ram::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function importOrderDetail()
    {
        return $this->hasMany(ImportOrderDetails::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
