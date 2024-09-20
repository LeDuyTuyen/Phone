<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => $this->image->map(function ($image) {
                return [
                    'path'       => $image->path,
                    'public_id'  => $image->public_id,
                    'product_id' => $image->product->id,
                ];
            }),
            'category_id'   => $this->category->id,
            'category_name' => $this->category->name,
        ];
    }
}
