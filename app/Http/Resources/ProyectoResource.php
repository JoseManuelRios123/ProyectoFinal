<?php

namespace App\Http\Resources;

use App\Http\Resources\ClienteResource;
use App\Http\Resources\AsesoreResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProyectoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idProyecto' => $this->idProyecto,
            'Nombre' => $this->Nombre,
            'Riesgos' => $this->Riesgo,
            'cliente' => $this->whenLoaded('cliente', function () {
                return ClienteResource::make($this->cliente);
            }),
            'asesor' => $this->whenLoaded('asesore', function () {
                return AsesoreResource::make($this->asesore);
            })
        ];
    }
}
