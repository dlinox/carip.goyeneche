<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerAuthorityRequest extends FormRequest
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
            'position' => 'required|string|max:255',
            'worker_id' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'position.required' => 'El campo posición es requerido',
            'position.string' => 'El campo posición debe ser una cadena de texto',
            'position.max' => 'El campo posición debe tener un máximo de 255 caracteres',
            'worker_id.required' => 'El campo trabajador es requerido',
            'worker_id.integer' => 'El campo trabajador debe ser un número entero',
        ];
    }
}
