<?php

namespace App\Http\Resources;

use App\Package;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
        'slider_image'=>asset('../uploads/sliders/').'/'.$this->image,
         'id'=>$this->id,
        'created_at'=>$this->created_at,
        'package'=>[
        'name'=>$this->package->name,
        'id'=>$this->package->id,
        'price'=>$this->package->price,
            ],
        ];
    }
}
