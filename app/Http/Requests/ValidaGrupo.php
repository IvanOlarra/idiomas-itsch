<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaGrupo extends FormRequest
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


            'ID_GRUPO_NOMBRE' => 'required|max:30',
            'ID_PLANESTUDIO' => 'required|max:30',
            'ID_MODULO' => 'required|max:30',
            'GRUPO_SEMESTRE' => 'required|numeric|min:1',
            'GRUPO_TIPO' => 'required|max:30',
            'GRUPO_NUM_ALUMNOS' => 'required|min:1|numeric',
            'ID_DOCENTE' => 'required|max:30',
            'GRUPO_ID_UBICACION' => 'required|max:30',
            'GRUPO_DIA' => 'required|max:30',
            'GRUPO_HORA_IN' => 'required',
            'GRUPO_HORA_FIN' => 'required',
            'GRUPO_HORA_TOTAL' => 'required|numeric|min:1',
            'GRU_LIM' => 'required|min:1|numeric',
            'GRU_HLU' => 'required|max:5',
            'GRU_ALU' => 'required|max:3',
            'GRU_HMA' => 'required|max:5',
            'GRU_AMA' => 'required|max:3',
            'GRU_HMI' => 'required|max:5',
            'GRU_AMI' => 'required|max:3',
            'GRU_HJU' => 'required|max:5',
            'GRU_AJU' => 'required|max:3',
            'GRU_HVI' => 'required|max:5',
            'GRU_AVI' => 'required|max:3',
            'GRU_HSA' => 'required|max:3',
            'GRU_ASA' => 'required|max:3',
            'GRU_DES' => 'required|max:50',

        ];
    }
}
