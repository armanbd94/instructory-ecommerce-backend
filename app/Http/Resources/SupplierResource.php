<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mobile_no' => $this->mobile_no,
            'address' => $this->address,
            'status' => $this->status,
            'created_by' => $this->createdBy,
            'created_at' => date('d-M-Y h:i:s A',strtotime($this->created_at)),
        ];
    }
}
