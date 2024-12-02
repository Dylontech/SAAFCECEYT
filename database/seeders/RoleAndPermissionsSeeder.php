<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdministrador =Role::firstOrCreate(['name' => 'Administrador']);
        $roleControl =Role::firstOrCreate(['name' => 'Control-escolar']);
        $roleFinanciero =Role::firstOrCreate(['name' => 'Recursos-Financieros']);
        Role::firstOrCreate(['name' => 'Alumno']);

        Permission::firstOrCreate(['name' => 'Registrar alumnos']);
        Permission::firstOrCreate(['name' => 'Editar alumnos']);
        Permission::firstOrCreate(['name' => 'Eliminar alumnos']);
   
        $roleAdministrador->givePermissionTo('Registrar alumnos');
        $roleAdministrador->givePermissionTo('Editar alumnos');
        $roleAdministrador->givePermissionTo('Eliminar alumnos');
   $roleControl->givePermissionTo('Registrar alumnos');
   $roleControl->givePermissionTo('Editar alumnos');
   $roleControl->givePermissionTo('Eliminar alumnos');
   
    }


}