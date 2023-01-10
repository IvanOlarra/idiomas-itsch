<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaGrupo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Cardex;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Swift;

class ControllerGrupo extends Controller
{

    public function mostgrupo()
    {
        //para llenar la tabla
        $selecgrup = DB::table('grupos')
            ->join('docentes',  'docentes.ID_DOCENTE', '=', 'grupos.ID_DOCENTE')
            ->join('modulos',  'grupos.ID_MODULO', '=', 'modulos.ID_MODULO')
            ->join('planestudios',  'modulos.ID_PLANESTUDIO', '=', 'planestudios.ID_PLANESTUDIO')
            ->select('docentes.*', 'grupos.*', 'modulos.*', 'planestudios.*')->get();
        //Pra llenar lo combo box
        $selecdocente = Docente::select(
            'ID_DOCENTE',
            'DOCENTE_NOMBRE',
            'DOCENTE_AP_MAT',
            'DOCENTE_AP_PAT',

        )->get();
        $selecplan = DB::table('planestudios')->get();
        $selecmod = Modulo::select('ID_MODULO')->get();



        return view('grupo', compact('selecgrup', 'selecplan', 'selecdocente', 'selecmod'));
    }

    public function agregagrupo(ValidaGrupo $informacion)
    {
        DB::insert(
            'INSERT INTO `grupos` 
        (`ID_MODULO`, `GRUPO_TIPO`, `GRUPO_CLA`, `GRUPO_NUM_GRUPO`, `GRUPO_DES`, `GRUPO_NUM_ALUMNOS`, `GRUPO_LIMITE`,
         `ID_DOCENTE`, `GRUPO_DIAS`, `GRUPO_HORAS`, `GRUPO_UBICACION`) 
         VALUES (?,?,?,?,?,?,?,?,?,?)',
            [
                $informacion->ID_MODULO,
                $informacion->GRUPO_TIPO,
                $informacion->GRUPO_CLA,
                $informacion->GRUPO_NUM_GRUPO,
                $informacion->GRUPO_DES,
                $informacion->GRUPO_NUM_ALUMNOS,
                $informacion->GRUPO_LIMITE,
                $informacion->ID_DOCENTE,
                $informacion->GRUPO_DIAS,
                $informacion->GRUPO_HORAS,
                $informacion->GRUPO_UBICACION,
            ]

        );




        return back();
    }



    public function edit($id)
    {

        $selecgrupo = DB::table('grupos')
            ->join('docentes',  'docentes.ID_DOCENTE', '=', 'grupos.ID_DOCENTE')
            ->join('modulos',  'modulos.ID_MODULO', '=', 'grupos.ID_MODULO')
            ->select(

                'docentes.*',


                'grupos.*',
                'modulos.*',



            )->where('ID_GRUPO', '=', $id)->get();

        //Pra llenar lo combo box
        $selecdocente = Docente::select(
            'ID_DOCENTE',
            'DOCENTE_NOMBRE',
            'DOCENTE_AP_MAT',
            'DOCENTE_AP_PAT',

        )->get();
        $selecplan = DB::table('planestudios')->get();
        $selecmod = Modulo::select('ID_MODULO')->get();



        return view('update/grupo', compact('selecgrupo', 'selecplan', 'selecdocente', 'selecmod'));
    }



    public function modificargrupo(Request $informacion, $id)

