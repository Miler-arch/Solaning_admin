<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'lastname' => 'required',
            'ci' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El campo nombre es requerido.',
            'lastname.required' => 'El campo apellido es requerido.',
            'ci.required' => 'El campo carnet de identidad es requerido.',
            'ci.unique' => 'El carnet de identidad ya se encuentra registrado.',
            'email.required' => 'El campo correo electrónico es requerido.',
            'email.email' => 'El campo correo electrónico debe ser un correo válido.',
            'email.unique' => 'El correo electrónico ya se encuentra registrado.',
            'phone.required' => 'El campo teléfono es requerido.',
            'phone.unique' => 'El teléfono ya se encuentra registrado.',
            'password.required' => 'El campo contraseña es requerido.',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.',
            'password_confirmation.required' => 'El campo confirmar contraseña es requerido.',
            'password_confirmation.same' => 'Las contraseñas no coinciden.',
        ];
    }
}
