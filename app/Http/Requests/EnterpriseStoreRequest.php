<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseStoreRequest extends FormRequest
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
            'name'        => 'required|string',
            'email'         => 'required|unique:users,email',
            'phone'      =>  'required|numeric',
            'password'      =>  'required|confirmed',
            'descripcion'   => 'nullable|string',
            'sociedad'          => 'required|in:SL,SA,SAE,SLNE,AUT',
            'cif'               => 'required|string|max:255',
            'fax'               => 'nullable',
            'fecha_fundacion'   => 'nullable|date',
            'web'               => 'nullable',
            'pais'              => 'required|string',
            'ciudad'            => 'required|string',
            'score'             => 'nullable|numeric',
            'min_empleados'     => 'nullable|numeric',
            'max_empleados'     => 'nullable|numeric',
        ];
    }
}
