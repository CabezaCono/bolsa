<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class TeacherUpdateRequest extends FormRequest
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
            'name'          =>  'required|string',
            'apellidos'     => 'required|string|max:191',
            'nrp_expediente'=> 'required|string|max:191',
            'password'      =>  'nullable|confirmed',
            'phone'         =>  'nullable|numeric',
            'email'         => 'required|unique:users,email,'.Session::get('user_id'),
            "is_admin"      => "nullable"
        ];
    }
}
