<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_cliente' => $this->id_cliente,
            'nombre_cliente' => $this->nombre_cliente,
            'nit' => $this->nit,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'actividad_comercial' => $this->actividad_comercial,
            'Codigo_CIUU' => $this->codigo_ciuu,
            'proyecto' => ProyectoResource::collection($this->whenLoaded('proyectos'))
        ];
    }
}
