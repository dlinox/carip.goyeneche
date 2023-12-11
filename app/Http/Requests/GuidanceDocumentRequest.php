<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuidanceDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $guidanceDocuments = $this->post('id') ? $this->post('id') : null;
        return [
            'guide_name' => 'required|string',
            'guide_file' => $guidanceDocuments ? 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'resolution_name' => 'nullable|string',
            'resolution_file' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'resolution_file.file' => 'El archivo debe ser un pdf',
            'resolution_file.mimes' => 'El archivo debe ser un pdf',
            'resolution_file.max' => 'El archivo no debe pesar más de 5MB',
            'date_published.required' => 'La fecha de publicación es requerida',
            'date_published.date' => 'La fecha de publicación debe ser una fecha',
        ];
    }
}
