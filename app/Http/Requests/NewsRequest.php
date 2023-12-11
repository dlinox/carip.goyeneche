<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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

        $news = $this->post('id') ? $this->post('id') : null;

        return [
            
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => $news ? 'nullable|image|max:4024' : 'required|image|max:4024',
            'content' => 'required|string',
            'date_publish' => 'required|date',
            'external_link' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es requerido',
            'description.required' => 'La descripción es requerida',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.max' => 'El archivo no debe pesar más de 2MB',
            'content.required' => 'El contenido es requerido',
            'date_publish.required' => 'La fecha de publicación es requerida',
            'date_publish.date' => 'La fecha de publicación debe ser una fecha válida',
            'external_link.url' => 'El enlace externo debe ser una URL válida',
        ];
    }

}
