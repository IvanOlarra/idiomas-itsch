<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DocentesTest extends TestCase
{

    use DatabaseTransactions;

    public function test_docentes_page()
    {

        $this->get("/docente")->assertForbidden();
        //Alguien externo no debería poder ver la página
        $this->get("/docente")->assertForbidden();

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

        //Verificar que se le dio el Rol de Admin al Administrador
        $this->assertTrue($user->hasRole('Admin'));

        //Un Administrador debe poder ver la página
        $this->actingAs($user)->get("/docente")->assertSee("Lista de Docentes");
        
    }

    public function test_alumno_cant_add_docente()
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

        //Verificar que un usuario Alumno no puede añadir a un DOCENTEistrador
        $this->actingAs($user)->post('/docente', [
            'ID_DOCENTE' => 'ABCDE54321',
            'DOCENTE_CLAVE' => 'Abcde54321',
            'DOCENTE_NOMBRE' => 'Pruebas',
            'DOCENTE_AP_PAT' => 'Prohibidio',
            'DOCENTE_AP_MAT' => 'Prohibidencio',
            'DOCENTE_SEXO' => 'Masculino',
            'DOCENTE_TIPO_SANGRE' => '0+',
            'DOCENTE_FECHA_NAC' => '1999-01-01',
            'DOCENTE_CALLE' => 'La calle',
            'DOCENTE_COLONIA' => 'La Colonia',
            'DOCENTE_ESTADO' => 'Michoacan',
            'DOCENTE_MUNICIPIO' => 'Hidalgo',
            'DOCENTE_MOVIL' => '1234567880',
            'DOCENTE_CASA' => '1234567690',
            'DOCENTE_CORREO' => $user->id,
            'DOCENTE_GRADO_ESCOLAR' => 'xD',
            'DOCENTE_ESPECIALIDAD' => 'o.O',
            'DOCENTE_FECHA_ING' => '2022-07-22',
            'DOCENTE_OBSERVACIONES' => 'Nada',
        ])->assertForbidden();
    }

    public function test_notlogged_cant_add_docente()
    {

        //Verificar que sin login no puede añadir a un docente
        $this->post('/administrativo', [
            'ID_DOCENTE' => 'ABCDE54321',
            'DOCENTE_CLAVE' => 'Abcde54321',
            'DOCENTE_NOMBRE' => 'Pruebas',
            'DOCENTE_AP_PAT' => 'Prohibidio',
            'DOCENTE_AP_MAT' => 'Prohibidencio',
            'DOCENTE_SEXO' => 'Masculino',
            'DOCENTE_TIPO_SANGRE' => '0+',
            'DOCENTE_FECHA_NAC' => '1999-01-01',
            'DOCENTE_CALLE' => 'La calle',
            'DOCENTE_COLONIA' => 'La Colonia',
            'DOCENTE_ESTADO' => 'Michoacan',
            'DOCENTE_MUNICIPIO' => 'Hidalgo',
            'DOCENTE_MOVIL' => '1234567880',
            'DOCENTE_CASA' => '1234567690',
            'DOCENTE_CORREO' => 1,
            'DOCENTE_GRADO_ESCOLAR' => 'xD',
            'DOCENTE_ESPECIALIDAD' => 'o.O',
            'DOCENTE_FECHA_ING' => '2022-07-22',
            'DOCENTE_OBSERVACIONES' => 'Nada',
        ])->assertForbidden();
    }

    public function test_admin_can_add_docente()
    {
        // Desactivar el ocultar los errores
        $this->withoutExceptionHandling();


        //Agregar un nuevo admin
        $admin = User::create([
            'name' => 'Prueba',
            'email' => 'Prueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $admin->assignRole('Admin');

        $docente = User::create([
            'name' => 'Docente Prueba',
            'email' => 'DocentePrueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $docente->assignRole('Alum');

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
        $this->assertTrue($docente->hasRole('Alum'));

        //Verificar que un usuario con rol administrador puede agregar a un docente
        $this->actingAs($admin)->post('/docente', [
            'ID_DOCENTE' => 'ABCDE5',
            'DOCENTE_CLAVE' => 'Abcde54321',
            'DOCENTE_NOMBRE' => 'Pruebas',
            'DOCENTE_AP_PAT' => 'Prohibidio',
            'DOCENTE_AP_MAT' => 'Prohibidencio',
            'DOCENTE_SEXO' => 'Masculino',
            'DOCENTE_TIPO_SANGRE' => '0+',
            'DOCENTE_FECHA_NAC' => '1999-01-01',
            'DOCENTE_CALLE' => 'La calle',
            'DOCENTE_COLONIA' => 'La Colonia',
            'DOCENTE_ESTADO' => 'Michoacan',
            'DOCENTE_MUNICIPIO' => 'Hidalgo',
            'DOCENTE_MOVIL' => '1234567880',
            'DOCENTE_CASA' => '1234567690',
            'DOCENTE_CORREO' => $docente->id,
            'DOCENTE_GRADO_ESCOLAR' => 'xD',
            'DOCENTE_ESPECIALIDAD' => 'o.O',
            'DOCENTE_FECHA_ING' => '2022-07-22',
            'DOCENTE_OBSERVACIONES' => 'Nada',
        ])->assertRedirect();


        //Actualizar el objeto docente
        $docente = User::where('email', 'DocentePrueba@gmail.com')->first();

        $this->assertTrue($docente->hasRole('Docente'));

        $this->actingAs($admin)->get('/docente')->assertSee('Pruebas Prohibidio Prohibidencio');
    }

    public function test_notlogged_cant_get_docentes()
    {
        //Verificar que un usuario Alumno no puede añadir a un Administrador
        $this->get('/docente')->assertForbidden();
    }

    public function test_delete_docente_to_alumno()
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

        $docente = User::create([
            'name' => 'Docente Prueba',
            'email' => 'DocentePrueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $docente->assignRole('Alum');

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
        $this->assertTrue($docente->hasRole('Alum'));

        //Verificar que un usuario con rol administrador puede agregar a un docente
        $this->actingAs($admin)->post('/docente', [
            'ID_DOCENTE' => 'ABCDE5',
            'DOCENTE_CLAVE' => 'Abcde54321',
            'DOCENTE_NOMBRE' => 'Pruebas',
            'DOCENTE_AP_PAT' => 'Prohibidio',
            'DOCENTE_AP_MAT' => 'Prohibidencio',
            'DOCENTE_SEXO' => 'Masculino',
            'DOCENTE_TIPO_SANGRE' => '0+',
            'DOCENTE_FECHA_NAC' => '1999-01-01',
            'DOCENTE_CALLE' => 'La calle',
            'DOCENTE_COLONIA' => 'La Colonia',
            'DOCENTE_ESTADO' => 'Michoacan',
            'DOCENTE_MUNICIPIO' => 'Hidalgo',
            'DOCENTE_MOVIL' => '1234567880',
            'DOCENTE_CASA' => '1234567690',
            'DOCENTE_CORREO' => $docente->id,
            'DOCENTE_GRADO_ESCOLAR' => 'xD',
            'DOCENTE_ESPECIALIDAD' => 'o.O',
            'DOCENTE_FECHA_ING' => '2022-07-22',
            'DOCENTE_OBSERVACIONES' => 'Nada',
        ])->assertRedirect();


        //Actualizar el objeto docente
        $docente = User::where('email', 'DocentePrueba@gmail.com')->first();

        $this->assertTrue($docente->hasRole('Docente'));

        $this->actingAs($admin)->get('/docente/ABCDE5')->assertRedirect(route('docente.actualizado'));

        //Actualizar el objeto docente
        $docente = User::where('email', 'DocentePrueba@gmail.com')->first();

        //Verificar el rol de docente
        $this->assertFalse($docente->hasRole('Docente'));

        $this->actingAs($admin)->get('/docente')->assertDontSee('Pruebas Prohibidio Prohibidencio');
    }
}
