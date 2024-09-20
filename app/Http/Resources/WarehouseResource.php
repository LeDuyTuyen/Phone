<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class WarehouseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'price'   => $this->price,
            'product' => [
                'id'   => $this->product->id,
                'name' => $this->product->name,
            ],
            'color' => [
                'id'   => $this->color->id,
                'name' => $this->color->name,
            ],
            'ram' => [
                'id'  => $this->ram->id,
                'ram' => $this->ram->ram,
            ],
            'storage' => [
                'id'      => $this->storage->id,
                'storage' => $this->storage->storage,
            ],
        ];
    }
}
