<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProyectoRequest extends FormRequest
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
                'idClientes' => ['required','int','max:30'],
                'idAsesores' => ['required','int','max:30'],
                'Nombre' => ['required','string','max:20'],
                'Riesgos' => ['required','int','max:20']
            ];
        }else{
            return [
                'idClientes' => ['sometimes','required','int','max:30'],
                'idAsesores' => ['sometimes','required','int','max:30'],
                'Nombre' => ['sometimes','required','string','max:20'],
                'Riesgos' => ['sometimes','required','int','max:20']
            ];
        }
    }
    protected function prepareForValidation(){
        if($this->Riesgo){
            $this->merge([
                'Riesgo' => $this->Riesgo
            ]);
        }
    }
}
