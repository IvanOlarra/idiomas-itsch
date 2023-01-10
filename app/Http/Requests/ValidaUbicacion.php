<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaUbicacion extends FormRequest
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

            'ID_UBICACION' => 'required|max:30',
            'UBICACION_EDIFICIO' => 'required|max:1',
            'UBICACION_SALON' => 'required|numeric'

        ];
    }
}
