<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        $remember = $request->input('remember'); // Obtener la opción de recordar

        // Verificar si los inputs están definidos
        if (isset($userIdentifier) && isset($password)) {
            $loginType = filter_var($userIdentifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'curp';

            if ($loginType == 'email') {
                // Autenticar usuarios con email y contraseña
                if (Auth::attempt(['email' => $userIdentifier, 'password' => $password], $remember)) {
                    if ($remember) {
                        // Guardar en cookies
                        Cookie::queue('user_identifier', $userIdentifier, 120);
                        Cookie::queue('password', $password, 120);
                        Cookie::queue('remember', $remember, 120);
                    } else {
                        // Eliminar cookies
                        Cookie::queue(Cookie::forget('user_identifier'));
                        Cookie::queue(Cookie::forget('password'));
                        Cookie::queue(Cookie::forget('remember'));
                    }
                    return $this->sendLoginResponse($request);
                }
            } else {
                // Autenticar alumnos con CURP y número de control
                $alumno = Alumno::where('CURP', $userIdentifier)
                                ->where('numero_control', $password)
                                ->first();

                if ($alumno) {
                    Auth::guard('alumno')->login($alumno, $remember);
                    if ($remember) {
                        // Guardar en cookies
                        Cookie::queue('user_identifier', $userIdentifier, 120);
                        Cookie::queue('password', $password, 120);
                        Cookie::queue('remember', $remember, 120);
                    } else {
                        // Eliminar cookies
                        Cookie::queue(Cookie::forget('user_identifier'));
                        Cookie::queue(Cookie::forget('password'));
                        Cookie::queue(Cookie::forget('remember'));
                    }
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
    public function showLoginForm()
    {
        $whatsappSettings = [
            'phone_number' => '1234567890', // Reemplaza con el número de teléfono real
            'message' => 'Hola, necesito ayuda con el inicio de sesión.' // Reemplaza con el mensaje real
        ];
        return view('vendor.tablar.auth.login', compact('whatsappSettings'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
