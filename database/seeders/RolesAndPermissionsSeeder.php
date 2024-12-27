<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear Permisos
        $permissions = [
            'crear alumnos',
            'editar alumnos',
            'eliminar alumnos',
            'ver alumnos',
            'crear solicitud',
            'gestionar solicitud',
            'generar liga de pago',
            'procesar pagos',
            'ver propias solicitudes',
            'ver pagos',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'ver usuarios'
        ];

        foreach ($permissions as $permission) {
            // Verificar si el permiso ya existe antes de crearlo
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Crear Roles y Asignar Permisos
        if (!Role::where('name', 'admin')->exists()) {
            $adminRole = Role::create(['name' => 'admin']);
            $adminRole->givePermissionTo([
                'crear alumnos', 'editar alumnos', 'eliminar alumnos', 'ver alumnos',
                'crear usuarios', 'editar usuarios', 'eliminar usuarios', 'ver usuarios'
            ]);
        }

        if (!Role::where('name', 'control_escolar')->exists()) {
            $controlEscolarRole = Role::create(['name' => 'control_escolar']);
            $controlEscolarRole->givePermissionTo([
                'crear alumnos', 'editar alumnos', 'ver alumnos', 'gestionar solicitud'
            ]);
        }

        if (!Role::where('name', 'alumno')->exists()) {
            $alumnoRole = Role::create(['name' => 'alumno']);
            $alumnoRole->givePermissionTo([
                'ver alumnos', 'crear solicitud', 'ver propias solicitudes'
            ]);
        }

        if (!Role::where('name', 'servicio_financiero')->exists()) {
            $servicioFinancieroRole = Role::create(['name' => 'servicio_financiero']);
            $servicioFinancieroRole->givePermissionTo([
                'ver pagos', 'procesar pagos', 'generar liga de pago'
            ]);
        }
    }
}

