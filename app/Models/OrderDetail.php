<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'order_details';

    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'warehouse_id',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
}
