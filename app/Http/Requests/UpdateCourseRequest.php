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
            'name' => 'required|max:255',
            'version' => 'required|unique:courses,version,' . $courseId,
            'category' => 'required|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'expire_date' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'version.unique' => 'La versión ya existe.',
            'version.required' => 'La versión es requerido.',
            'category.required' => 'La categoría es requerido.',
            'category.max' => 'La categoría no debe exceder los 255 caracteres.',
            'price.required' => 'El precio es requerido.',
            'discount.required' => 'El descuento es requerido.',
            'discount.numeric' => 'El descuento debe ser numérico.',
            'expire_date.required' => 'La fecha de expiración es requerido.',
            'expire_date.max' => 'La fecha de expiración no debe exceder los 255 caracteres.',
        ];
    }
}

