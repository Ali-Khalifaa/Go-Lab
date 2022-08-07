<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class storesResource extends JsonResource
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
            'id'=>$this->id,
            'store_name'=>$this->name,
            'store_address'=>$this->address,
            'created_at'=>$this->created_at,
         'section_name'=>$this->Section->name,
         'section_id'=>$this->Section->id,
        ];
    }
}
