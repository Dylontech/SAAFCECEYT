<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FormularioController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $especialidad = $request->input('especialidad');
        $grupo = $request->input('grupo');
        $control = $request->input('control');
        
        $query = Formulario::query();
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($search) {
                $q->where('Nombre', 'like', '%' . $search . '%')
                  ->orWhere('control', 'like', '%' . $search . '%')
                  ->orWhere('CURP', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('especialidad', 'like', '%' . $search . '%')
                  ->orWhere('grupo', 'like', '%' . $search . '%')
                  ->orWhere('semestre', 'like', '%' . $search . '%')
                  ->orWhere('fecha', 'like', '%' . $search . '%')
                  ->orWhere('tipo_servicio', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
            });    
        }
        if ($request->filled('tipo_servicio')) {
            $query->where('tipo_servicio', $request->tipo_servicio);
        }
        if ($request->filled('fecha_solicitud')) {
            $query->whereDate('fecha', $request->fecha_solicitud);
        }
    
        $formularios = $query->paginate(10);
    
        $tipos_servicio = Formulario::select('tipo_servicio')->distinct()->get();
        $fecha_solicitud = Formulario::select('fecha')->distinct()->get();
        $especialidades = Formulario::distinct()->pluck('especialidad');
        $grupos = Formulario::distinct()->pluck('grupo');
        $controles = Formulario::distinct()->pluck('control');
    
        return view('alumnos_user.SolicitudesS', compact('formularios', 'especialidades', 'grupos', 'controles'))
            ->with('i', (request()->input('page', 1) - 1) * $formularios->perPage());
    }

    public function expediente()
    {
        if (Auth::guard('alumno')->check()) {
            $formularios = Formulario::where('alumno_id', Auth::guard('alumno')->id())
                ->whereNotNull('comprobante')
                ->whereNotNull('liga_de_pago')
                ->whereNotNull('comprobante_alumno')
                ->paginate(10);

            return view('alumnos_user.ExpedienteSS', compact('formularios'));
        } else {
            return redirect()->route('login')->with('error', 'No tienes permisos para acceder a esta sección.');
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'control' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
            'semestre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'curp' => 'required|string|max:18',
            'tipo_servicio' => 'nullable|string',
            'status' => 'nullable|string',
            'comentario' => 'nullable|string',
            'comentario_financiero' => 'nullable|string', // Añadido
            'liga_de_pago' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif|max:10240', // Tamaño actualizado
            'comprobante_alumno' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif|max:10240', // Tamaño actualizado
            'comprobante' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif|max:10240', // Tamaño actualizado
            'comprobante_oficial' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif|max:10240', // Tamaño actualizado
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
        if ($request->hasFile('comprobante_oficial')) {
            $data['comprobante_oficial'] = $request->file('comprobante_oficial')->store('comprobantes');
        }

        try {
            Formulario::create($data);
            return redirect()->route('formularios.index')->with('success', 'Solicitud enviada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('formularios.index')->with('error', 'Hubo un problema al enviar la solicitud');
        }
    }

    public function destroy($id)
    {
        try {
            $formulario = Formulario::findOrFail($id);
            $formulario->delete();
            return redirect()->route('formularios.index')->with('success', 'Solicitud eliminada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('formularios.index')->with('error', 'Hubo un problema al eliminar la solicitud');
        }
    }

    // Método para subir el comprobante del alumno
    public function subirComprobanteAlumno(Request $request, $id)
{
    // Validar la solicitud
    $request->validate([
        'comprobante_alumno' => 'required|file|mimes:pdf,jpg,png|max:10240', // Tamaño actualizado
    ]);

    // Subir el archivo
    if ($request->hasFile('comprobante_alumno')) {
        $file = $request->file('comprobante_alumno');
        $path = $file->store('comprobantes', 'public');
        $fileName = basename($path); // Obtener el nombre del archivo guardado

        // Obtener el formulario específico usando el identificador de solicitud
        $formulario = Formulario::where('alumno_id', Auth::guard('alumno')->id())->where('id', $id)->first();

        if ($formulario) {
            // Actualizar el campo comprobante_alumno del formulario específico
            $formulario->comprobante_alumno = $path;
            $formulario->save();

            // Obtener el nombre de la tabla
            $tableName = $formulario->getTable();

            return redirect()->back()->with('success', 'Comprobante subido exitosamente. Nombre del archivo guardado: ' . $fileName . '. Guardado en la tabla: ' . $tableName);
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

    // Método para descargar el comprobante del alumno
    public function downloadComprobanteAlumno($id)
    {
        // Obtener el formulario específico usando el identificador de solicitud
        $formulario = Formulario::where('alumno_id', Auth::guard('alumno')->id())->where('id', $id)->first();

        if ($formulario && Storage::exists($formulario->comprobante_alumno)) {
            return Storage::download($formulario->comprobante_alumno);
        } else {
            return redirect()->back()->with('error', 'No se encontró el comprobante del alumno o no tiene permisos para descargarlo.');
        }
    }

    // Método para subir el comprobante y comentario financiero
    public function uploadComprobante(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'comprobante' => 'required|file|mimes:pdf,jpg,png|max:10240', // Tamaño actualizado
            'comentario_financiero' => 'nullable|string', // Añadido
            'comprobante_oficial' => 'nullable|file|mimes:pdf,jpg,png|max:10240', // Tamaño actualizado
        ]);

        // Subir el archivo y guardar el comentario financiero
        if ($request->hasFile('comprobante')) {
            $file = $request->file('comprobante');
            $path = $file->store('comprobantes', 'public');

            // Obtener el formulario específico usando el identificador de solicitud
            $formulario = Formulario::findOrFail($id);

            // Actualizar el campo comprobante, comentario_financiero y comprobante_oficial del formulario específico
            $formulario->comprobante = $path;
            $formulario->comentario_financiero = $request->input('comentario_financiero');

            if ($request->hasFile('comprobante_oficial')) {
                $fileOficial = $request->file('comprobante_oficial');
                $pathOficial = $fileOficial->store('comprobantes', 'public');
                $formulario->comprobante_oficial = $pathOficial;
            }

            $formulario->save();

            return redirect()->back()->with('success', 'Comprobante y comentario financiero subidos exitosamente.');
        }

        return redirect()->back()->with('error', 'Error al subir el comprobante.');
    }

    // Otros métodos del controlador...
}