    {



        $selecalum = DB::table('grupos')->where('ID_GRUPO_NOMBRE', $id)->update([

            'ID_GRUPO_NOMBRE' => $id,
            'ID_PLANESTUDIO' => $informacion->ID_PLANESTUDIO,
            'ID_MODULO' => $informacion->ID_MODULO,
            'GRUPO_SEMESTRE' => $informacion->GRUPO_SEMESTRE,
            'GRUPO_TIPO' => $informacion->GRUPO_TIPO,
            'GRUPO_NUM_ALUMNOS' => $informacion->GRUPO_NUM_ALUMNOS,
            'ID_DOCENTE' => $informacion->ID_DOCENTE,
            'GRUPO_ID_UBICACION' => $informacion->GRUPO_ID_UBICACION,
            'GRUPO_DIA' => $informacion->GRUPO_DIA,
            'GRUPO_HORA_IN' => $informacion->GRUPO_HORA_IN,
            'GRUPO_HORA_FIN' => $informacion->GRUPO_HORA_FIN,
            'GRUPO_HORA_TOTAL' => $informacion->GRUPO_HORA_TOTAL,
            'GRU_LIM' => $informacion->GRU_LIM,
            'GRU_HLU' => $informacion->GRU_HLU,
            'GRU_ALU' => $informacion->GRU_ALU,
            'GRU_HMA' => $informacion->GRU_HMA,
            'GRU_AMA' => $informacion->GRU_AMA,
            'GRU_HMI' => $informacion->GRU_HMI,
            'GRU_AMI' => $informacion->GRU_AMI,
            'GRU_HJU' => $informacion->GRU_HJU,
            'GRU_AJU' => $informacion->GRU_AJU,
            'GRU_HVI' => $informacion->GRU_HVI,
            'GRU_AVI' => $informacion->GRU_AVI,
            'GRU_HSA' => $informacion->GRU_HSA,
            'GRU_ASA' => $informacion->GRU_ASA,
            'GRU_DES' => $informacion->GRU_DES,






        ]);






        return redirect()->route('grupo.actualizado');
    }



    public function eliminargrupo($id){

        DB::table('grupos')->where('ID_GRUPO', '=', $id)->delete();
        

        return redirect()->route('grupo.actualizado');
    }
    
    public function cierregrupo($id){
        //DB::table('grupos')->where('ID_GRUPO', '=', $id)->delete();
        $selecgrupo = DB::table('grupos')
        ->join('modulos',  'modulos.ID_MODULO', '=', 'grupos.ID_MODULO')
        ->select(
            'grupos.*',
            'modulos.*',
        )->where('ID_GRUPO', '=', $id)->get();

        //OBTENER NIVEL DEL MODULO
        foreach($selecgrupo as $grupo){ 
            $nivel=$grupo->MODULO_NIVEL;
        }


        //$nivel=$selecgrupo->MODULO_NIVEL;

        $calificaciones=DB::table('calificaciones')->where('ID_GRUPO', '=', $id)->get();
        foreach($calificaciones as $cal){ 

         //OBTENER EL PROMEDIO FINAL DEL MODULO

        $cal1=$cal->CALIF_PARCIAL1;
        $cal2=$cal->CALIF_PARCIAL2;
        $cal3=$cal->CALIF_PARCIAL3;
        $cal4=$cal->CALIF_PARCIAL4;
        $promedio=($cal1+$cal2+$cal3+$cal4)/4;
        if($promedio < 70){
        $promedio=0;
        }
        //GUARDAR PROMEDIO FINAL EN CARDEX
           switch($nivel){
            case 1:
                
                 DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                'CARDEX_CALIF_MOD1' => $promedio,
                ]);
        
                break;
                case 2:
                    DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                        'CARDEX_CALIF_MOD2' => $promedio,
                        ]);
                    break; 
                    case 3:
                        DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                            'CARDEX_CALIF_MOD3' => $promedio,
                            ]);
                        break;
                        case 4:
                            DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                'CARDEX_CALIF_MOD4' => $promedio,
                                ]);
                            break;
                            case 5:
                                DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                    'CARDEX_CALIF_MOD5' => $promedio,
                                    ]);
                                break;
                                case 6:
                                    DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                        'CARDEX_CALIF_MOD6' => $promedio,
                                        ]);
                                    break;
                                    case 7:
                                        DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                            'CARDEX_CALIF_MOD7' => $promedio,
                                            ]);
                                        break;
                                        case 8:
                                            DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                'CARDEX_CALIF_MOD8' => $promedio,
                                                ]);
                                            break; 
                                            case 9:
                                                DB::table('cardexes')->where('ID_ALUMNO', $cal->ID_ALUMNO)->update([
                                                    'CARDEX_CALIF_MOD9' => $promedio,
                                                    ]);
                                                break; 
                                                default;
                                                     break;
           }
        //Eimina la calificacion del modulo del alumno
        DB::table('calificaciones')->where('ID_GRUPO', '=', $id)->delete();
        }
        //Eimina  las inscripciones relacionadas con el grupo
        DB::table('inscripciones')->where('ID_GRUPO', '=', $id)->delete();
         //Eimina el grupo
        DB::table('grupos')->where('ID_GRUPO', '=', $id)->delete();
        return redirect()->route('grupo.actualizado');
    }
}
