<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
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
        $method= $this->method();
        if($method== "PUT"){
            return [
                'NombreE' => ['required','string','max:40'],
                'NITE' => ['required','string','max:30'],
                'DireccionE' => ['required','string','max:35'],
                'TelefonoE' => ['required','string','max:20'],
                'ActividadComercialE' => ['required','string','max:50'],
                'Codigo_CIUU' => ['required','string','max:10'],
            ];
        }else{
            return [
                'NombreE' => ['sometimes','required','string','max:40'],
                'NITE' => ['sometimes','required','string','max:30'],
                'DireccionE' => ['sometimes','required','string','max:35'],
                'TelefonoE' => ['sometimes','required','string','max:20'],
                'ActividadComercialE' => ['sometimes','required','string','max:50'],
                'Codigo_CIUU' => ['sometimes','required','string','max:10'],
            ];
        }
    }
    protected function prepareForValidation(){
        if($this->codigo_ciuu){
            $this->merge([
                'codigo_ciuu' => $this->codigo_ciuu
            ]);
        }
    }
}
