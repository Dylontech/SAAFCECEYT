<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Alumno;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        // Verificar si no hay usuarios en la tabla de users
        if (User::count() === 0) {
            return redirect()->route('register')->with('warning', 'No hay usuarios en el sistema. Por favor, registra un nuevo usuario.');
        }

        $this->validateLogin($request);

        $userIdentifier = $request->input('user_identifier');
        $password = $request->input('password');

        // Verificar si los inputs están definidos
        if (isset($userIdentifier) && isset($password)) {
            $loginType = filter_var($userIdentifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'curp';

            if ($loginType == 'email') {
                // Autenticar usuarios con email y contraseña
                if (Auth::attempt(['email' => $userIdentifier, 'password' => $password])) {
                    return $this->sendLoginResponse($request);
                }
            } else {
                // Autenticar alumnos con CURP y matrícula
                $alumno = Alumno::where('CURP', $userIdentifier)
                                ->where('Matricula', $password)
                                ->first();

                if ($alumno) {
                    Auth::guard('alumno')->login($alumno);
                    return redirect()->route('alumnos_user.index');
                }
            }
        }

        // Si falla la autenticación
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'user_identifier' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}

