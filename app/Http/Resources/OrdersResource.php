<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        static::$wrap='orders';

        return [
            'id'                => $this['id'],
            'quantity'          => $this['quantity'],
            'address'           => $this['address'],
            'product'           => new  ProductResource($this['product']),
            'user'              => new  UserResource($this['user']),
            'created_at'        => $this['created_at'],
        ];
    }
}
