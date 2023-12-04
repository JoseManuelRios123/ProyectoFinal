<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAsesoreRequest extends FormRequest
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
                'NombreAsesorE' => ['required','string','max:30'],
                'ProfesionAsesorE' => ['required','string','max:30'],
                'licenciaAsesorE' => ['required','string','max:20']
            ];
        }else{
            return [
                'NombreAsesorE' => ['sometimes','required','string','max:30'],
                'ProfesionAsesorE' => ['sometimes','required','string','max:30'],
                'licenciaAsesorE' => ['sometimes','required','string','max:20']
            ];
        }
    }
    protected function prepareForValidation(){
        if($this->licencia_asesor){
            $this->merge([
                'licencia_asesor' => $this->licencia_asesor
            ]);
        }
    }
}
