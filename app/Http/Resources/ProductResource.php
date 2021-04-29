<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SupplierResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        static::$wrap='product';

        return [
            'id'                => $this['id'],
            'name'              => $this['name'],
            'description'       => $this['description'],
            'units'             => $this['units'],
            'price'             => $this['price'],
            'discount'          => $this['discount'],
            'address'           => $this['address'],
            'image'             => URL::to('/').'/public/uploads/products/'.$this['image'],
            'supplier'          => new  SupplierResource($this['supplier']),
            'category'          => new  CategoryResource($this['category']),
            'created_at'        => $this['created_at'],
        ];
    }
}
