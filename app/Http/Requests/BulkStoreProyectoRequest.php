<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreProyectoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.idClientes' => ['required','int','max:30'],
            '*.idAsesores' => ['required','int','max:30'],
            '*.Nombre' => ['required','string','max:20'],
            '*.Riesgos' => ['required','int','max:20']
        ];
    }

    protected function prepareForValidation(){
        $data = [];
        foreach($this->toArray() as $obj){
            $obj['Riesgo'] = $obj['Riesgos'] ?? null;
            $data[] = $obj;
        }
        $this->merge($data);
    }

}
