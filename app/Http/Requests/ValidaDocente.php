<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaDocente extends FormRequest
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

            'ID_DOCENTE' => 'required|max:6',
            'DOCENTE_CLAVE' => 'required|max:30',
            'DOCENTE_AP_PAT' => 'required|max:30',
            'DOCENTE_AP_MAT' => 'max:30',
            'DOCENTE_NOMBRE' => 'required|max:30',
            'DOCENTE_SEXO' => 'required',
            'DOCENTE_TIPO_SANGRE' => 'max:5',
            'DOCENTE_FECHA_NAC' => 'required|date',
            'DOCENTE_CALLE' => 'required|max:30',
            'DOCENTE_COLONIA' => 'required|max:30',
            'DOCENTE_MUNICIPIO' => 'required|max:30',
            'DOCENTE_ESTADO' => 'required|max:30',
            'DOCENTE_MOVIL' => 'required',
            'DOCENTE_CASA' => 'required',
            'DOCENTE_CORREO' => 'required|max:30',
            'DOCENTE_GRADO_ESCOLAR' => 'max:30',
            'DOCENTE_ESPECIALIDAD' => 'max:30',
            'DOCENTE_FECHA_ING' => 'required|date',
            'DOCENTE_OBSERVACIONES' => 'required|max:500',

            //
        ];
    }
}
