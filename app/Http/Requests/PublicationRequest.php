<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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

        $publication = $this->post('id') ? $this->post('id') : null;
        $document = $this->post('id') ? 'nullable|' : 'required|';
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => $publication ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'documents' => $document . 'array',
            'documents.*.fileName' => $document . 'string',
            'documents.*.file' =>  $document . 'array',
            'documents.*.file.*' => $document . 'file|mimes:pdf|max:10240', // Asegura que cada elemento en el array sea un archivo.
            'documents.*.fileDate' => $document . 'date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser una imagen válida',
            'image.max' => 'El archivo no debe pesar más de 2MB',

            'documents.required' => 'El campo documento es requerido.',
            'documents.array' => 'El campo documento debe ser un array.',
            'documents.*.fileName' => 'El campo nombre del documento es requerido.',
            'documents.*.fileDate' => 'El campo fecha del documento es requerido.',

            'documents.*.file.required' => 'El campo documento es requerido.',
            'documents.*.file.*.max' => 'El campo documento no debe ser mayor a 10MB.',
            'documents.*.file.*.required' => 'El campo documento no debe ser mayor a 10MB.',

        ];
    }

}
