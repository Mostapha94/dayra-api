<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        static::$wrap='user';

        return [
            'id'                => $this['id'],
            'name'              => $this['name'],
            'user_name'         => $this['user_name'],
            'email'             => $this['email'],
            'phone'             => $this['phone'],
            'address'           => $this['address'],
            'image'             => URL::to('/').'/public/uploads/users/'.$this['image'],
            $this->mergeWhen($this['token'] != '', [
                'token' => $this['token'],
            ]),
        ];
    }
}
