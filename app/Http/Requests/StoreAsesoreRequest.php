<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreAsesoreRequest extends FormRequest
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
            'NombreAsesor' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'ProfesionAsesor' => ['required', 'string', 'max:30'],
            'licenciaAsesor' => ['required', 'string', 'max:20']
        ];
        
    }

    protected function prepareForValidation(){
        $this->merge([
            'licencia_asesor' => $this->licencia_asesor
        ]);
    }
}
