<?php

namespace App\Http\Controllers;

use App\Http\Controllers\validar;
use App\Http\Requests\ValidaAlumno;
use App\Models\Administrador;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerAlumno extends Controller
{

    public function edit($id)
    {


        //Selecciona la infoormacion del alumno a editar para despues mandarla a nueva ventana
        $selecalumno = Alumno::where('ID_ALUMNO', $id)->get();


        $correo = User::where('email', $selecalumno[0]->ALUMNO_CORREO)->get('email')->first()->email;


        return view('update/alumno', compact('selecalumno', 'correo'));
    }

    public function mostalumno()
    {


        // Consultamos la informacion del alumno para llenar en la Tabla

        $selecalum = DB::table('alumnos')
            ->join('users',  'users.email', '=', 'alumnos.ALUMNO_CORREO')
            ->select('users.*', 'alumnos.*')->get();



        return view('consulta', compact('selecalum'));
    }

    public function agregaalumno(ValidaAlumno $informacion)
    {



        $validar = new validar();

        //Condicion de mensaje para informar sin el Id ya esta registrada en otro usuario
        if ($validar->idal($informacion) > 0) {

            session()->flash('errorid', 'El ID ingresado ya Existe');
            return back();
        } else {

            //Condicion de mensaje para informar si el Correo ya esta registrado en otro usuario
            if ($validar->emailal($informacion) > 0) {
                session()->flash('erroremail', 'El Correo Electronico ingresado ya esta registrado a un usuario');
                return back();
            } else {
                //Sino Entra a la condicion de Agregar
                DB::insert(
                    'INSERT INTO `alumnos` (
            `ID_ALUMNO`, `ALUMNO_APELLIDO_PAT`, `ALUMNO_APELLIDO_MAT`, `ALUMNO_NOMBRE`, `ALUMNO_SEXO`, `ALUMNO_TIPO_SANGRE`, 
            `ALUMNO_FECHA_NAC`, `ALUMNO_CALLE`, `ALUMNO_COLONIA`, `ALUMNO_MUNICIPIO`, `ALUMNO_ESTADO`, `ALUMNO_TELEFONO_PER`, 
            `ALUMNO_TELEFONO_CASA`, `ALUMNO_CORREO`, `ALUMNO_TUTOR_AR_PAT`, `ALUMNO_TUTOR_AR_MAT`, `ALUMNO_TUTOR_NOMBRE`, `ALUMNO_CARRERA`,
            `ALUMNO_OBSERVACIONES`, `ALUMNO_STATUS`,`ALUMNO_ING_ANIO` ) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                    [
                        $informacion->ID_ALUMNO,
                        $informacion->ALUMNO_APELLIDO_PAT,
                        $informacion->ALUMNO_APELLIDO_MAT,
                        $informacion->ALUMNO_NOMBRE,
                        $informacion->ALUMNO_SEXO,
                        $informacion->ALUMNO_TIPO_SANGRE,
                        $informacion->ALUMNO_FECHA_NAC,
                        $informacion->ALUMNO_CALLE,
                        $informacion->ALUMNO_COLONIA,
                        $informacion->ALUMNO_MUNICIPIO,
                        $informacion->ALUMNO_ESTADO,
                        $informacion->ALUMNO_TELEFONO_PER,
                        $informacion->ALUMNO_TELEFONO_CASA,
                        $informacion->ALUMNO_CORREO,
                        $informacion->ALUMNO_TUTOR_AR_PAT,
                        $informacion->ALUMNO_TUTOR_AR_MAT,
                        $informacion->ALUMNO_TUTOR_NOMBRE,
                        $informacion->ALUMNO_CARRERA,
                        $informacion->ALUMNO_OBSERVACIONES,
                        $informacion->ALUMNO_STATUS,
                        $informacion->ALUMNO_ING_ANIO
                    ]
                );
                $contraseña= bcrypt(strtolower(substr($informacion->ALUMNO_NOMBRE,0,1).$informacion->ALUMNO_APELLIDO_PAT));
                User::create([
                    'name' => $informacion->ALUMNO_NOMBRE." ".$informacion->ALUMNO_APELLIDO_PAT,
                    'email' => $informacion->ALUMNO_CORREO,
                    'password' => $contraseña,
                ])->assignRole('Alum');

                return  back();
            }
        }
    }



    public function modificaralumno(Request $informacion, $id)

    {


        //Validamos que los campos sean correctos
        $informacion->validate([




            'ALUMNO_APELLIDO_PAT' => 'required|max:30',
            'ALUMNO_APELLIDO_MAT' => 'max:30',
            'ALUMNO_NOMBRE' => 'required|max:30',
            'ALUMNO_SEXO' => 'required',
            'ALUMNO_TIPO_SANGRE' => 'max:5',
            'ALUMNO_FECHA_NAC' => 'required|date',
            'ALUMNO_CALLE' => 'required|max:30',
            'ALUMNO_COLONIA' => 'required|max:30',
            'ALUMNO_MUNICIPIO' => 'required|max:30',
            'ALUMNO_ESTADO' => 'required|max:30',
            'ALUMNO_CARRERA' => 'required|max:30',
            'ALUMNO_OBSERVACIONES' => 'max:500',
            'ALUMNO_STATUS' => 'required|max:20',
            'ALUMNO_ING_ANIO' => 'required|min:1',
        ]);

        if ($informacion->ID_ALUMNO == $id) {
            $selecalum = DB::table('alumnos')->where('ID_ALUMNO', $id)->update([
                'ID_ALUMNO' => $informacion->ID_ALUMNO,
                'ALUMNO_APELLIDO_PAT' => $informacion->ALUMNO_APELLIDO_PAT,
                'ALUMNO_APELLIDO_MAT' => $informacion->ALUMNO_APELLIDO_MAT,
                'ALUMNO_NOMBRE' => $informacion->ALUMNO_NOMBRE,
                'ALUMNO_SEXO' => $informacion->ALUMNO_SEXO,
                'ALUMNO_TIPO_SANGRE' => $informacion->ALUMNO_TIPO_SANGRE,
                'ALUMNO_FECHA_NAC' => $informacion->ALUMNO_FECHA_NAC,
                'ALUMNO_CALLE' => $informacion->ALUMNO_CALLE,
                'ALUMNO_COLONIA' => $informacion->ALUMNO_COLONIA,
                'ALUMNO_MUNICIPIO' => $informacion->ALUMNO_MUNICIPIO,
                'ALUMNO_ESTADO' => $informacion->ALUMNO_ESTADO,
                'ALUMNO_TELEFONO_PER' => $informacion->ALUMNO_TELEFONO_PER,
                'ALUMNO_TELEFONO_CASA' => $informacion->ALUMNO_TELEFONO_CASA,
                'ALUMNO_TUTOR_AR_PAT' => $informacion->ALUMNO_TUTOR_AR_PAT,
                'ALUMNO_TUTOR_AR_MAT' => $informacion->ALUMNO_TUTOR_AR_MAT,
                'ALUMNO_TUTOR_NOMBRE' => $informacion->ALUMNO_TUTOR_NOMBRE,
                'ALUMNO_CARRERA' => $informacion->ALUMNO_CARRERA,
                'ALUMNO_OBSERVACIONES' => $informacion->ALUMNO_OBSERVACIONES,
                'ALUMNO_STATUS' => $informacion->ALUMNO_STATUS,
                'ALUMNO_ING_ANIO' => $informacion->ALUMNO_ING_ANIO,
            ]);

            return redirect()->route('alumno.actualizado');
        } else {
            $validar = new validar();
            //validamos si el id esta en la base de datos
            if ($validar->idal($informacion) > 0) {
                session()->flash('errorid', 'El ID ingresado ya Existe');
                return back();
            } else {
                $selecalum = DB::table('alumnos')->where('ID_ALUMNO', $id)->update([
                    'ID_ALUMNO' =>  $informacion->ID_ALUMNO,
                    'ALUMNO_APELLIDO_PAT' => $informacion->ALUMNO_APELLIDO_PAT,
                    'ALUMNO_APELLIDO_MAT' => $informacion->ALUMNO_APELLIDO_MAT,
                    'ALUMNO_NOMBRE' => $informacion->ALUMNO_NOMBRE,
                    'ALUMNO_SEXO' => $informacion->ALUMNO_SEXO,
                    'ALUMNO_TIPO_SANGRE' => $informacion->ALUMNO_TIPO_SANGRE,
                    'ALUMNO_FECHA_NAC' => $informacion->ALUMNO_FECHA_NAC,
                    'ALUMNO_CALLE' => $informacion->ALUMNO_CALLE,
                    'ALUMNO_COLONIA' => $informacion->ALUMNO_COLONIA,
                    'ALUMNO_MUNICIPIO' => $informacion->ALUMNO_MUNICIPIO,
                    'ALUMNO_ESTADO' => $informacion->ALUMNO_ESTADO,
                    'ALUMNO_TELEFONO_PER' => $informacion->ALUMNO_TELEFONO_PER,
                    'ALUMNO_TELEFONO_CASA' => $informacion->ALUMNO_TELEFONO_CASA,
                    'ALUMNO_TUTOR_AR_PAT' => $informacion->ALUMNO_TUTOR_AR_PAT,
                    'ALUMNO_TUTOR_AR_MAT' => $informacion->ALUMNO_TUTOR_AR_MAT,
                    'ALUMNO_TUTOR_NOMBRE' => $informacion->ALUMNO_TUTOR_NOMBRE,
                    'ALUMNO_CARRERA' => $informacion->ALUMNO_CARRERA,
                    'ALUMNO_OBSERVACIONES' => $informacion->ALUMNO_OBSERVACIONES,
                    'ALUMNO_STATUS' => $informacion->ALUMNO_STATUS,
                    'ALUMNO_ING_ANIO' => $informacion->ALUMNO_ING_ANIO,




                ]);
                return redirect()->route('alumno.actualizado');
            }
        }
    }



    public function eliminaralumno($correo)
    {

        DB::table('alumnos')->where('ALUMNO_CORREO', '=', $correo)->delete();

        DB::table('users')->where('email', '=', $correo)->delete();




        return redirect()->route('alumno.actualizado');
    }
}
