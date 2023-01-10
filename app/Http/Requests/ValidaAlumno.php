<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaAlumno extends FormRequest
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
            'ID_ALUMNO' => 'required|max:15',
            'ALUMNO_NOMBRE' => 'required|max:30',
            'ALUMNO_APELLIDO_PAT' => 'required|max:30',
            'ALUMNO_APELLIDO_MAT' => 'max:30',
            'ALUMNO_SEXO' => 'required',
            'ALUMNO_TIPO_SANGRE' => 'max:5',
            'ALUMNO_FECHA_NAC' => 'required|date',
            'ALUMNO_CALLE' => 'required|max:30',
            'ALUMNO_COLONIA' => 'required|max:30',
            'ALUMNO_MUNICIPIO' => 'required|max:30',
            'ALUMNO_ESTADO' => 'required|max:30',
            'ALUMNO_CORREO' => 'required|min:1',
            'ALUMNO_CARRERA' => 'required|max:30',
            'ALUMNO_OBSERVACIONES' => 'max:500',
            'ALUMNO_STATUS' => 'required|max:20',
            'ALUMNO_ING_ANIO' => 'required|min:1',

        ];
    }
}
