<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntermediateServiceRequest extends FormRequest
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

        $intermediateService = $this->post('id') ? $this->post('id') : null;

        return [
            'name' => 'required|string',
            'supporting_service_id' => 'required|exists:supporting_services,id',
            'description' => 'required|string',
            'image' => $intermediateService ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'supporting_service_id.required' => 'El servicio de apoyo es requerido',
            'description.required' => 'La descripción es requerida',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser una imagen',
            'image.max' => 'El archivo no debe pesar más de 2MB',
        ];
    }
    
}
