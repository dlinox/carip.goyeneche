<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinalServiceRequest extends FormRequest
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
 
        $finalService = $this->post('id') ? $this->post('id') : null;

        return [
            'name' => 'required|string',
            'image' => $finalService ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'specialty_id' => 'required|exists:specialties,id',
            'worker_id' => 'required|exists:workers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser una imagen',
            'image.max' => 'El archivo no debe pesar más de 2MB',
            'description.required' => 'La descripción es requerida',
            'specialty_id.required' => 'La especialidad es requerida',
            'worker_id.required' => 'El trabajador es requerido',
        ];
    }
}
