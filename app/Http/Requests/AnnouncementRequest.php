<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
        //si el id existe el id se envia en el post, significa que se está editando y el dimuento no es requerido

        $document = $this->post('id') ? 'nullable|' : 'required|';

        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'date_published' => 'required|date',
            'documents' => $document . 'file|mimes:pdf|max:10240',
            'documents' => $document . 'array',
            'documents.*.fileName' => $document . 'string',
            'documents.*.file' =>  $document . 'array',
            'documents.*.file.*' => $document . 'file|mimes:pdf|max:10240', // Asegura que cada elemento en el array sea un archivo.
            'documents.*.fileDate' => $document . 'date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El campo título es requerido.',
            'description.required' => 'El campo descripción es requerido.',
            'date_published.required' => 'El campo fecha de publicación es requerido.',
            'document.required' => 'El campo documento es requerido.',
            'document.file' => 'El campo documento debe ser un archivo.',
            'document.mimes' => 'El campo documento debe ser un archivo de tipo: pdf.',
            'document.size' => 'El campo documento no debe ser mayor a 10MB.',
        ];
    }
}
