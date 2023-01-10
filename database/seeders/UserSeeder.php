<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'Administrador@gmail.com',
            'password' => bcrypt('1234567890'),
        ])->assignRole('Admin');

       /* DB::insert(
            'INSERT INTO `administradors` (
            `ID_ADMIN`, `ADMIN_CLAVE`, `ADMIN_AP_PAT`, `ADMIN_AP_MAT`, `ADMIN_NOMBRE`, `ADMIN_SEXO`, `ADMIN_TIPO_SANGRE`, 
            `ADMIN_FECHA_NAC`, `ADMIN_CALLE`, `ADMIN_COLONIA`, `ADMIN_MUNICIPIO`, `ADMIN_ESTADO`, `ADMIN_MOVIL`, `ADMIN_CASA`, 
            `ADMIN_CORREO`, `ADMIN_CLAVE_PROFESIONAL`, `ADMIN_ESPECIALIDAD`, `ADMIN_FECHA_ING`, `ADMIN_OBSERVACIONES`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                "Admin1",
                "Clave1",
                "Administrencio",
                "Administreo",
                "Admin",
                "Masculino",
                "O+",
                "1999-01-01",
                "La calle",
                "La Colonia",
                "Hidalgo",
                "Michoacan",
                "1234567880",
                "1234567690",
                $admin->id,
                "xD",
                "o.O",
                "2022-07-22",
                "Nada",
            ]
        );*/

        $secretaria = User::create([
            'name' => 'Secretaria',
            'email' => 'Secretaria@gmail.com',
            'password' => bcrypt('1234567890'),
        ])->assignRole('Secre');

        DB::insert(

            'INSERT INTO `secretarias` 
(`ID_SECRETARIAL`, `SECRETARIA_CLAVE`, `SECRETARIA_AP_PAT`, `SECRETARIA_AP_MAT`, `SECRETARIA_NOMBRE`,
`SECRETARIA_SEXO`, `SECRETARIA_TIPO_SANGRE`, `SECRETARIA_FECHA_NAC`, `SECRETARIA_CALLE`, `SECRETARIA_COLONIA`,
`SECRETARIA_MUNICIPIO`, `SECRETARIA_ESTADO`, `SECRETARIA_MOVIL`, `SECRETARIA_CASA`, `SECRETARIA_CORREO`, `SECRETARIA_CLAVE_PROFESIONAL`,
    `SECRETARIA_ESPECIALIDAD`, `SECRETARIA_FECHA_ING`, `SECRETARIA_OBSERVACIONES`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                1,
                "Clave2",
                "Secretario",
                "Secretencio",
                "Secretiado",
                "Masculino",
                "O+",
                "1999-01-01",
                "La calle",
                "La Colonia",
                "Hidalgo",
                "Michoacan",
                "1234567880",
                "1234567690",
                $secretaria->id,
                "xD",
                "o.O",
                "2022-07-22",
                "Nada",
            ]

        );

        $docente = User::create([
            'name' => 'Docente',
            'email' => 'Docente@gmail.com',
            'password' => bcrypt('1234567890'),
        ])->assignRole('Docente');


        DB::insert(
            'INSERT INTO `docentes` (
            `ID_DOCENTE`, `DOCENTE_CLAVE`, `DOCENTE_AP_PAT`, `DOCENTE_AP_MAT`, `DOCENTE_NOMBRE`, `DOCENTE_SEXO`, `DOCENTE_TIPO_SANGRE`,
             `DOCENTE_FECHA_NAC`, `DOCENTE_CALLE`, `DOCENTE_COLONIA`, `DOCENTE_MUNICIPIO`, `DOCENTE_ESTADO`, `DOCENTE_MOVIL`, `DOCENTE_CASA`, 
             `DOCENTE_CORREO`, `DOCENTE_GRADO_ESCOLAR`, `DOCENTE_ESPECIALIDAD`, `DOCENTE_FECHA_ING`, `DOCENTE_OBSERVACIONES`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                1,
                "Clave3",
                "Docente",
                "Docentencio",
                "Docentiado",
                "Masculino",
                "O+",
                "1999-01-01",
                "La calle",
                "La Colonia",
                "Hidalgo",
                "Michoacan",
                "1234567880",
                "1234567690",
                $docente->id,
                "xD",
                "o.O",
                "2022-07-22",
                "Nada",

            ]

        );



        $alumno = User::create([
            'name' => 'Alumno',
            'email' => 'Alumno@gmail.com',
            'password' => bcrypt('1234567890'),
        ])->assignRole('Alum');

        DB::insert(
            'INSERT INTO `alumnos` (
    `ID_ALUMNO`, `ALUMNO_APELLIDO_PAT`, `ALUMNO_APELLIDO_MAT`, `ALUMNO_NOMBRE`, `ALUMNO_SEXO`, `ALUMNO_TIPO_SANGRE`, 
    `ALUMNO_FECHA_NAC`, `ALUMNO_CALLE`, `ALUMNO_COLONIA`, `ALUMNO_MUNICIPIO`, `ALUMNO_ESTADO`, `ALUMNO_TELEFONO_PER`, 
    `ALUMNO_TELEFONO_CASA`, `ALUMNO_CORREO`, `ALUMNO_TUTOR_AR_PAT`, `ALUMNO_TUTOR_AR_MAT`, `ALUMNO_TUTOR_NOMBRE`, `ALUMNO_CARRERA`,
    `ALUMNO_OBSERVACIONES`, `ALUMNO_STATUS`,`ALUMNO_ING_ANIO` ) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                "1",
                "Alumencio",
                "Alumniado",
                "Alumno",
                "Masculino",
                "O+",
                "1999-01-01",
                "La calle",
                "La Colonia",
                "Hidalgo",
                "Michoacan",
                "1234567880",
                "1234567690",
                "Alumno@gmail.com",
                "Tutor",
                "Tutencio",
                "Tutorialo",
                "Ing. en Sistemas",
                "Nada",
                "Activo",
                "2020",

            ]
        );
    }
}
