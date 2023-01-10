<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    //Deshabilitar marcas de tiempo
    public $timestamps = false;

    //deshabilitar autoincremento
    public $incrementing = false;

    //Especificamos el nombre de campo para la llave primaria
    protected $primaryKey = 'ID_GRUPO';

    //Atributos de Grupo asignables en masa
    protected $fillable = [
        'GRUPO_NOMBRE',
        'ID_MODULO',
        'GRUPO_TIPO',
        'GRUPO_CLA',
        'GRUPO_NUM_GRUPO',
        'GRUPO_DES',
        'GRUPO_NUM_ALUMNOS',
        'GRUPO_LIMITE',
        'ID_DOCENTE',
        'GRUPO_DIAS',
        'GRUPO_HORAS',
        'GRUPO_UBICACION',
    ];

    //Atributos no asignables en masa
    protected $guarded = [
        'ID_GRUPO',

    ];

    //Relaciones
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'ID_MODULO');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }

    //Relación varios a varios a través de la tabla inscripcions
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'inscripciones', 'ID_GRUPO', 'ID_ALUMNO');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'ID_GRUPO', 'ID_GRUPO');
    }
}
