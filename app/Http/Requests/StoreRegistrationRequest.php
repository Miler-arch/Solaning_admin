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
                'concept' => 'required',
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
            'method_payment.required' => 'El campo método de pago es obligatorio',
            'business_name.required' => 'El campo nombre de la empresa es obligatorio',
            'concept.required' => 'El campo concepto es obligatorio',
            'nit.required' => 'El campo nit es obligatorio',
            'nit.unique' => 'El nit ya existe',
            'mount.required' => 'El campo monto es obligatorio',
            'mount.numeric' => 'El campo monto debe ser numérico',
            'start_date.required' => 'El campo fecha de inicio es obligatorio',
            'client_id.required' => 'El campo cliente es obligatorio',
            'course_id.required' => 'El campo curso es obligatorio',
        ];
    }
}
