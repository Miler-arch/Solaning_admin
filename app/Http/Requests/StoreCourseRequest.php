<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'version' => 'required|unique:courses',
            'category' => 'required|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'start_date' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'version.unique' => 'La vesión ya existe.',
            'version.required' => 'La versión es requerido.',
            'category.required' => 'La categoría es requerido.',
            'category.max' => 'La categoría no debe exceder los 255 caracteres.',
            'price.required' => 'El precio es requerido.',
            'discount.required' => 'El descuento es requerido.',
            'discount.numeric' => 'El descuento debe ser numérico.',
            'start_date.required' => 'La fecha de inicio es requerido.',
            'start_date.max' => 'La fecha de inicio no debe exceder los 255 caracteres.',
        ];
    }
}
