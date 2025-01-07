<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;

class FormularioController extends Controller
{
    public function index()
    {
        $formularios = Formulario::where('alumno_id', auth()->guard('alumno')->id())->paginate(10); // Paginación añadida
        return view('alumnos_user.SolicitudesS', compact('formularios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'control' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
            'generacion' => 'required|string|max:255',
            'semestre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'curp' => 'required|string|max:18',
            'tipo_servicio' => 'nullable|string',
            'status' => 'nullable|string',
            'comentario' => 'nullable|string', // Añadido
        ]);

        $data['alumno_id'] = auth()->guard('alumno')->id(); // Asociar la solicitud con el alumno autenticado

        try {
            Formulario::create($data);
            return redirect()->back()->with('success', 'Solicitud enviada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al enviar la solicitud');
        }
    }
}
