<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        $event = $this->post('id') ? $this->post('id') : null;

        return [
            
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => $event ? 'nullable|image|max:4024' : 'required|image|max:4024',
            'content' => 'required|string',
            'datePublish' => 'required|date',
            'externalLink' => 'nullable|url',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            
            'title.required' => 'El título es requerido',
            'title.string' => 'El título debe ser una cadena de caracteres',
            'title.max' => 'El título no debe exceder los 255 caracteres',
            'description.required' => 'La descripción es requerida',
            'description.string' => 'La descripción debe ser una cadena de caracteres',
            'description.max' => 'La descripción no debe exceder los 255 caracteres',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'La imagen debe ser un archivo de imagen',
            'image.max' => 'La imagen no debe exceder los 4MB',
            'content.required' => 'El contenido es requerido',
            'content.string' => 'El contenido debe ser una cadena de caracteres',
            'datePublish.required' => 'La fecha de publicación es requerida',
            'datePublish.date' => 'La fecha de publicación debe ser una fecha válida',
            'externalLink.url' => 'El enlace externo debe ser una URL válida',
        ];
    }

}
