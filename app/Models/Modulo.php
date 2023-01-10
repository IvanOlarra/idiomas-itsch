<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    //Deshabilitar marcas de tiempo
    public $timestamps = false;

    //Especificamos el nombre de campo para la llave primaria
    protected $primaryKey = 'ID_MODULO';

    //Desactivar autoincrement en PrimaryKey
    public $incrementing = false;

    //Atributos de Modulo asignables en masa
    protected $fillable = [
        'RETICULA_NOMBRE',
        'ID_PLANESTUDIO',
    ];

    //Atributos no asignables en masa
    protected $guarded = ['ID_MODULO',];

    //Relaciones
    public function planestudio()
    {
        return $this->belongsTo(Planestudio::class, 'ID_PLANESTUDIO');
    }

    public function grupo()
    {
        return $this->hasMany(Grupo::class, 'ID_MODULO');
    }
}
