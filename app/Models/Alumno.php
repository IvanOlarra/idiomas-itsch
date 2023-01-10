<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;
use stdClass;

class Alumno extends Model
{
    use HasFactory;

    //Eliminar marcas de tiempo
    public $timestamps = false;

    //llave primaria    
    protected $primaryKey = 'ID_ALUMNO';

    //deshabilitar autoincremento
    public $incrementing = false;

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'inscripciones', 'ID_ALUMNO', 'ID_GRUPO');
    }

    public function cardex()
    {
        return $this->hasMany(Cardex::class, 'ID_ALUMNO', 'ID_ALUMNO');
    }

    public function lastCardex()
    {
        $modulos = Cardex::join('alumnos', 'alumnos.ID_ALUMNO', '=', 'cardexes.ID_ALUMNO')
        ->join('planestudios',  'planestudios.ID_PLANESTUDIO', '=', 'cardexes.ID_PLANESTUDIO')
        //->join('modulos',  'modulos.ID_MODULO', '=', 'cardex.ID_MODULO')
        ->select(
            'cardexes.*',
            'alumnos.*',
            'planestudios.*',
        )
        ->get();

        $ultimos = [];

        foreach ($modulos as $modulo) {
            
            $actual = intval(str_replace($modulo->ID_PLANESTUDIO."_M", '', $modulo->ID_MODULO));
            

            if (isset($ultimos[$modulo->ID_PLANESTUDIO])) {
                $max = $ultimos[$modulo->ID_PLANESTUDIO]['modulo'];
                if ($actual > $max) {
                    $ultimos[$modulo->ID_PLANESTUDIO]['modulo'] = $actual;
                    $ultimos[$modulo->ID_PLANESTUDIO]['calificacion'] = $modulo->CARDEX_CALIFICACION;
                }
            } else {
                $ultimos[$modulo->ID_PLANESTUDIO] = [];
                $ultimos[$modulo->ID_PLANESTUDIO]['modulo'] = $actual;
                $ultimos[$modulo->ID_PLANESTUDIO]['calificacion'] = $modulo->CARDEX_CALIFICACION;
            }
        }
        return $ultimos;
    }
}
