<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roladmin = Role::create(['name' => 'Admin']);
        $roldocente = Role::create(['name' => 'Docente']);
        $rolsecre = Role::create(['name' => 'Secre']);
        $rolalum = Role::create(['name' => 'Alum']);
        
        
        //Tablas Root
        Permission::create(['name' => 'administrativo'])->assignRole($roladmin);
        Permission::create(['name' => 'consulta'])->syncRoles([$roladmin, $rolsecre]);
        Permission::create(['name' => 'secretaria'])->syncRoles([$roladmin]);
        Permission::create(['name' => 'docente'])->syncRoles([$roladmin, $rolsecre]);
        Permission::create(['name' => 'modulo'])->syncRoles([$roladmin, $rolsecre]);
        Permission::create(['name' => 'grupo'])->syncRoles([$roladmin, $rolsecre]);
        Permission::create(['name' => 'plan-estudio'])->syncRoles([$roladmin, $rolsecre]);
        Permission::create(['name' => 'inscripcion'])->syncRoles([$roladmin, $rolsecre]);


        Permission::create(['name' => 'calificacion'])->syncRoles([$roldocente, $rolalum]);
        Permission::create(['name' => 'adeudo'])->syncRoles([$rolsecre, $roladmin]);
        Permission::create(['name' => 'cardex2'])->syncRoles([$rolalum, $roldocente,$rolsecre]);
        Permission::create(['name' => 'servicios'])->syncRoles([$roladmin, $rolsecre]);
        Permission::create(['name' => 'lv1ylv2'])->syncRoles([$roladmin, $rolsecre]);
        Permission::create(['name' => 'lv3'])->syncRoles([$rolsecre, $rolalum]);
        Permission::create(['name' => 'lv4'])->syncRoles([$rolalum, $rolsecre, $roladmin]);
        Permission::create(['name' => 'calificaciondocentes'])->syncRoles([$roldocente, $roladmin]);
    }
}
