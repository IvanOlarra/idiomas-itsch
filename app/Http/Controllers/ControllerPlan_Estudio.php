<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaPlan;
use App\Models\Idioma;
use App\Models\Plan;
use App\Models\Planestudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerPlan_Estudio extends Controller
{

    public function mostplan()
    {

        $selecplan = Planestudio::select(

            '*'

        )->get();


        return view('plan-estudio', compact('selecplan'));
    }




    public function agregaplan(ValidaPlan $informacion)
    {

        $validar = new validar();
        if ($validar->idplan($informacion) > 0) {
            session()->flash('errorid', 'El ID ingresado ya Existe');
            return back();
        } else {

            DB::insert(

                ' INSERT INTO `planestudios` 
                (`ID_PLANESTUDIO`, `PLAN_CLAVE`, `PLAN_NOMBRE_IDIOMA`, `PLAN_IN`, `PLAN_FIN`, `PLAN_ESTADO`, `PLAN_CMOD`) 
                VALUES (?,?,?,?,?,?,?)',
                [

                    $informacion->ID_PLANESTUDIO,
                    $informacion->PLAN_CLAVE,
                    $informacion->PLAN_NOMBRE_IDIOMA,
                    $informacion->PLAN_IN,
                    $informacion->PLAN_FIN,
                    $informacion->PLAN_ESTADO,
                    $informacion->PLAN_CMOD
                ]
            );


            return back();
        }
    }


    public function edit($id)
    {



        $selecplan = DB::table('planestudios')
            ->where('ID_PLANESTUDIO', $id)->get();



        return view('update/plan-estudio', compact('selecplan'));
    }



    public function modificarplan(Request $informacion, $id)

    {

        //Validamos que los campos sean correctos
        $informacion->validate([


            'PLAN_CLAVE' => 'required|max:30',
            'PLAN_NOMBRE_IDIOMA' => 'required|max:20',
            'PLAN_IN' => 'required|date',
            'PLAN_FIN' => 'required|date',
            'PLAN_ESTADO' => 'required|max:10',
            'PLAN_CMOD' => 'required|min:1'


        ]);

        //si el id no se a cambiado
        if ($informacion->ID_PLANESTUDIO == $id) {
            $selecalum = DB::table('planestudios')->where('ID_PLANESTUDIO', $id)->update([




                'ID_PLANESTUDIO' => $id,
                'PLAN_CLAVE' => $informacion->PLAN_CLAVE,
                'PLAN_NOMBRE_IDIOMA' => $informacion->PLAN_NOMBRE_IDIOMA,
                'PLAN_IN' => $informacion->PLAN_IN,
                'PLAN_FIN' => $informacion->PLAN_FIN,
                'PLAN_ESTADO' => $informacion->PLAN_ESTADO,
                'PLAN_CMOD' => $informacion->PLAN_CMOD,


            ]);
            return redirect()->route('plan.actualizado');
        } else {
            //validamos que el id no este duplicada
            $validar = new validar();
            if ($validar->idplan($informacion) > 0) {
                session()->flash('errorid', 'El ID ingresado ya Existe');
                return back();
            } else {

                $selecalum = DB::table('planestudios')->where('ID_PLANESTUDIO', $id)->update([




                    'ID_PLANESTUDIO' => $informacion->ID_PLANESTUDIO,
                    'PLAN_CLAVE' => $informacion->PLAN_CLAVE,
                    'PLAN_NOMBRE_IDIOMA' => $informacion->PLAN_NOMBRE_IDIOMA,
                    'PLAN_IN' => $informacion->PLAN_IN,
                    'PLAN_FIN' => $informacion->PLAN_FIN,
                    'PLAN_ESTADO' => $informacion->PLAN_ESTADO,
                    'PLAN_CMOD' => $informacion->PLAN_CMOD,


                ]);






                return redirect()->route('plan.actualizado');
            }
        }
    }



    public function eliminarplan($id)
    {

        DB::table('plan_estudios')->where('ID_PLANESTUDIO', '=', $id)->delete();




        return redirect()->route('plan.actualizado');
    }
}
