<?php

namespace App\Http\Controllers;

use App\Models\Cierre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\each;

class ControllerPeriodo extends Controller
{

    public function mostrarperiodo()
    {

        $informacion = [];


        //Consulta a tabla cierres
        $cierres = Cierre::select()->get();
        //Decode del json de los parciales
        $cierre = json_decode($cierres[0]->parcial);
        $informacion['parcial1'] = $cierre->parcial1;
        $informacion['parcial2'] = $cierre->parcial2;
        $informacion['parcial3'] = $cierre->parcial3;
        $informacion['parcial4'] = $cierre->parcial4;

        return view('periodo', compact('informacion'));
    }

    public function modificarParciales(Request $informacion){

        $cierres = Cierre::select()->get();

        $cierre = json_decode($cierres[0]->parcial);

        if (isset($_POST['parcial1'])) {
            $cierre -> parcial1 =  1;
        }else{
            $cierre -> parcial1 =  0;
        }
        if (isset($_POST['parcial2'])) {
            $cierre -> parcial2 =  1;
        }else{
            $cierre -> parcial2 =  0;
        }
        if (isset($_POST['parcial3'])) {
            $cierre -> parcial3 =  1;
        }else{
            $cierre -> parcial3 =  0;
        }
        if (isset($_POST['parcial4'])) {
            $cierre -> parcial4 =  1;
        }else{
            $cierre -> parcial4 =  0;
        }

       //Actualizar cierre de parciales

         Cierre::where('id', 1)->update([
         'parcial' => json_encode($cierre)
        ]);

      

        return redirect()->route('periodo.actualizado');

    }
}
