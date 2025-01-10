<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormularioController extends Controller
{
    public function index()
    {
        $formularios = Formulario::where('alumno_id', Auth::guard('alumno')->id())->paginate(10);
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
            'comentario' => 'nullable|string',
            'liga_de_pago' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif',
            'comprobante_alumno' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif',
            'comprobante' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif',
        ]);

        $data['alumno_id'] = Auth::guard('alumno')->id();

        if ($request->hasFile('liga_de_pago')) {
            $data['liga_de_pago'] = $request->file('liga_de_pago')->store('pagos');
        }
        if ($request->hasFile('comprobante_alumno')) {
            $data['comprobante_alumno'] = $request->file('comprobante_alumno')->store('comprobantes');
        }
        if ($request->hasFile('comprobante')) {
            $data['comprobante'] = $request->file('comprobante')->store('comprobantes');
        }

        try {
            Formulario::create($data);
            return redirect()->route('formularios.index')->with('success', 'Solicitud enviada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('formularios.index')->with('error', 'Hubo un problema al enviar la solicitud: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $formulario = Formulario::findOrFail($id);
            $formulario->delete();
            return redirect()->route('formularios.index')->with('success', 'Solicitud eliminada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('formularios.index')->with('error', 'Hubo un problema al eliminar la solicitud: ' . $e->getMessage());
        }
    }

    // Método para subir el comprobante del alumno
    public function uploadComprobanteAlumno(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'comprobante_alumno' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Subir el archivo
        if ($request->hasFile('comprobante_alumno')) {
            $file = $request->file('comprobante_alumno');
            $path = $file->store('comprobantes', 'public');

            // Obtener el formulario específico usando el identificador de solicitud
            $formulario = Formulario::where('alumno_id', Auth::guard('alumno')->id())->where('id', $id)->first();

            if ($formulario) {
                // Actualizar el campo comprobante_alumno del formulario específico
                $formulario->comprobante_alumno = $path;
                $formulario->save();

                return redirect()->back()->with('success', 'Comprobante subido exitosamente.');
            } else {
                return redirect()->back()->with('error', 'No se encontró un formulario para este alumno con el identificador proporcionado.');
            }
        }

        return redirect()->back()->with('error', 'Error al subir el comprobante.');
    }

    // Método para descargar la liga de pago
    public function downloadLigaDePago($id)
    {
        // Obtener el formulario específico usando el identificador de solicitud
        $formulario = Formulario::where('alumno_id', Auth::guard('alumno')->id())->where('id', $id)->first();

        if ($formulario && Storage::exists($formulario->liga_de_pago)) {
            return Storage::download($formulario->liga_de_pago);
        } else {
            return redirect()->back()->with('error', 'No se encontró la liga de pago o no tiene permisos para descargarla.');
        }
    }

    // Método para descargar el comprobante
    public function downloadComprobante($id)
    {
        // Obtener el formulario específico usando el identificador de solicitud
        $formulario = Formulario::where('alumno_id', Auth::guard('alumno')->id())->where('id', $id)->first();

        if ($formulario && Storage::exists($formulario->comprobante)) {
            return Storage::download($formulario->comprobante);
        } else {
            return redirect()->back()->with('error', 'No se encontró el comprobante o no tiene permisos para descargarlo.');
        }
    }

    // Otros métodos del controlador...
}

