<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'lastname'=>'required|string',
            'age'=>'required|numeric|integer',
            'ci'=>'required|numeric|unique:clients',
            'email'=>'required|email|unique:clients',
            'phone'=>'required|numeric|unique:clients',
            'reference_phone'=>'required|numeric|unique:clients',
        ];
    }

    public function messages(){
        return[
            'name.required'=>'El nombre es requerido',
            'name.string'=>'El nombre debe ser una cadena de caracteres',
            'lastname.required'=>'El apellido es requerido',
            'lastname.string'=>'El apellido debe ser una cadena de caracteres',
            'age.required'=>'La edad es requerida',
            'age.numeric'=>'La edad debe ser un número',
            'age.integer'=>'La edad debe ser un número entero',
            'ci.required'=>'El carnet de identidad es requerido',
            'ci.numeric'=>'El carnet de identidad debe ser un número',
            'ci.unique'=>'El carnet de identidad ya existe',
            'email.required'=>'El correo es requerido',
            'email.email'=>'El correo debe ser un correo válido',
            'email.unique'=>'El correo ya existe',
            'phone.required'=>'El teléfono es requerido',
            'phone.numeric'=>'El teléfono debe ser un número',
            'phone.unique'=>'El teléfono ya existe',
            'reference_phone.required'=>'El teléfono de referencia es requerido',
            'reference_phone.numeric'=>'El teléfono de referencia debe ser un número',
            'reference_phone.unique'=>'El teléfono de referencia ya existe',
        ];
    }
}
