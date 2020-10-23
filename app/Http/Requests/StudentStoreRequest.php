<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|unique:users,email',
            'name'          => 'required|string',
            'apellidos'     => 'required|string',
            'password'      => 'required|confirmed',
            'phone'         => 'required',
            'nre'           => 'required|numeric',
            'vehiculo'      => 'nullable|numeric',
            'domicilio'     => 'required|string|max:100',
            'status'        => 'required',
            'edad'          => 'required|numeric|max:100'
        ];
    }
}
