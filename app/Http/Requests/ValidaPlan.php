<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaPlan extends FormRequest
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


            'ID_PLANESTUDIO' => 'required|max:30',
            'PLAN_CLAVE' => 'required|max:30',
            'PLAN_NOMBRE_IDIOMA' => 'required|max:20',
            'PLAN_IN' => 'required|date',
            'PLAN_FIN' => 'required|date',
            'PLAN_ESTADO' => 'required|max:10',
            'PLAN_CMOD' => 'required|min:1'

        ];
    }
}
