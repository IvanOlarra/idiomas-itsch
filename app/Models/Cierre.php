<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cierre extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    //Especificamos el nombre de campo para la llave primaria
    protected $primaryKey = 'id';

    //Atributos de Grupo asignables en masa
    protected $fillable = [
        'parcial',
        'estado',
    ];
}
