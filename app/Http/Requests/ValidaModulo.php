<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaModulo extends FormRequest
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



            'RETICULA_NOMBRE' => 'required|max:5',
            'ID_PLANESTUDIO' => 'required|max:5',
            'MODULO_NIVEL' =>    'required|min:1',
            //
        ];
    }
}
