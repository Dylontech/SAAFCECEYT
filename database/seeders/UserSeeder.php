<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $controlEscRole = Role::firstOrCreate(['name' => 'ControlEsc']);
        $departamentoFinRole = Role::firstOrCreate(['name' => 'DepartamentoFin']);

        // Asignar roles a los usuarios existentes
        $admin = User::where('email', 'Adminsaafceceyte@gmail.com')->first();
        if ($admin) {
            $admin->assignRole($adminRole);
        }

        $controlEsc = User::where('email', 'ConEscsaafceceyte@gmail.com')->first();
        if ($controlEsc) {
            $controlEsc->assignRole($controlEscRole);
        }

        $departamentoFin = User::where('email', 'DepFinsaafceceyte@gmail.com')->first();
        if ($departamentoFin) {
            $departamentoFin->assignRole($departamentoFinRole);
        }

        // Si deseas agregar el usuario 'dyl' también
        $dyl = User::where('email', 'a@gmail.com')->first();
        if ($dyl) {
            // Asigna un rol si es necesario, por ejemplo:
            // $dyl->assignRole($someRole);
        }
    }
}