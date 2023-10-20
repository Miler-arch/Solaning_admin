<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
                'method_payment' => 'required',
                'business_name' => 'nullable',
                'nit' => 'nullable|unique:registrations,nit',
                'mount' => 'required|numeric',
                'start_date' => 'required',
                'client_id' => 'required',
                'course_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'method_payment.required' => 'El método de pago es obligatorio',
            'business_name.required' => 'El nombre de la empresa es obligatorio',
            'nit.required' => 'El nit es obligatorio',
            'nit.unique' => 'El nit ya existe',
            'mount.required' => 'El monto es obligatorio',
            'mount.numeric' => 'El monto debe ser numérico',
            'start_date.required' => 'La fecha de inicio es obligatorio',
            'client_id.required' => 'El cliente es obligatorio',
            'course_id.required' => 'El curso es obligatorio',
        ];
    }
}
