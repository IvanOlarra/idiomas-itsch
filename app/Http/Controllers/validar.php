<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Plan;
use App\Models\Planestudio;
use App\Models\Secretaria;

class validar
{
    //ALUMNO

    public function emailal(Request $informacion)
    {

        //Ve Si en la Tablas ADMIN SECRE ALUMNO DOCENTE Hay un Correo rwpetio paraque no se junte o duplique
        //$existeemailAdm = Alumno::where('ALUMNO_CORREO', $informacion->ALUMNO_CORREO)->count();

        $existeemailSec = Secretaria::where('SECRETARIA_CORREO', $informacion->ALUMNO_CORREO)->count();
        $existeemailAl = Alumno::where('ALUMNO_CORREO', $informacion->ALUMNO_CORREO)->count();
        $existeemailDoc = Docente::where('DOCENTE_CORREO', $informacion->ALUMNO_CORREO)->count();

        if ( $existeemailSec > 0 | $existeemailAl > 0 | $existeemailDoc > 0) {

            return 1;
        } else {
            return 0;
        }
    }

    public function idal(Request $informacion)
    {
        //$existeIdAdm = Administrador::where('ID_ADMIN', $informacion->ID_ALUMNO)->count();
        $existeIdSec = Secretaria::where('ID_SECRETARIAL', $informacion->ID_ALUMNO)->count();
        $existeIdAl = Alumno::where('ID_ALUMNO', $informacion->ID_ALUMNO)->count();
        $existeIdDoc = Docente::where('ID_DOCENTE', $informacion->ID_ALUMNO)->count();

        if ( $existeIdAl > 0 | $existeIdDoc > 0 || $existeIdSec > 0) {

            return 1;
        } else {
            return 0;
        }
    }

    // ADMIN

    public function emailadmi(Request $informacion)
    {
        //Ve Si en la Tablas ADMIN SECRE ALUMNO DOCENTE Hay un Correo rwpetio paraque no se junte o duplique
        $existeemailAdm = Administrador::where('ADMIN_CORREO', $informacion->ADMIN_CORREO)->count();
        $existeemailSec = Secretaria::where('SECRETARIA_CORREO', $informacion->ADMIN_CORREO)->count();
        $existeemailAl = Alumno::where('ALUMNO_CORREO', $informacion->ADMIN_CORREO)->count();
        $existeemailDoc = Docente::where('DOCENTE_CORREO', $informacion->ADMIN_CORREO)->count();


        if ($existeemailAdm > 0 || $existeemailSec > 0 || $existeemailAl > 0 || $existeemailDoc > 0) {

            return 1;
        } else {
            return 0;
        }
    }

    public function idadmi(Request $informacion)
    {
        //Ve si en las tablas ADMIN SECRE ALUMNO DOCENTE Hay Una ID Repetida para que no se junten o Dupliquen
        $existeIdAdm = Administrador::where('ID_ADMIN', $informacion->ID_ADMIN)->count();
        $existeIdSec = Secretaria::where('ID_SECRETARIAL', $informacion->ID_ADMIN)->count();
        $existeIdAl = Alumno::where('ID_ALUMNO', $informacion->ID_ADMIN)->count();
        $existeIdDoc = Docente::where('ID_DOCENTE', $informacion->ID_ADMIN)->count();


        if ($existeIdAdm > 0 || $existeIdAl > 0 || $existeIdDoc > 0 || $existeIdSec > 0) {

            return 1;
        } else {
            return 0;
        }
    }
    // secretaria
    public function emailsecre(Request $informacion)
    {
        //Ve Si en la Tablas ADMIN SECRE ALUMNO DOCENTE Hay un Correo rwpetio paraque no se junte o duplique
        $existeemailAdm = Administrador::where('ADMIN_CORREO', $informacion->ADMIN_CORREO)->count();
        $existeemailSec = Secretaria::where('SECRETARIA_CORREO', $informacion->ADMIN_CORREO)->count();
        $existeemailAl = Alumno::where('ALUMNO_CORREO', $informacion->ADMIN_CORREO)->count();
        $existeemailDoc = Docente::where('DOCENTE_CORREO', $informacion->ADMIN_CORREO)->count();



        if ($existeemailAdm > 0 | $existeemailSec > 0 | $existeemailAl > 0 | $existeemailDoc > 0) {

            return 1;
        } else {
            return 0;
        }
    }

