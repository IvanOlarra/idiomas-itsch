<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidaSecre;
use App\Models\Administrador;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerSecretaria extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('can:Secretaria')->only('mostsecre');
    }
*/
    public function mostsecre()
    {
        //para llenar tabla

        $selecadmin = DB::table('secretarias')
            ->join('users',  'users.id', '=', 'secretarias.SECRETARIA_CORREO')
            ->select('users.*', 'secretarias.*')->get();




        return view('secretaria', compact('selecadmin'));
    }

    public function agregasecre(ValidaSecre $informacion)
    {

        $validar = new validar();

        if ($validar->idsecre($informacion)) {

            session()->flash('errorid', 'El ID ingresado ya Existe');
            return back();
        } else {



            if ($validar->emailsecre($informacion)) {

                session()->flash('erroremail', 'El Correo Electronico ingresado ya esta registrado a un usuario');
                return back();
            } else {

                DB::insert(

                    'INSERT INTO `secretarias` 
        (`ID_SECRETARIAL`, `SECRETARIA_CLAVE`, `SECRETARIA_AP_PAT`, `SECRETARIA_AP_MAT`, `SECRETARIA_NOMBRE`,
        `SECRETARIA_SEXO`, `SECRETARIA_TIPO_SANGRE`, `SECRETARIA_FECHA_NAC`, `SECRETARIA_CALLE`, `SECRETARIA_COLONIA`,
        `SECRETARIA_MUNICIPIO`, `SECRETARIA_ESTADO`, `SECRETARIA_MOVIL`, `SECRETARIA_CASA`, `SECRETARIA_CORREO`, `SECRETARIA_CLAVE_PROFESIONAL`,
            `SECRETARIA_ESPECIALIDAD`, `SECRETARIA_FECHA_ING`, `SECRETARIA_OBSERVACIONES`)
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
                $user->syncRoles(['Secre']);

                return back();
            }
        }
    }

    public function edit($id)
    {


        //Nos manda el Id a modificar para poder seleccionar su informacion y mandar a nueva ventana
        $selecadmin = Secretaria::where('ID_SECRETARIAL', $id)->get();
        $correo = User::where('id', $selecadmin[0]->SECRETARIA_CORREO)->get('email')->first()->email;


        return view('update/secretaria', compact('selecadmin', 'correo'));
    }



    public function modificarsecre(Request $informacion, $id)

    {

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
            'ADMIN_OBSERVACIONES' => 'required|max:500',
        ]);

        $selecalum = DB::table('secretarias')->where('ID_SECRETARIAL', $id)->update([
            'ID_SECRETARIAL' => $informacion->ID_SECRETARIAL,
            'SECRETARIA_CLAVE' => $informacion->ADMIN_CLAVE,
            'SECRETARIA_AP_PAT' => $informacion->ADMIN_AP_PAT,
            'SECRETARIA_AP_MAT' => $informacion->ADMIN_AP_MAT,
            'SECRETARIA_NOMBRE' => $informacion->ADMIN_NOMBRE,
            'SECRETARIA_SEXO' => $informacion->ADMIN_SEXO,
            'SECRETARIA_TIPO_SANGRE' => $informacion->ADMIN_TIPO_SANGRE,
            'SECRETARIA_FECHA_NAC' => $informacion->ADMIN_FECHA_NAC,
            'SECRETARIA_CALLE' => $informacion->ADMIN_CALLE,
            'SECRETARIA_COLONIA' => $informacion->ADMIN_COLONIA,
            'SECRETARIA_MUNICIPIO' => $informacion->ADMIN_MUNICIPIO,
            'SECRETARIA_ESTADO' => $informacion->ADMIN_ESTADO,
            'SECRETARIA_MOVIL' => $informacion->ADMIN_MOVIL,
            'SECRETARIA_CASA' => $informacion->ADMIN_CASA,
            'SECRETARIA_CLAVE_PROFESIONAL' => $informacion->ADMIN_CLAVE_PROFESIONAL,
            'SECRETARIA_ESPECIALIDAD' => $informacion->ADMIN_ESPECIALIDAD,
            'SECRETARIA_FECHA_ING' => $informacion->ADMIN_FECHA_ING,
            'SECRETARIA_OBSERVACIONES' => $informacion->ADMIN_OBSERVACIONES,
        ]);
        return redirect()->route('secre.actualizado');
    }













    public function eliminarsecre($id)
    {
        $id_user = DB::table('secretarias')->join('users', 'users.id', '=', 'secretarias.SECRETARIA_CORREO')->where('ID_SECRETARIAL', '=', $id)->first('users.id');
        $user = User::find($id_user->id);
        $user->syncRoles(['Alum']);

        //Eliminamos la informacion de la Id mandada
        DB::table('secretarias')->where('ID_SECRETARIAL', '=', $id)->delete();

        return redirect()->route('secre.actualizado');
    }
}
