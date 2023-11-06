<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clientId = $this->route('client');
        return [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'age' => 'nullable|numeric|integer',
            'ci' => 'required|numeric|unique:clients,ci,' . $clientId,
            'email' => 'nullable|email|unique:clients,email,' . $clientId,
            'phone' => 'required|numeric|unique:clients,phone,' . $clientId,
            'reference_phone' => 'nullable|numeric|unique:clients,reference_phone,' . $clientId,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'lastname.required' => 'El apellido es requerido',
            'lastname.string' => 'El apellido debe ser una cadena de caracteres',
            'age.numeric' => 'La edad debe ser un número',
            'age.integer' => 'La edad debe ser un número entero',
            'ci.required' => 'El carnet de identidad es requerido',
            'ci.numeric' => 'El carnet de identidad debe ser un número',
            'ci.unique' => 'El carnet de identidad ya existe',
            'email.email' => 'El correo debe ser un correo válido',
            'email.unique' => 'El correo ya existe',
            'phone.required' => 'El teléfono es requerido',
            'phone.numeric' => 'El teléfono debe ser un número',
            'phone.unique' => 'El teléfono ya existe',
            'reference_phone.numeric' => 'El teléfono de referencia debe ser un número',
            'reference_phone.unique' => 'El teléfono de referencia ya existe',
        ];
    }
}
