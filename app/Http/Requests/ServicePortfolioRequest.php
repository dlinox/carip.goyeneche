<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicePortfolioRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $servicePortfolio = $this->post('id') ? $this->post('id') : null;
        return [
            // 'name' => 'required|string',
            // 'description' => 'required|string',
            'guide_name' => 'required|string',
            'guide_file' => $servicePortfolio ? 'nullable|file|mimes:pdf|max:5048' : 'required|file|mimes:pdf|max:5048',
            'resolution_name' => 'required|string',
            'resolution_file' => $servicePortfolio ? 'nullable|file|mimes:pdf|max:5048' : 'required|file|mimes:pdf|max:5048',
            'date_published' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
            'guide_name.required' => 'El nombre de la guía es requerido',
            'guide_file.required' => 'La guía es requerida',
            'guide_file.file' => 'El archivo debe ser un pdf',
            'guide_file.mimes' => 'El archivo debe ser un pdf',
            'guide_file.max' => 'El archivo no debe pesar más de 5MB',
            'resolution_name.required' => 'El nombre de la resolución es requerido',
            'resolution_file.required' => 'La resolución es requerida',
            'resolution_file.file' => 'El archivo debe ser un pdf',
            'resolution_file.mimes' => 'El archivo debe ser un pdf',
            'resolution_file.max' => 'El archivo no debe pesar más de 5MB',
            'date_published.required' => 'La fecha de publicación es requerida',
            'date_published.date' => 'La fecha de publicación debe ser una fecha',
        ];
    }
}
