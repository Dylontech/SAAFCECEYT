<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioE;
use App\Models\Materia; // Asegúrate de importar el modelo Materia
use Illuminate\Support\Facades\Auth;

class FormularioEController extends Controller
{
    // Mostrar la lista de solicitudes E del alumno autenticado
    public function solicitudesE(Request $request)
{
    // Obtener el ID del alumno autenticado
    $alumnoId = Auth::guard('alumno')->id();

    // Obtener las solicitudes del alumno autenticado
    $query = FormularioE::where('alumno_id', $alumnoId);

    if ($request->filled('materias')) {
        $query->where('materias', 'like', '%' . $request->materias . '%');
    }

    if ($request->filled('tipo_pago')) {
        $query->where('tipo_pago', $request->tipo_pago);
    }

    if ($request->filled('fecha_pago')) {
        $query->whereDate('fecha_pago', $request->fecha_pago);
    }

    $formularios = $query->paginate(10);

     // Obtener las listas para los filtros
     $materias = FormularioE::distinct()->pluck('materias')->map(function($materia) {
        $decoded = json_decode($materia, true);
        return array_filter(array_column($decoded, 'nombre'));
    })->flatten()->unique();

    return view('alumnos_user.solicitudesE', compact('formularios', 'materias'));
}

    // Crear una nueva solicitud
    public function create()
    {
        // Obtener todas las materias
        $materias = Materia::all();

        // Obtener los datos del alumno autenticado
        $alumno = Auth::guard('alumno')->user(); // Asegúrate de estar utilizando el guard correcto

        // Pasar las materias y los datos del alumno a la vista
        return view('alumnos_user.formulario', compact('materias', 'alumno'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'curp' => 'required|string|max:18',
            'numero_control' => 'required|string|max:10',
            'especialidad' => 'required|string|max:255',
            'numero_lista' => 'required|integer',
            'grupo' => 'required|string|max:10',
            'tipo_pago' => 'required|string|max:255',
            'fecha_pago' => 'required|date',
            'materias' => 'required|array',
            'materias.*.nombre' => 'nullable|string|max:255',
            'materias.*.tipo_examen' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'comentario' => 'nullable|string|max:255',
            'comentario_financiero' => 'nullable|string|max:255',
            'liga_de_pago' => 'nullable|string|max:255',
            'comprobante_alumno' => 'nullable|string|max:255',
            'comprobante' => 'nullable|string|max:255',
            'comprobante_oficial' => 'nullable|string|max:255',
        ]);

        $formulario = new FormularioE();
        $formulario->alumno_id = Auth::guard('alumno')->id(); // Asegúrate de guardar el ID del alumno autenticado
        $formulario->nombre = $validatedData['nombre'];
        $formulario->curp = $validatedData['curp'];
        $formulario->numero_control = $validatedData['numero_control'];
        $formulario->especialidad = $validatedData['especialidad'];
        $formulario->numero_lista = $validatedData['numero_lista'];
        $formulario->grupo = $validatedData['grupo'];
        $formulario->tipo_pago = $validatedData['tipo_pago'];
        $formulario->fecha_pago = $validatedData['fecha_pago'];
        $formulario->materias = json_encode($validatedData['materias']);
        $formulario->status = $validatedData['status'] ?? 'pendiente';
        $formulario->comentario = $validatedData['comentario'] ?? '';
        $formulario->comentario_financiero = $validatedData['comentario_financiero'] ?? '';
        $formulario->liga_de_pago = $validatedData['liga_de_pago'] ?? '';
        $formulario->comprobante_alumno = $validatedData['comprobante_alumno'] ?? '';
        $formulario->comprobante = $validatedData['comprobante'] ?? '';
        $formulario->comprobante_oficial = $validatedData['comprobante_oficial'] ?? '';

        $formulario->save();

        return redirect()->route('solicitudesE.index')->with('success', 'Solicitud creada exitosamente.');
    }

    // Actualizar una solicitud existente
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'curp' => 'required|string|max:18',
            'numero_control' => 'required|string|max:10',
            'especialidad' => 'required|string|max:255',
            'numero_lista' => 'required|integer',
            'grupo' => 'required|string|max:10',
            'tipo_pago' => 'required|string|max:255',
            'fecha_pago' => 'required|date',
            'materias' => 'required|array',
            'materias.*.nombre' => 'nullable|string|max:255',
            'materias.*.tipo_examen' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'comentario' => 'nullable|string|max:255',
            'comentario_financiero' => 'nullable|string|max:255',
            'liga_de_pago' => 'nullable|string|max:255',
            'comprobante_alumno' => 'nullable|string|max:255',
            'comprobante' => 'nullable|string|max:255',
            'comprobante_oficial' => 'nullable|string|max:255',
        ]);

        $formulario = FormularioE::findOrFail($id);
        $formulario->update([
            'nombre' => $validatedData['nombre'],
            'curp' => $validatedData['curp'],
            'numero_control' => $validatedData['numero_control'],
            'especialidad' => $validatedData['especialidad'],
            'numero_lista' => $validatedData['numero_lista'],
            'grupo' => $validatedData['grupo'],
            'tipo_pago' => $validatedData['tipo_pago'],
            'fecha_pago' => $validatedData['fecha_pago'],
            'materias' => json_encode($validatedData['materias']),
            'status' => $validatedData['status'] ?? 'pendiente',
            'comentario' => $validatedData['comentario'] ?? '',
            'comentario_financiero' => $validatedData['comentario_financiero'] ?? '',
            'liga_de_pago' => $validatedData['liga_de_pago'] ?? '',
            'comprobante_alumno' => $validatedData['comprobante_alumno'] ?? '',
            'comprobante' => $validatedData['comprobante'] ?? '',
            'comprobante_oficial' => $validatedData['comprobante_oficial'] ?? '',
        ]);

        return redirect()->route('solicitudesE.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    // Eliminar una solicitud
    public function destroy($id)
    {
        $formulario = FormularioE::findOrFail($id);
        $formulario->delete();

        return redirect()->route('solicitudesE.index')->with('success', 'Solicitud eliminada exitosamente.');
    }
}