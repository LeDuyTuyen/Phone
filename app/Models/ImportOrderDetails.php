<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportOrderDetails extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'import_order_details';

    protected $fillable = [
        'price',
        'quantity',
        'import_order_id',
        'warehouse_id',
    ];

    public function importOrder()
    {
        return $this->belongsTo(ImportOrder::class);
    }

    public function wareHouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
