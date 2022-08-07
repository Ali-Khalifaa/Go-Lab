<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class Packages extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'package_name'=>$this->name,
            'id'=>$this->id,
            'package_price'=>$this->price,
            'created_at'=>$this->created_at,
            'package_products'=>Products::collection($this->Products),
        ];
    }
}
