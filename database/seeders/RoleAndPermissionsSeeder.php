<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::transaction(function () {
                $roleAdministrador = Role::firstOrCreate(['name' => 'Administrador']);
                $roleControl = Role::firstOrCreate(['name' => 'Control-escolar']);
                $roleFinanciero = Role::firstOrCreate(['name' => 'Recursos-Financieros']);
                $roleAlumno = Role::firstOrCreate(['name' => 'Alumno']);

                $permissions = [
                    'Registrar alumnos',
                    'Editar alumnos',
                    'Eliminar alumnos'
                ];

                foreach ($permissions as $permission) {
                    Permission::firstOrCreate(['name' => $permission]);
                }

                $roleAdministrador->givePermissionTo($permissions);
                $roleControl->givePermissionTo($permissions);
            });
        } catch (\Exception $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }
    }
}