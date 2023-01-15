<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calificacione extends Model
{
    use HasFactory;

    public $primaryKey = 'ID_CALIF';

    // autoincrement en PrimaryKey
    public $incrementing = false;

    public $timestamps = false;

    //atributos asignables en masa
    protected $fillable = [
        'ID_CALIF',
        'ID_ALUMNO',
        'ID_MODULO',
        'ID_GRUPO',
        'ID_INSCRIPCION',
        'CALIF_PARCIAL1',
        'CALIF_PARCIAL2',
        'CALIF_PARCIAL3',
        'CALIF_PARCIAL4',
        /*'P1',
        'P2',
        'P3',
        'P4',
        'PF',
        'CALIFICACION_FECHA',*/
    ];

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'inscripciones', 'ID_ALUMNO', 'ID_GRUPO');
    }
}