    public function idsecre(Request $informacion)
    {
        //Ve si en las tablas ADMIN SECRE ALUMNO DOCENTE Hay Una ID Repetida para que no se junten o Dupliquen
        $existeIdAdm = Administrador::where('ID_ADMIN', $informacion->ID_ADMIN)->count();
        $existeIdSec = Secretaria::where('ID_SECRETARIAL', $informacion->ID_ADMIN)->count();
        $existeIdAl = Alumno::where('ID_ALUMNO', $informacion->ID_ADMIN)->count();
        $existeIdDoc = Docente::where('ID_DOCENTE', $informacion->ID_ADMIN)->count();


        if ($existeIdAdm > 0 || $existeIdAl > 0 | $existeIdDoc > 0 || $existeIdSec > 0) {

            return 1;
        } else {
            return 0;
        }
    }

    // doocente
    public function emaildocente(Request $informacion)
    {
        //Ve Si en la Tablas ADMIN SECRE ALUMNO DOCENTE Hay un Correo rwpetio paraque no se junte o duplique
        $existeemailAdm = Administrador::where('ADMIN_CORREO', $informacion->DOCENTE_CORREO)->count();
        $existeemailSec = Secretaria::where('SECRETARIA_CORREO', $informacion->DOCENTE_CORREO)->count();
        $existeemailAl = Alumno::where('ALUMNO_CORREO', $informacion->DOCENTE_CORREO)->count();
        $existeemailDoc = Docente::where('DOCENTE_CORREO', $informacion->DOCENTE_CORREO)->count();


        if ($existeemailAdm > 0 | $existeemailSec > 0 | $existeemailAl > 0 | $existeemailDoc > 0) {

            return 1;
        } else {
            return 0;
        }
    }

    public function iddocente(Request $informacion)
    {
        //Ve si en las tablas ADMIN SECRE ALUMNO DOCENTE Hay Una ID Repetida para que no se junten o Dupliquen
        $existeIdAdm = Administrador::where('ID_ADMIN', $informacion->ID_DOCENTE)->count();
        $existeIdSec = Secretaria::where('ID_SECRETARIAL', $informacion->ID_DOCENTE)->count();
        $existeIdAl = Alumno::where('ID_ALUMNO', $informacion->ID_DOCENTE)->count();
        $existeIdDoc = Docente::where('ID_DOCENTE', $informacion->ID_DOCENTE)->count();


        if ($existeIdAdm > 0 || $existeIdAl > 0 | $existeIdDoc > 0 || $existeIdSec > 0) {

            return 1;
        } else {
            return 0;
        }
    }
    // ID plAN
    public function idplan(Request $informacion)
    {
        //Ve si en las tablas ADMIN SECRE ALUMNO DOCENTE Hay Una ID Repetida para que no se junten o Dupliquen
        $existeIdplna = Planestudio::where('ID_PLANESTUDIO', $informacion->ID_PLANESTUDIO)->count();



        if ($existeIdplna > 0) {

            return 1;
        } else {
            return 0;
        }
    }

    //ID Modulo
    public function idmodulo(Request $informacion)
    {
        //Ve si en las tablas ADMIN SECRE ALUMNO DOCENTE Hay Una ID Repetida para que no se junten o Dupliquen
        $existeIdplna = Modulo::where('ID_MODULO', $informacion->ID_P)->count();



        if ($existeIdplna > 0) {

            return 1;
        } else {
            return 0;
        }
    }
}
