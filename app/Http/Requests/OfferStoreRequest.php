<?php

namespace App\Http\Requests;

use App\Family;
use Illuminate\Foundation\Http\FormRequest;

class OfferStoreRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        //Cogemos las familias prof por id, para que nadie pueda añadir otra distinta que no esté en DB
        $families = get_model_selectable_by_name(Family::all());
        $familiesId = "";
        foreach ($families as $key => $family) {
            $familiesId .= $key . ",";
        }

        return [
            'title'             => 'required|string|min:5|max:250',
            'family_id'         => 'required|in:' . $familiesId,
            'description'       => 'required|string|min:10|max:250',
            'requirements'      => 'nullable|max:250',
            'recommended'       => 'nullable|max:250',
            'work_day'          => 'required|in:full day,half day',
            'schedule'          => 'required|min:5|max:250',
            'contract'          => 'required|in:FCT,Practice,Temporay,Indefinite',
            'salary'            => 'required|numeric',
            'student_number'    => 'required|numeric',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date',
        ];
    }
}
