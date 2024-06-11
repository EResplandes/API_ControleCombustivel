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
            "id"                => $this->id,
            "Quantidade_ML"     => $this->Quantidade_ML,
            "maquina"           => $this->maquina,
            "placa"             => $this->placa,
            "horimetro"         => $this->horimetro,
            "motorista"         => $this->responsavel_maquina,
            "dt_abastecimento"  => $this->created_at,
            "frentista"         => new FrentistaResource($this->frentista),
            "local"             => $this->local,
        ];
    }
}
