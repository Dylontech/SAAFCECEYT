<?php

namespace App\Http\Controllers;

use App\Models\Carrusel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formulario;
use App\Models\FormularioE;


class AlumnosUserController extends Controller
{
    public function index(Request $request)
    {
        $carrusels = Carrusel::all();
        return view('alumnos_user.index', compact('carrusels'));
    }
    public function expedientesSS(Request $request)
    {
        $user = Auth::user();

        // Mostrar todas las solicitudes que tengan información en todos los campos especificados
        $solicitudes = Formulario::whereNotNull('liga_de_pago')
            ->whereNotNull('comprobante_alumno')
            ->whereNotNull('comprobante')
            ->whereNotNull('comprobante_oficial')
            ->paginate(10);
        // Lógica para manejar la solicitud de expedientes de servicios
        return view('alumnos_user.expedientesSS', compact('solicitudes'));
    }

    public function expedientesEE(Request $request)
    {
        $formularios = FormularioE::whereNotNull('liga_de_pago')
        ->whereNotNull('comprobante_alumno')
        ->whereNotNull('comprobante')
        ->whereNotNull('comprobante_oficial')
        ->paginate(10);
        // Lógica para manejar la solicitud de expedientes de exámenes
        return view('alumnos_user.expedientesEE', compact('formularios'));
    }
}
