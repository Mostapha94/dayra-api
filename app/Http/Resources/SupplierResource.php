<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        static::$wrap='supplier';

        return [
            'id'                => $this['id'],
            'name'              => $this['name'],
            'user_name'         => $this['user_name'],
            'email'             => $this['email'],
            'phone'             => $this['phone'],
            'address'           => $this['address'],
            'image'             => URL::to('/').'/public/uploads/supplier/'.$this['image'],
            'created_at'        => $this['created_at'],
        ];
    }
}
