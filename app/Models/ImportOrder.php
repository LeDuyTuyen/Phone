<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ImportOrder extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'import_orders';

    protected $fillable = [
        'total',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function importOrderDetails()
    {
        return $this->hasMany(ImportOrderDetails::class);
    }
}
