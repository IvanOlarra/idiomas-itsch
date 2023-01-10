<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SecretariasTest extends TestCase
{
    use DatabaseTransactions;
    public function test_secretarias_page()
    {
        //Alguien externo no debería poder ver la página
        $this->get(route('secre.actualizado'))->assertForbidden();

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
        $this->actingAs($user)->get(route('secre.actualizado'))->assertSee("Lista de Secretariado");
    }

    public function test_alumno_cant_add_secretariado()
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

        //Verificar que un usuario Alumno no puede añadir secretariado
        $this->actingAs($user)->post(route('insert.agregar-secre'), [
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
            'ADMIN_CORREO' => $user->id,
            'ADMIN_ESPECIALIDAD' => 'o.O',
            'ADMIN_FECHA_ING' => '2022-07-22',
            'ADMIN_OBSERVACIONES' => 'Nada',
        ])->assertForbidden();
    }

    public function test_notlogged_cant_add_secretariado()
    {

        //Verificar que sin login no puede añadir a un secretariado
        $this->post(route('secre.actualizado'), [
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
            'ADMIN_CORREO' => '1',
            'ADMIN_ESPECIALIDAD' => 'o.O',
            'ADMIN_FECHA_ING' => '2022-07-22',
            'ADMIN_OBSERVACIONES' => 'Nada',
        ])->assertForbidden();
    }

    public function test_admin_can_add_secretariado()
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

        $secretariado = User::create([
            'name' => 'Docente Prueba',
            'email' => 'DocentePrueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $secretariado->assignRole('Alum');

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
        $this->assertTrue($secretariado->hasRole('Alum'));

        //Verificar que un usuario con rol administrador puede agregar a un secretariado
        $this->actingAs($admin)->post(route('insert.agregar-secre'), [
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
            'ADMIN_CORREO' => $secretariado->id,
            'ADMIN_ESPECIALIDAD' => 'o.O',
            'ADMIN_FECHA_ING' => '2022-07-22',
            'ADMIN_OBSERVACIONES' => 'Nada',
        ])->assertRedirect();


        //Actualizar el objeto secretariado
        $secretariado = User::where('email', 'DocentePrueba@gmail.com')->first();

        $this->assertTrue($secretariado->hasRole('Secre'));

        $this->actingAs($admin)->get(route('secre.actualizado'))->assertSee('Pruebas Prohibidio Prohibidencio');
    }

    public function test_notlogged_cant_get_secretariado()
    {
        //Verificar que un usuario Alumno no puede añadir a un Administrador
        $this->get(route('secre.actualizado'))->assertForbidden();
    }

    public function test_delete_secretariado_to_alumno()
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

        $secretariado = User::create([
            'name' => 'Docente Prueba',
            'email' => 'DocentePrueba@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        $secretariado->assignRole('Alum');

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
        $this->assertTrue($secretariado->hasRole('Alum'));

        //Verificar que un usuario con rol administrador puede agregar a un secretariado
        $this->actingAs($admin)->post(route('secre.actualizado'), [
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
            'ADMIN_CORREO' => $secretariado->id,
            'ADMIN_ESPECIALIDAD' => 'o.O',
            'ADMIN_FECHA_ING' => '2022-07-22',
            'ADMIN_OBSERVACIONES' => 'Nada',
        ])->assertRedirect();


        //Actualizar el objeto secretariado
        $secretariado = User::where('email', 'DocentePrueba@gmail.com')->first();

        $this->assertTrue($secretariado->hasRole('Secre'));

        $this->actingAs($admin)->get(route('delete.secre_eliminar', ['id_alu' => 'ABCDE54321']))->assertRedirect(route('secre.actualizado'));

        //Actualizar el objeto secretariado
        $secretariado = User::where('email', 'DocentePrueba@gmail.com')->first();

        //Verificar el rol de secretariado
        $this->assertFalse($secretariado->hasRole('Secre'));

        $this->actingAs($admin)->get(route('secre.actualizado'))->assertDontSee('Pruebas Prohibidio Prohibidencio');
    }
}
