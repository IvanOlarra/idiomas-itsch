<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaModulo;
use App\Models\Modulo;
use App\Models\Planestudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerModulo extends Controller
{
   public $id=0;
    public function agregamodulo(ValidaModulo $informacion)
    {

        $selecmodulo = Modulo::
        join('planestudios', 'modulos.ID_PLANESTUDIO', '=', 'planestudios.ID_PLANESTUDIO')->
        select(

            'modulos.ID_MODULO',
            'modulos.RETICULA_NOMBRE',
            'modulos.ID_PLANESTUDIO',
            'planestudios.PLAN_NOMBRE_IDIOMA'

        )->get();
        //llenar combo con los planes
       foreach($selecmodulo as $modulo){
        $this->id++;
       }
       echo($informacion->MODULO_NIVEL);
        DB::insert(

            'INSERT INTO `modulos` (`ID_MODULO`, `RETICULA_NOMBRE`, `ID_PLANESTUDIO`, `MODULO_NIVEL` )
             VALUES (?,?,?,?)',
            [
               
                $this->id,
                $informacion->RETICULA_NOMBRE,
                $informacion->ID_PLANESTUDIO,
                $informacion->MODULO_NIVEL,

            ]
        );


        return back();
    }

    public function mostmodulo()
    {
        //para llenar tabla
        $selecmodulo = Modulo::
        join('planestudios', 'modulos.ID_PLANESTUDIO', '=', 'planestudios.ID_PLANESTUDIO')->
        select(
            'modulos.MODULO_NIVEL',
            'modulos.ID_MODULO',
            'modulos.RETICULA_NOMBRE',
            'modulos.ID_PLANESTUDIO',
            'planestudios.PLAN_NOMBRE_IDIOMA'

        )->get();
        //llenar combo con los planes
       foreach($selecmodulo as $modulo){
        $this->id++;
       }
        $selecplan = Planestudio::select('ID_PLANESTUDIO','PLAN_NOMBRE_IDIOMA')->get();


        return view('modulo', compact('selecmodulo', 'selecplan'));
    }



    public function edit($id)
    {



        $selecmodulo = $selecmodulo = Modulo::
        join('planestudios', 'modulos.ID_PLANESTUDIO', '=', 'planestudios.ID_PLANESTUDIO')->
        select(

            'modulos.ID_MODULO',
            'modulos.RETICULA_NOMBRE',
            'modulos.ID_PLANESTUDIO',
            'planestudios.PLAN_NOMBRE_IDIOMA'

        )->
        where('ID_MODULO', $id)->get();
        $selecplan = Planestudio::select('ID_PLANESTUDIO','PLAN_NOMBRE_IDIOMA')->get();


        return view('update/modulo', compact('selecmodulo', 'selecplan'));
    }



    public function modificarmodulo(Request $informacion, $id)

    {



        $selecalum = DB::table('modulos')->where('ID_MODULO', $id)->update([

            'RETICULA_NOMBRE' => $informacion->RETICULA_NOMBRE,
            'ID_PLANESTUDIO' => $informacion->ID_PLANESTUDIO,



        ]);






        return redirect()->route('modulo.actualizado');
    }



    public function eliminarmodulo($id)
    {

        DB::table('modulos')->where('ID_MODULO', '=', $id)->delete();




        return redirect()->route('modulo.actualizado');
    }
}
