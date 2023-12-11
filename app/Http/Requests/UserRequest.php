<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->id ?  $this->id : null;

        return [
            'name' => 'required|string|max:60',
            'paternal_surname' => 'required|string|max:60',
            'maternal_surname' => 'required|string|max:60',
            'phone_number' => 'required|digits:9',
            'document_number' => 'required|digits:8|unique:users,document_number,' . $userId,
            'email' => 'required|string|max:60|unique:users,email,' . $userId,
            'role' => 'required|string|in:Super Admin,Administrador,Operador',
            'password' => $userId ? 'nullable|string|max:60' : 'required|string|max:60',
            'area_id' => 'nullable|exists:areas,id',
            'permissions' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre debe tener máximo 60 caracteres',
            'paternal_surname.required' => 'El apellido paterno es requerido',
            'paternal_surname.string' => 'El apellido paterno debe ser una cadena de caracteres',
            'paternal_surname.max' => 'El apellido paterno debe tener máximo 60 caracteres',
            'maternal_surname.required' => 'El apellido materno es requerido',
            'maternal_surname.string' => 'El apellido materno debe ser una cadena de caracteres',
            'maternal_surname.max' => 'El apellido materno debe tener máximo 60 caracteres',
            'phone_number.required' => 'El número de teléfono es requerido',
            'phone_number.digits' => 'El número de teléfono debe tener 9 dígitos',
            'document_number.required' => 'El número de documento es requerido',
            'document_number.digits' => 'El número de documento debe tener 8 dígitos',
            'document_number.unique' => 'El número de documento ya existe',
            'email.required' => 'El correo electrónico es requerido',
            'email.string' => 'El correo electrónico debe ser una cadena de caracteres',
            'email.max' => 'El correo electrónico debe tener máximo 60 caracteres',
            'email.unique' => 'El correo electrónico ya existe',
            'role.required' => 'El rol es requerido',
            'role.string' => 'El rol debe ser una cadena de caracteres',
            'role.in' => 'El rol debe ser Super Admin, Administrador u Operador',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser una cadena de caracteres',
            'password.max' => 'La contraseña debe tener máximo 60 caracteres',
            'area_id.exists' => 'El área no existe',
            'permissions.required' => 'Los permisos son requeridos',
        ];
    }
}
