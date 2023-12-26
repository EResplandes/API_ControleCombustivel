<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DateTime;

class BombaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   

        $dataAtual = new DateTime();
        $inicioDoDia = $dataAtual->setTime(0, 0, 0)->format('Y-m-d H:i:s');
        $fimDoDia = $dataAtual->setTime(23, 59, 59)->format('Y-m-d H:i:s');

        return [
            "id" => $this->id,
            "local" => $this->local,
            "numero_bomba" => $this->numero_bomba,
            "abastecimentos" => $this->abastecimentos,
        ];
    }
}
