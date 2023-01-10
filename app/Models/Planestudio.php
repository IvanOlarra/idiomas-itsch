<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planestudio extends Model
{
    use HasFactory;

    //Deshabilitar marcas de tiempo
    public $timestamps = false;

    //Especificamos el nombre de campo para la llave primaria
    protected $primaryKey = 'ID_PLANESTUDIO';

    //Desactivar autoincrement en PrimaryKey
    public $incrementing = false;

    //Atributos de Planestudio asignables en masa
    protected $fillable = [
        'PLAN_CLAVE',
        'PLAN_NOMBRE_IDIOMA',
        'PLAN_IN',
        'PLAN_FIN',
        'PLAN_ESTADO',
        'PLAN_CMOD',
    ];

    //Atributos no asignables en masa
    protected $guarded = ['ID_PLANESTUDIO',];

    

    //Relaciones
    public function modulo(){
        return $this->hasMany(Modulo::class, 'MODULO_ID_PLANESTUDIO');
    }
}
