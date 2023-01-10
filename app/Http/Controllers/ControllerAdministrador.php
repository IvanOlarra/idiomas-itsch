<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaAdmin;
use App\Models\Administrador;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerAdministrador extends Controller
{

    public function mostadmin()
    {

        $selecadmin = DB::table('administradors')
            ->join('users',  'users.id', '=', 'administradors.ADMIN_CORREO')
            ->select('users.*', 'administradors.*')->get();

        return view('administrativo', compact('selecadmin'));
    }


    public function agregaadmin(ValidaAdmin $informacion)
    {

        $validar = new validar();

        //Condicion de mensaje para informar sin el Id ya esta registrada en otro usuario
        if ($validar->idadmi($informacion) > 0) {

            session()->flash('errorid', 'El ID ingresado ya Existe');
            return back();
        } else {

            //Condicion de mensaje para informar si el Correo ya esta registrado en otro usuario
            if ($validar->emailadmi($informacion) > 0) {
                session()->flash('erroremail', 'El Correo Electronico ingresado ya esta registrado a un usuario');
                return back();
            } else {
                //Sino Entra a la condicion de Agregar
                DB::insert(
                    'INSERT INTO `administradors` (
                    `ID_ADMIN`, `ADMIN_CLAVE`, `ADMIN_AP_PAT`, `ADMIN_AP_MAT`, `ADMIN_NOMBRE`, `ADMIN_SEXO`, `ADMIN_TIPO_SANGRE`, 
                    `ADMIN_FECHA_NAC`, `ADMIN_CALLE`, `ADMIN_COLONIA`, `ADMIN_MUNICIPIO`, `ADMIN_ESTADO`, `ADMIN_MOVIL`, `ADMIN_CASA`, 
                    `ADMIN_CORREO`, `ADMIN_CLAVE_PROFESIONAL`, `ADMIN_ESPECIALIDAD`, `ADMIN_FECHA_ING`, `ADMIN_OBSERVACIONES`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                    [
                        $informacion->ID_ADMIN,
                        $informacion->ADMIN_CLAVE,
                        $informacion->ADMIN_AP_PAT,
                        $informacion->ADMIN_AP_MAT,
                        $informacion->ADMIN_NOMBRE,
                        $informacion->ADMIN_SEXO,
                        $informacion->ADMIN_TIPO_SANGRE,
                        $informacion->ADMIN_FECHA_NAC,
                        $informacion->ADMIN_CALLE,
                        $informacion->ADMIN_COLONIA,
                        $informacion->ADMIN_MUNICIPIO,
                        $informacion->ADMIN_ESTADO,
                        $informacion->ADMIN_MOVIL,
                        $informacion->ADMIN_CASA,
                        $informacion->ADMIN_CORREO,
                        $informacion->ADMIN_CLAVE_PROFESIONAL,
                        $informacion->ADMIN_ESPECIALIDAD,
                        $informacion->ADMIN_FECHA_ING,
                        $informacion->ADMIN_OBSERVACIONES,
                    ]
                );

                $user = User::find($informacion->ADMIN_CORREO);
                $user->syncRoles(['Admin']);

                return back();
            }
        }
    }


    //dif
    public function edit($id)
    {
        //Nos manda el Id a modificar para poder seleccionar su informacion y mandar a nueva ventana
        $selecadmin = Administrador::where('ID_ADMIN', $id)->get();
        $correo = User::where('id', $selecadmin[0]->ADMIN_CORREO)->get('email')->first()->email;
        return view('update/administrador', compact('selecadmin', 'correo'));
    }

    public function modificaradmin(Request $informacion, $id)
    {
        //Validamos que los campos sean correctos
        $informacion->validate([
            'ADMIN_CLAVE' => 'required|max:30',
            'ADMIN_AP_PAT' => 'required|max:30',
            'ADMIN_AP_MAT' => 'max:30',
            'ADMIN_NOMBRE' => 'required|max:30',
            'ADMIN_SEXO' => 'required',
            'ADMIN_TIPO_SANGRE' => 'max:5',
            'ADMIN_FECHA_NAC' => 'required|date',
            'ADMIN_CALLE' => 'required|max:30',
            'ADMIN_COLONIA' => 'required|max:30',
            'ADMIN_MUNICIPIO' => 'required|max:30',
            'ADMIN_ESTADO' => 'required|max:30',
            'ADMIN_CLAVE_PROFESIONAL' => 'max:30',
            'ADMIN_ESPECIALIDAD' => 'max:30',
            'ADMIN_FECHA_ING' => 'required|date',
            'ADMIN_OBSERVACIONES' => 'max:500',
        ]);

        $selecalum = DB::table('administradors')->where('ID_ADMIN', $id)->update([
            'ID_ADMIN' => $informacion->ADMIN_ID,
            'ADMIN_CLAVE' => $informacion->ADMIN_CLAVE,
            'ADMIN_AP_PAT' => $informacion->ADMIN_AP_PAT,
            'ADMIN_AP_MAT' => $informacion->ADMIN_AP_MAT,
            'ADMIN_NOMBRE' => $informacion->ADMIN_NOMBRE,
            'ADMIN_SEXO' => $informacion->ADMIN_SEXO,
            'ADMIN_TIPO_SANGRE' => $informacion->ADMIN_TIPO_SANGRE,
            'ADMIN_FECHA_NAC' => $informacion->ADMIN_FECHA_NAC,
            'ADMIN_CALLE' => $informacion->ADMIN_CALLE,
            'ADMIN_COLONIA' => $informacion->ADMIN_COLONIA,
            'ADMIN_MUNICIPIO' => $informacion->ADMIN_MUNICIPIO,
            'ADMIN_ESTADO' => $informacion->ADMIN_ESTADO,
            'ADMIN_MOVIL' => $informacion->ADMIN_MOVIL,
            'ADMIN_CASA' => $informacion->ADMIN_CASA,
            'ADMIN_CLAVE_PROFESIONAL' => $informacion->ADMIN_CLAVE_PROFESIONAL,
            'ADMIN_ESPECIALIDAD' => $informacion->ADMIN_ESPECIALIDAD,
            'ADMIN_FECHA_ING' => $informacion->ADMIN_FECHA_ING,
            'ADMIN_OBSERVACIONES' => $informacion->ADMIN_OBSERVACIONES,
        ]);
        return redirect()->route('admin.actualizado');
    }

    public function eliminaradmin($id)
    { //Eliminamos la informacion de la id mandada

        $id_user = DB::table('administradors')->join('users', 'users.id', '=', 'administradors.ADMIN_CORREO')->where('ID_ADMIN', '=', $id)->first('users.id');
        $user = User::find($id_user->id);
        $user->syncRoles(['Alum']);

        DB::table('administradors')->where('ID_ADMIN', '=', $id)->delete();

        return redirect()->route('admin.actualizado');
    }
}
