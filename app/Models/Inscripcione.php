<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_INSCRIPCION';

    //Deshabilitar marcas de tiempo
    public $timestamps = false;

    //deshabilitar autoincremento
    public $incrementing = false;

    //atributos asignables en masa
    protected $fillable = [
        'ID_INSCRIPCION',
        'ID_GRUPO',
        'ID_ALUMNO',
        'ID_DOCENTE',
        'ID_MODULO',    
        'INSCRIPCION_NUM_FOLIO',
        'INSCRIPCION_MONTO',
        'INSCRIPCION_FECHA',
        'INSCRIPCION_ PERIODO',
        'INSCRIPCION_ANIO',
        /*'P1',
        'P2',
        'P3',
        'P4',
        'PF',
        'CALIFICACION_FECHA',*/
    ];

    public function grupo()
    {
        return $this->hasMany(Grupo::class, 'ID_MODULO');
    }
}
