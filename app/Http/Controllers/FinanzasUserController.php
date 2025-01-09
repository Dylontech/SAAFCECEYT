<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class FinanzasUserController extends Controller
{
    public function index()
    {
        $formularios = Formulario::where('status', 'generando_liga_pago')
                                  ->orWhereNotNull('comprobante_alumno')
                                  ->paginate(10);
        return view('financiero_user.SolicitudesServiciosF', compact('formularios'));
    }

    public function create()
    {
        return view('financiero_user.comprobantesS');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'formulario_id' => 'required|exists:formularios,id',
            'liga_de_pago' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif',
            'comprobante_alumno' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif',
            'status' => 'nullable|string',
        ]);

        $formulario = Formulario::find($data['formulario_id']);

        if ($request->hasFile('liga_de_pago')) {
            $filePath = $request->file('liga_de_pago')->store('comprobantes');
            $formulario->liga_de_pago = $filePath;
        }

        if ($request->hasFile('comprobante_alumno')) {
            $filePath = $request->file('comprobante_alumno')->store('comprobantes');
            $formulario->comprobante_alumno = $filePath;
        }

        if (!empty($data['status'])) {
            $formulario->status = $data['status'];
        }

        $formulario->save();

        return redirect()->route('finanzas.index')->with('success', 'Archivos subidos con éxito');
    }

    public function show($id)
    {
        $formulario = Formulario::findOrFail($id);
        return view('financiero_user.comprobantesS', compact('formulario'));
    }

    public function downloadLigaDePago($id)
    {
        $formulario = Formulario::findOrFail($id);
        $rutaArchivo = $formulario->liga_de_pago;

        if (Storage::exists($rutaArchivo)) {
            return Storage::download($rutaArchivo);
        }
        return redirect()->back()->with('error', 'No existe una liga de pago para esta solicitud o no tienes permisos para descargarla.');
    }

    public function downloadComprobanteAlumno($id)
    {
        try {
            $formulario = Formulario::findOrFail($id);
            $nombreArchivo = basename(trim($formulario->comprobante_alumno)); // Obtener solo el nombre del archivo

            Log::info("Intentando descargar el archivo para el formulario ID: $id, Nombre del archivo: $nombreArchivo");

            // Directorio base donde buscar
            $directorioBase = storage_path('app');
            $rutaArchivo = $this->buscarArchivoRecursivamente($directorioBase, $nombreArchivo);

            if ($rutaArchivo) {
                Log::info('El archivo existe en el almacenamiento. Ruta completa: ' . $rutaArchivo);
                return response()->download($rutaArchivo);
            } else {
                Log::warning('El archivo no existe en el almacenamiento.');
                return redirect()->back()->with('error', 'El archivo no existe en el almacenamiento.');
            }
        } catch (\Exception $e) {
            Log::error("Hubo un problema al intentar descargar el archivo: " . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al intentar descargar el archivo: ' . $e->getMessage());
        }
    }

    private function buscarArchivoRecursivamente($directorio, $nombreArchivo)
    {
        $archivos = File::allFiles($directorio);

        foreach ($archivos as $archivo) {
            if ($archivo->getFilename() == $nombreArchivo) {
                Log::info('Archivo encontrado en: ' . $archivo->getRealPath());
                return $archivo->getRealPath();
            }
        }

        $subdirectorios = File::directories($directorio);
        foreach ($subdirectorios as $subdirectorio) {
            $rutaArchivo = $this->buscarArchivoRecursivamente($subdirectorio, $nombreArchivo);
            if ($rutaArchivo) {
                return $rutaArchivo;
            }
        }

        return false;
    }
}
