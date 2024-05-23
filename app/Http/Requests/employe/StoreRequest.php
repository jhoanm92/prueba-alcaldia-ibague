<?php

namespace App\Http\Requests\employe;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'lastname' => ['required', 'string', 'min:3', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
            'email' => ['nullable', 'email', 'unique:employes,email'],
            'identification' => ['required', 'string', 'min:3', 'max:255', 'unique:employes,identification'],
            'birthday' => ['required', 'date'],
            'phone' => ['required', 'min:3', 'max:255'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
            'sex' => ['required', 'string', 'in:F,M'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'lastname' => 'apellido',
            'department_id' => 'departamento',
            'email' => 'correo electrónico',
            'identification' => 'identificación',
            'birthday' => 'fecha de nacimiento',
            'phone' => 'teléfono',
            'address' => 'dirección',
            'sex' => 'sexo'
        ];
    }
}
