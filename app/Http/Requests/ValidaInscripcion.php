<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaInscripcion extends FormRequest
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



            'ID_INSCRIPCION' => 'required|max:30',
            'INSCRIPCION_ID_ALUMNO' => 'required|max:30',
            'INSCRIPCION_ID_GRUPO_NOMBRE' => 'required|max:30',
            'INSCRIPCION_NUM_FOLIO' => 'required|min:1|numeric',
            'INSCRIPCION_MONTO' => 'required|min:1|numeric',
            'ISCRIPCION_FECHA' => 'required|date',
            'INS_PER' => 'required|max:8',
            'INS_AN' => 'required|min:1|numeric'

        ];
    }
}
