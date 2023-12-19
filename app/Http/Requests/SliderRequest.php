<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $slider = $this->post('id') ? $this->post('id') : null;

        return [
            'title' =>  'nullable',
            'subtitle' =>  'nullable',
            'image' => $slider ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'more_info_url' =>  'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            // 'title.required' => 'El título es requerido',
            // 'subtitle.required' => 'El subtítulo es requerido',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser una imagen válida',
            'image.max' => 'El archivo no debe pesar más de 4MB',
            'more_info_url.url' => 'La URL debe ser válida',
        ];
    }
}
