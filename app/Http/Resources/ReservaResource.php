<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
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
            "id" => $this->id,
            "Fecha"=> date('D M d Y',strtotime($this->Fecha)) ,
            "Modulo_inicio"=> $this->Modulo_inicio,
            "Modulo_fin"=> $this->Modulo_fin,
            "Motivo"=> $this->Motivo,
            "Laboratorio_id"=> $this->Laboratorio_id,
            "Usuario_id"=> $this->Usuario_id,
            //"user"=> $this->user->name,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}