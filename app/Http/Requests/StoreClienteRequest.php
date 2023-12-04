<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Nombre' => ['required','string','max:40'],
            'NIT' => ['required','string','max:30'],
            'Direccion' => ['required','string','max:35'],
            'Telefono' => ['required','string','max:20'],
            'ActividadComercial' => ['required','string','max:50'],
            'Codigo_CIUU' => ['required','string','max:10'],
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'codigo_ciuu' => $this->codigo_ciuu
        ]);
    }
}
