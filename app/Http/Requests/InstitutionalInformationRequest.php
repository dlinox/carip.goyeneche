<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionalInformationRequest extends FormRequest
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

        /*
                $table->id();
            $table->string('name', 120);
            $table->text('description');
            $table->string('address', 180); //direccion
            $table->char('phone', 9); //telefono
            $table->string('email', 120); //correo
            $table->text('mission');//mision
            $table->text('vision');//vision
            $table->string('organigram'); //imagen organigrama
            $table->string('parties_table', 120)->nullable(); //mesas de partes
            $table->char('ruc', 11)->nullable(); //ruc
            $table->text('about_us')->nullable(); //nosotros
            $table->text('values')->nullable();//valores
            $table->text('motto')->nullable();//lema
            $table->text('history')->nullable(); //historia
            $table->text('logo')->nullable(); //logo
            $table->text('favicon')->nullable(); //favicon
            $table->text('facebook')->nullable(); //otra tabla  redes sociales
            $table->text('twitter')->nullable(); //otra tabla   redes
            $table->text('instagram')->nullable(); //otra tabla redes
            $table->text('youtube')->nullable(); //otra tabla   redes
            $table->text('whatsapp')->nullable(); //otra tabla  redes
        */
        return [
            'name' => 'required|string|max:120',
            'description' => 'required|string',
            'address' => 'required|string|max:180',
            'phone' => 'required|string|digits:9',
            'email' => 'required|email|max:120',
            'mission' => 'required|string',
            'vision' => 'required|string',
            'organigram' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'parties_table' => 'nullable|string|max:120',
            'ruc' => 'nullable|string|digits:11',
            'about_us' => 'nullable|string',
            'values' => 'nullable|string',
            'motto' => 'nullable|string',
            'history' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico|max:1048',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable|digits:9',
            
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es requerido',
            'name.string' => 'El campo nombre debe ser una cadena de texto',
            'name.max' => 'El campo nombre debe tener como máximo 120 caracteres',

            'description.required' => 'El campo descripción es requerido',
            'description.string' => 'El campo descripción debe ser una cadena de texto',

            'address.required' => 'El campo dirección es requerido',
            'address.string' => 'El campo dirección debe ser una cadena de texto',
            'address.max' => 'El campo dirección debe tener como máximo 180 caracteres',

            'phone.required' => 'El campo teléfono es requerido',
            'phone.string' => 'El campo teléfono debe ser una cadena de texto',
            'phone.digits' => 'El campo teléfono debe tener 9 dígitos',

            'email.required' => 'El campo correo es requerido',
            'email.email' => 'El campo correo debe ser un correo válido',
            'email.max' => 'El campo correo debe tener como máximo 120 caracteres',

            'mission.required' => 'El campo misión es requerido',
            'mission.string' => 'El campo misión debe ser una cadena de texto',

            'vision.required' => 'El campo visión es requerido',
            'vision.string' => 'El campo visión debe ser una cadena de texto',

            'organigram.image' => 'El campo organigrama debe ser una imagen',
            'organigram.mimes' => 'El campo organigrama debe ser una imagen de tipo: jpeg,png,jpg,gif,svg',
            'organigram.max' => 'El campo organigrama debe pesar como máximo 4048 kilobytes',

            'parties_table.string' => 'El campo mesas de partes debe ser una cadena de texto',
            'parties_table.max' => 'El campo mesas de partes debe tener como máximo 120 caracteres',

            'ruc.string' => 'El campo ruc debe ser una cadena de texto',
            'ruc.digits' => 'El campo ruc debe tener 11 dígitos',

            'about_us.string' => 'El campo nosotros debe ser una cadena de texto ',
            'values.string' => 'El campo valores debe ser una cadena de texto',
            'motto.string' => 'El campo lema debe ser una cadena de texto',
            'history.string' => 'El campo historia debe ser una cadena de texto',

            'logo.image' => 'El campo logo debe ser una imagen',
            'logo.mimes' => 'El campo logo debe ser una imagen de tipo: jpeg,png,jpg,gif,svg',
            'logo.max' => 'El campo logo debe pesar como máximo 2048 kilobytes',

            'favicon.image' => 'El campo favicon debe ser una imagen',
            'favicon.mimes' => 'El campo favicon debe ser una imagen de tipo: ico',
            'favicon.max' => 'El campo favicon debe pesar como máximo 1048 kilobytes',

            'facebook.url' => 'El campo facebook debe ser una url válida',
            'twitter.url' => 'El campo twitter debe ser una url válida',
            'instagram.url' => 'El campo instagram debe ser una url válida',
            'youtube.url' => 'El campo youtube debe ser una url válida',

            'whatsapp.digits' => 'El campo whatsapp debe tener 9 dígitos',
        ];
    }
}
