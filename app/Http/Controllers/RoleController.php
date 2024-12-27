<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Alumno; // Asegúrate de importar el modelo Alumno

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = User::paginate(10);
        $alumnos = Alumno::all(); // Obtener todos los alumnos

        // Asignar el rol "alumno" a todos los usuarios de la tabla alumnos por defecto
        $alumnoRole = Role::where('name', 'alumno')->first();
        foreach ($alumnos as $alumno) {
            $user = User::find($alumno->user_id); // Asumiendo que hay una relación user_id en la tabla alumnos
            if ($user && !$user->hasRole('alumno')) {
                $user->assignRole('alumno');
            }
        }

        // Buscar usuarios por nombre
        $search = $request->input('search');
        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')->paginate(10);
        }

        return view('roles.index', compact('roles', 'users', 'search'));
    }

    public function assignRoles(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $role = Role::find($request->role_id);
        $userIds = $request->input('user_ids');

        // Verificar que no se asignen más de 2 usuarios con el rol de "admin"
        if ($role->name == 'admin') {
            $currentCount = User::role('admin')->count();

            if (($currentCount + count($userIds)) > 2) {
                return redirect()->route('roles.index')->with('error', 'No se pueden asignar más de 2 usuarios con el rol de admin.');
            }
        }

        // Verificar que no se asignen más de 10 usuarios con el rol de "control escolar"
        if ($role->name == 'control_escolar') {
            $currentCount = User::role('control_escolar')->count();

            if (($currentCount + count($userIds)) > 10) {
                return redirect()->route('roles.index')->with('error', 'No se pueden asignar más de 10 usuarios con el rol de control escolar.');
            }
        }

        // Verificar que no se asignen más de 10 usuarios con el rol de "servicio financiero"
        if ($role->name == 'servicio_financiero') {
            $currentCount = User::role('servicio_financiero')->count();

            if (($currentCount + count($userIds)) > 10) {
                return redirect()->route('roles.index')->with('error', 'No se pueden asignar más de 10 usuarios con el rol de servicio financiero.');
            }
        }

        foreach ($userIds as $userId) {
            $user = User::find($userId);
            
            // Verificar si el rol ya ha sido asignado
            if (!$user->hasRole($role->name)) {
                $user->assignRole($role->name);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Roles asignados con éxito.');
    }
}

