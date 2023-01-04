<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
        'id' => $this->id,
        'nik' => $this->nik,
        'nama' => $this->nama,
        'alamat' => $this->alamat,
        'telepon' => $this->telepon,
        'foto' => $this->foto,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ];
    }
}
