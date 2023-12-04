<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $method = $this->method();
        if($method == "PUT"){
            return [
                'Name' => ['required','string','max:255'],
                'email' => ['required','string','email','max:255','unique:users'],
                'password' => ['required','string','min:8','confirmed']
            ];
        }else{
            return [
                'Name' => ['sometimes','required','string','max:255'],
                'email' => ['sometimes','required','string','email','max:255','unique:users'],
                'password' => ['sometimes','required','string','min:8','confirmed']
            ];
        }
    }
    protected function prepareForValidation(){
        if($this->name){
            $this->merge([
                'name' => $this->name
            ]);
        }
    }
}
