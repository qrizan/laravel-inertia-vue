<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SupplierResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => Storage::url('products/'.$this->image),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'supplier' => SupplierResource::make($this->whenLoaded('supplier')),
            'created_at' => $this->created_at->toFormattedDateString()
        ];
    }
}
