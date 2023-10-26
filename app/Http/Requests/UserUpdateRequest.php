<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');
        return [
            'name'=>'required|string',
            'lastname'=>'required|string',
            'ci'=>'required|numeric|unique:users,ci,' . $userId,
            'email'=>'required|email|unique:users,email,' . $userId,
            'phone'=>'required|numeric|unique:users,phone,' . $userId,
            'password'=>'nullable',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'El nombre es requerido',
            'name.string'=>'El nombre debe ser una cadena de caracteres',
            'lastname.required'=>'El apellido es requerido',
            'lastname.string'=>'El apellido debe ser una cadena de caracteres',
            'ci.required'=>'El carnet de identidad es requerido',
            'ci.numeric'=>'El carnet de identidad debe ser un número',
            'ci.unique'=>'El carnet de identidad ya existe',
            'email.required'=>'El correo es requerido',
            'email.email'=>'El correo debe ser un correo válido',
            'email.unique'=>'El correo ya existe',
            'phone.required'=>'El teléfono es requerido',
            'phone.numeric'=>'El teléfono debe ser un número',
            'phone.unique'=>'El teléfono ya existe',

        ];
    }
}
