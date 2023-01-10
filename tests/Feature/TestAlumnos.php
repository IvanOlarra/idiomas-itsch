<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestAlumnos extends TestCase
{
    use DatabaseTransactions;
    public function test_alumnos_page()
    {
        //Agregar un nuevo usuario
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'Prueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ])->assignRole('Admin');

        //Verificar si se ha creado el nuevo usuario
        $this->assertCredentials([
            'email' => 'Prueba@gmail.com',
            'password' => '1234567890',
        ]);


        $this->assertTrue($user->hasRole('Admin'));

        //Un DOCENTEistrador debe poder ver la página
        $this->actingAs($user)->get(route('secre.actualizado'))->assertSee("Lista de Alumnos");
    }

    public function test_alumno_cant_add_alumno()
    {
        //Desactivar el ocultar los errores
        //$this->withoutExceptionHandling();

        //Agregar un nuevo usuario
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'Prueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ])->assignRole('Alum');

        //Verificar si se ha creado el nuevo usuario
        $this->assertCredentials([
            'email' => 'Prueba@gmail.com',
            'password' => '1234567890',
        ]);

        //Verificar que un usuario Alumno no puede añadir ALUMNO
        $this->actingAs($user)->post(route('insert.agregar-alumno'), [
            'ID_ALUMNO' => 'ABCDE54321',
            'ALUMNO_NOMBRE' => 'Pruebas',
            'ALUMNO_APELLIDO_PAT' => 'Prohibidio',
            'ALUMNO_APELLIDO_MAT' => 'Prohibidencio',
            'ALUMNO_SEXO' => 'Masculino',
            'ALUMNO_TIPO_SANGRE' => '0+',
            'ALUMNO_FECHA_NAC' => '1999-01-01',
            'ALUMNO_CALLE' => 'La calle',
            'ALUMNO_COLONIA' => 'La Colonia',
            'ALUMNO_MUNICIPIO' => 'Hidalgo',
            'ALUMNO_ESTADO' => 'Michoacan',
            'ALUMNO_TELEFONO_PER' => '1234567880',
            'ALUMNO_TELEFONO_CASA' => '1234567690',
            'ALUMNO_CORREO' => $user->id,
            'ALUMNO_TUTOR_AR_PAT' => 'Prohibidio',
            'ALUMNO_TUTOR_AR_MAT' => 'Probibido',
            'ALUMNO_TUTOR_NOMBRE' => 'Prr',
            'ALUMNO_CARRERA' => 'Ing. en Sistemas',
            'ALUMNO_OBSERVACIONES' => 'Observaciones',
            'ALUMNO_STATUS' => 'Activo',
        ])->assertForbidden();
    }

    public function test_notlogged_cant_add_alumno()
    {

        //Verificar que sin login no puede añadir a un alumno
        $this->post(route('insert.agregar-alumno'), [
            'ID_ALUMNO' => 'ABCDE54321',
            'ALUMNO_NOMBRE' => 'Pruebas',
            'ALUMNO_APELLIDO_PAT' => 'Prohibidio',
            'ALUMNO_APELLIDO_MAT' => 'Prohibidencio',
            'ALUMNO_SEXO' => 'Masculino',
            'ALUMNO_TIPO_SANGRE' => '0+',
            'ALUMNO_FECHA_NAC' => '1999-01-01',
            'ALUMNO_CALLE' => 'La calle',
            'ALUMNO_COLONIA' => 'La Colonia',
            'ALUMNO_MUNICIPIO' => 'Hidalgo',
            'ALUMNO_ESTADO' => 'Michoacan',
            'ALUMNO_TELEFONO_PER' => '1234567880',
            'ALUMNO_TELEFONO_CASA' => '1234567690',
            'ALUMNO_CORREO' => '1',
            'ALUMNO_TUTOR_AR_PAT' => 'Prohibidio',
            'ALUMNO_TUTOR_AR_MAT' => 'Probibido',
            'ALUMNO_TUTOR_NOMBRE' => 'Prr',
            'ALUMNO_CARRERA' => 'Ing. en Sistemas',
            'ALUMNO_OBSERVACIONES' => 'Observaciones',
            'ALUMNO_STATUS' => 'Activo',
        ])->assertForbidden();
    }

    public function test_admin_can_add_alumno()
    {
        // Desactivar el ocultar los errores
        //$this->withoutExceptionHandling();


        //Agregar un nuevo admin
        $admin = User::create([
            'name' => 'Prueba',
            'email' => 'Prueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $admin->assignRole('Admin');

        $alumno = User::create([
            'name' => 'Docente Prueba',
            'email' => 'DocentePrueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $alumno->assignRole('Alum');

        //Verificar si se ha creado el nuevo usuario
        $this->assertCredentials([
            'email' => 'Prueba@gmail.com',
            'password' => '1234567890',
        ]);

        $this->assertCredentials([
            'email' => 'DocentePrueba@gmail.com',
            'password' => '1234567890',
        ]);

        //Verificar que se le dio el Rol de Admin al administrador
        $this->assertTrue($admin->hasRole('Admin'));
        $this->assertTrue($alumno->hasRole('Alum'));

        //Verificar que un usuario con rol administrador puede agregar a un alumno
        $this->actingAs($admin)->post(route('insert.agregar-alumno'), [
            'ID_ALUMNO' => 'ABCDE54321',
            'ALUMNO_NOMBRE' => 'Pruebas',
            'ALUMNO_APELLIDO_PAT' => 'Prohibidio',
            'ALUMNO_APELLIDO_MAT' => 'Prohibidencio',
            'ALUMNO_SEXO' => 'Masculino',
            'ALUMNO_TIPO_SANGRE' => '0+',
            'ALUMNO_FECHA_NAC' => '1999-01-01',
            'ALUMNO_CALLE' => 'La calle',
            'ALUMNO_COLONIA' => 'La Colonia',
            'ALUMNO_MUNICIPIO' => 'Hidalgo',
            'ALUMNO_ESTADO' => 'Michoacan',
            'ALUMNO_TELEFONO_PER' => '1234567880',
            'ALUMNO_TELEFONO_CASA' => '1234567690',
            'ALUMNO_CORREO' => $alumno->id,
            'ALUMNO_TUTOR_AR_PAT' => 'Prohibidio',
            'ALUMNO_TUTOR_AR_MAT' => 'Probibido',
            'ALUMNO_TUTOR_NOMBRE' => 'Prr',
            'ALUMNO_CARRERA' => 'Ing. en Sistemas',
            'ALUMNO_OBSERVACIONES' => 'Observaciones',
            'ALUMNO_STATUS' => 'Activo',
        ])->assertRedirect();


        //Actualizar el objeto alumno
        $alumno = User::where('email', 'DocentePrueba@gmail.com')->first();

        $this->assertTrue($alumno->hasRole('Alum'));

        $this->actingAs($admin)->get(route('alumno.actualizado'))->assertSee('Pruebas Prohibidio Prohibidencio');
    }

    public function test_notlogged_cant_get_alumno()
    {
        //Verificar que un usuario Alumno no puede añadir a un Administrador
        $this->get(route('alumno.actualizado'))->assertForbidden();
    }

    public function test_delete_alumno()
    {
        //Desactivar el ocultar los errores
        $this->withoutExceptionHandling();


        //Agregar un nuevo admin
        $admin = User::create([
            'name' => 'Prueba',
            'email' => 'Prueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $admin->assignRole('Admin');

        $alumno = User::create([
            'name' => 'Docente Prueba',
            'email' => 'DocentePrueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $alumno->assignRole('Alum');

        //Verificar si se ha creado el nuevo usuario
        $this->assertCredentials([
            'email' => 'Prueba@gmail.com',
            'password' => '1234567890',
        ]);

        $this->assertCredentials([
            'email' => 'DocentePrueba@gmail.com',
            'password' => '1234567890',
        ]);

        //Verificar que se le dio el Rol de Admin al administrador
        $this->assertTrue($admin->hasRole('Admin'));
        $this->assertTrue($alumno->hasRole('Alum'));

        //Verificar que un usuario con rol administrador puede agregar a un alumno
        $this->actingAs($admin)->post(route('insert.agregar-alumno'), [
            'ID_ADMIN' => 'ABCDE54321',
            'ADMIN_CLAVE' => 'Abcde54321',
            'ADMIN_NOMBRE' => 'Pruebas',
            'ADMIN_AP_PAT' => 'Prohibidio',
            'ADMIN_AP_MAT' => 'Prohibidencio',
            'ADMIN_SEXO' => 'Masculino',
            'ADMIN_TIPO_SANGRE' => '0+',
            'ADMIN_FECHA_NAC' => '1999-01-01',
            'ADMIN_CALLE' => 'La calle',
            'ADMIN_COLONIA' => 'La Colonia',
            'ADMIN_ESTADO' => 'Michoacan',
            'ADMIN_MUNICIPIO' => 'Hidalgo',
            'ADMIN_MOVIL' => '1234567880',
            'ADMIN_CASA' => '1234567690',
            'ADMIN_CORREO' => $alumno->id,
            'ADMIN_ESPECIALIDAD' => 'o.O',
            'ADMIN_FECHA_ING' => '2022-07-22',
            'ADMIN_OBSERVACIONES' => 'Nada',
        ])->assertRedirect();

        

        //Actualizar el objeto alumno
        $alumno = User::where('email', 'DocentePrueba@gmail.com')->first();

        $this->assertTrue($alumno->hasRole('Alum'));

        $this->actingAs($admin)->get(route('delete.alumno_eliminar', ['id_alu' => 'ABCDE54321']))->assertRedirect(route('secre.actualizado'));

        //Actualizar el objeto alumno
        $alumno = User::where('email', 'DocentePrueba@gmail.com')->first();

        //Verificar el rol de alumno
        $this->assertTrue($alumno->hasRole('Alum'));

        $this->actingAs($admin)->get(route('alumno.actualizado'))->assertDontSee('Pruebas Prohibidio Prohibidencio');
    }
}
