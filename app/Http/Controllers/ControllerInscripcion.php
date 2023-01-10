<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaInscripcion;
use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Inscripcione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerInscripcion extends Controller
{

    public function mostinscripcion()
    {
        //para llenar tabla
        $selecinscripcion = DB::table('inscripciones')
        ->join('alumnos', 'alumnos.ID_ALUMNO', '=', 'inscripciones.ID_ALUMNO')
        ->select('inscripciones.*', 'alumnos.*')
        ->get();

        $selecalum = Alumno::select(
            'ALUMNO_NOMBRE',
            'ALUMNO_APELLIDO_MAT',
            'ALUMNO_APELLIDO_PAT',
            'ID_ALUMNO',

        )->get();
        $selecgrupo = Grupo::select('ID_GRUPO')->get();

        return view('inscripcion', compact('selecinscripcion', 'selecalum', 'selecgrupo'));
    }

    public function inscribir(Request $inscribiendo){
        $this->validate();

        $grupo = Grupo::find($this->inscribiendo['idGrupo']);

        //ASIGNA ID DEL DOCENTE Y EL MODULO
        $this->inscribiendo['docente']= $grupo["ID_DOCENTE"];
        $this->inscribiendo['modulo']= $grupo["ID_MODULO"];

        $modulo = $grupo->modulo()->first();
       

        $inscripcion = Inscripcione::create([
            'ID_INSCRIPCION' => $this->inscribiendo['folio']  ,
            'ID_GRUPO' => $this->inscribiendo['idGrupo'],
            'ID_ALUMNO' => $this->inscribiendo['id'],
            'ID_DOCENTE' => $this->inscribiendo['docente'],
            'ID_MODULO' => $this->inscribiendo['modulo'],
            'INSCRIPCION_NUM_FOLIO' => $this->inscribiendo['folio'],
            'INSCRIPCION_MONTO' => $this->inscribiendo['cantidad'],
            'INSCRIPCION_FECHA' => date('Y-m-d H:i:s'),
            'INSCRIPCION_ PERIODO' => 'ENE-JUL',
            'INSCRIPCION_ANIO' => 2020,
        ]);
        $inscripcion->save();

        //Incrementa un alumno al grupo
        $grupo["GRUPO_NUM_ALUMNOS"] = $grupo["GRUPO_NUM_ALUMNOS"]+1;
        $grupo->save();
        //Valida si existe un adeudo

        return redirect()->to('/inscripcion'); 
    }

    public function agregainscripcion(ValidaInscripcion $informacion)
    {

        DB::insert(

            'INSERT INTO `inscripciones`
             (`ID_INSCRIPCION`, `ISCRIPCION_ID_ALUMNO`, `INSCRIPCION_ID_GRUPO`, `INSCRIPCION_NUM_FOLIO`,
              `INSCRIPCION_MONTO`, `ISCRIPCION_FECHA`, `ISCRIPCION_ PERIODO`, `INSCRIPCION_ANIO`) 
              VALUES (?,?,?,?,?,?,?,?)',
            [
                $informacion->ID_INSCRIPCION,
                $informacion->INSCRIPCION_ID_ALUMNO,
                $informacion->INSCRIPCION_ID_GRUPO_NOMBRE,
                $informacion->INSCRIPCION_NUM_FOLIO,
                $informacion->INSCRIPCION_MONTO,
                $informacion->ISCRIPCION_FECHA,
                $informacion->INS_PER,
                $informacion->INS_AN

            ]
        );


        return back();
    }

    //dif
    public function edit($id)
    {

        $selecinscripcion = DB::table('inscripciones')
            ->join('alumnos', 'alumnos.ID_ALUMNO', '=', 'inscripciones.ID_ALUMNO')
            ->join('grupos', 'grupos.ID_GRUPO', '=', 'inscripciones.ID_GRUPO')
            ->select('inscripciones.*', 'alumnos.*', 'grupos.*')
            ->where('ID_INSCRIPCION', $id)
            ->get();


        $selecalum = Alumno::select(
            'ALUMNO_NOMBRE',
            'ALUMNO_APELLIDO_MAT',
            'ALUMNO_APELLIDO_PAT',
            'ID_ALUMNO',

        )->get();

        $selecgrupo = Grupo::select('ID_GRUPO')->get();
        return view('update/inscripcion', compact('selecinscripcion', 'selecalum', 'selecgrupo'));
    }



    public function modificarinscripcion(Request $informacion, $id)

    {



        $selecalum = DB::table('inscripciones')->where('ID_INSCRIPCION', $id)->update([


            'ID_INSCRIPCION' => $id,
            'INSCRIPCION_ID_ALUMNO' => $informacion->INSCRIPCION_ID_ALUMNO,
            'INSCRIPCION_ID_GRUPO_NOMBRE' => $informacion->INSCRIPCION_ID_GRUPO_NOMBRE,
            'INSCRIPCION_NUM_FOLIO' => $informacion->INSCRIPCION_NUM_FOLIO,
            'INSCRIPCION_MONTO' => $informacion->INSCRIPCION_MONTO,
            'ISCRIPCION_FECHA' => $informacion->ISCRIPCION_FECHA,
            'INS_PER' => $informacion->INS_PER,
            'INS_AN' => $informacion->INS_AN,


        ]);

        return redirect()->route('inscripcion.actualizado');
    }



    public function eliminarinscripcion($id)
    {

        DB::table('inscripciones')->where('ID_INSCRIPCION', '=', $id)->delete();




        return redirect()->route('inscripcion.actualizado');
    }
}
