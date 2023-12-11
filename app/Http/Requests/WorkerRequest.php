<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // $table->id();
    // $table->string('name');
    // $table->string('paternal_surname', 60);
    // $table->string('maternal_surname', 60);
    // $table->enum('document_type', ['DNI'])->default('DNI');
    // $table->char('document_number', 8)->unique();
    // $table->string('photo');
    // $table->char('phone_number', 9)->nullable();
    // $table->string('email')->unique()->nullable();
    // $table->text('description')->nullable();
    // $table->boolean('is_active')->default(true);
    // $table->boolean('is_doctor')->default(true);
    // $table->boolean('is_authority')->default(false);
    // $table->unsignedBigInteger('specialty_id')->nullable();
    // $table->foreign('specialty_id')->references('id')->on('specialties')->onUpdate('cascade')->onDelete('set null');

    public function rules(): array
    {


        $worker = $this->post('id') ? $this->post('id') : null;

        return [
            'name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'required|string|max:255',
            'document_number' => 'required|digits:8|unique:workers,document_number,' . $worker,
            'registration_code' => 'nullable|digits:6|unique:workers,registration_code,' . $worker,
            'photo' => $worker ? 'nullable|image|mimes:jpeg,png,jpg,svg|max:4048' : 'required|image|mimes:jpeg,png,jpg,svg|max:4048',
            'phone_number' => 'nullable|digits:9,phone_number,' . $worker,
            'email' => 'nullable|email|max:255|unique:workers,email,' . $worker,
            'description' => 'nullable|string|max:255',
            'specialty_id' => 'nullable|exists:specialties,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'paternal_surname.required' => 'El apellido paterno es requerido',
            'paternal_surname.string' => 'El apellido paterno debe ser una cadena de caracteres',
            'paternal_surname.max' => 'El apellido paterno no debe exceder los 255 caracteres',
            'maternal_surname.required' => 'El apellido materno es requerido',
            'maternal_surname.string' => 'El apellido materno debe ser una cadena de caracteres',
            'maternal_surname.max' => 'El apellido materno no debe exceder los 255 caracteres',
            'document_number.required' => 'El número de documento es requerido',
            'document_number.digits' => 'El número de documento debe tener 8 dígitos',
            'document_number.unique' => 'El número de documento ya está en uso',
            'registration_code.digits' => 'El código de registro debe tener 6 dígitos',
            'registration_code.unique' => 'El código de registro ya está en uso',
            'photo.required' => 'La foto es requerida',
            'photo.image' => 'La foto debe ser una imagen',
            'photo.mimes' => 'La foto debe ser de tipo jpeg, png, jpg, svg',
            'photo.max' => 'La foto no debe exceder los 4048 kilobytes',
            'phone_number.digits' => 'El número de teléfono debe tener 9 dígitos',
            'phone_number.unique' => 'El número de teléfono ya está en uso',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres',
            'email.unique' => 'El correo electrónico ya está en uso',
            'description.string' => 'La descripción debe ser una cadena de caracteres',
            'description.max' => 'La descripción no debe exceder los 255 caracteres',
            'specialty_id.exists' => 'La especialidad no existe',
        ];
    }
}
