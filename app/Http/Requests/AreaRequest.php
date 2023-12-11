<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
            'name' => 'required|string|max:60',
            'description' => 'nullable|string|max:250',
            'figure' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre debe tener máximo 60 caracteres',
            'description.string' => 'La descripción debe ser una cadena de caracteres',
            'description.max' => 'La descripción debe tener máximo 250 caracteres',
            'figure.required' => 'La figura es requerida',
            'figure.string' => 'La figura debe ser una cadena de caracteres',
        ];
    }

}