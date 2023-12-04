<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AsesoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_asesor' => $this->id_asesor,
            'nombre_asesor' => $this->nombre_asesor,
            'profesion_asesor' => $this->profesion_asesor,
            'licenciaAsesor' => $this->licencia_asesor,
            'proyecto' => ProyectoResource::collection($this->whenLoaded('proyectos')),
        ];
    }
}
