<?php

namespace App\Http\Controllers;

use App\Models\FormularioE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FormularioEController extends Controller
{
    /**
     * Mostrar el formulario de creación.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('alumnos_user.formulario');
    }

    /**
     * Guardar una nueva solicitud en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_control' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'numero_lista' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
            'tipo_pago' => 'required|string|max:255',
            'fecha_pago' => 'required|date',
            'materias' => 'required|array',
            'materias.*.nombre' => 'nullable|string|max:255', // Permitir null
            'materias.*.tipo_examen' => 'required|string|max:255',
        ]);

        $materias = json_encode(array_filter($request->materias, function($materia) {
            return !is_null($materia['nombre']);
        }));

        $formularioE = new FormularioE([
            'alumno_id' => Auth::guard('alumno')->id(),
            'nombre' => $request->nombre,
            'numero_control' => $request->numero_control,
            'especialidad' => $request->especialidad,
            'numero_lista' => $request->numero_lista,
            'grupo' => $request->grupo,
            'tipo_pago' => $request->tipo_pago,
            'fecha_pago' => $request->fecha_pago,
            'materias' => $materias,
            'status' => 'pendiente'
        ]);

        $formularioE->save();

        Log::info('Solicitud guardada exitosamente');

        // Redirigir al índice de alumnos_user con un mensaje de éxito
        return redirect()->route('alumnos_user.index')->with('success', 'Solicitud guardada exitosamente.');
    }

    /**
     * Mostrar la lista de formularios.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener las solicitudes del alumno autenticado
        $formularios = FormularioE::where('alumno_id', Auth::guard('alumno')->id())->paginate(10);
        return view('alumnos_user.index', compact('formularios'));
    }

    /**
     * Mostrar la lista de solicitudes E.
     *
     * @return \Illuminate\View\View
     */
    public function solicitudesE()
    {
        // Obtener las solicitudes del alumno autenticado
        $formularios = FormularioE::where('alumno_id', Auth::guard('alumno')->id())->paginate(10);
        return view('alumnos_user.solicitudesE', compact('formularios'));
    }

    /**
     * Eliminar una solicitud.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $formulario = FormularioE::findOrFail($id);
        $formulario->delete();

        return redirect()->route('solicitudesE.index')->with('success', 'Solicitud eliminada exitosamente.');
    }
}
