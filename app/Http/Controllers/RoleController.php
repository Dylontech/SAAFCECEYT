<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = User::paginate(10);

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
