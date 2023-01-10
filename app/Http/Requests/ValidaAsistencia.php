<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaAsistencia extends FormRequest
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
            // 
            'ID_ASISTENCIA' => 'required|max:30',
            'ASISTENCIA_ID_GRUPO_NOMBRE' => 'required|max:30',
            'ASISTENCIA_ID_DOCENTE' => 'required|max:30',
            'ASISTENCIA_ID_ALUMNO' => 'required|max:30',
            'ASISTENCIA_FECHA' => 'required|date',
            'ASISTENCIA_CLASE' => 'required|max:30'
        ];
    }
}
