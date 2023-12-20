<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AbastecimentoResource extends JsonResource
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
            "id" => $this->id,
            "Quantidade_ML" => $this->Quantidade_ML,
            "created_at" => $this->created_at,
            "funcionario" => VeiculoResource::collection($this->funcionario)       
        ];
    }
}
