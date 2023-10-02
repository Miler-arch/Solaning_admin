<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $courseId = $this->route('course'); // Obtiene el identificador del curso actual

        return [
            'name' => 'required|max:255|unique:courses,name,' . $courseId, // Excluye el curso actual de la validación
            'version' => 'required',
            'category' => 'required|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'expire_date' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es requerido.',
            'name.max' => 'El campo nombre no debe exceder los 255 caracteres.',
            'name.unique' => 'El campo nombre ya existe.',
            'version.required' => 'El campo versión es requerido.',
            'category.required' => 'El campo categoría es requerido.',
            'category.max' => 'El campo categoría no debe exceder los 255 caracteres.',
            'price.required' => 'El campo precio es requerido.',
            'discount.required' => 'El campo descuento es requerido.',
            'discount.numeric' => 'El campo descuento debe ser numérico.',
            'expire_date.required' => 'El campo fecha de expiración es requerido.',
            'expire_date.max' => 'El campo fecha de expiración no debe exceder los 255 caracteres.',
        ];
    }
}

