<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GestionSController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $formularios = Formulario::paginate(10);

        foreach ($formularios as $formulario) {
            $this->revisarYActualizarEstatus($formulario);
        }

        return view('Control_user.GestionS', compact('formularios'));
    }

    public function updateStatus(Request $request, $id)
    {
        $formulario = Formulario::findOrFail($id);
        $formulario->status = $request->input('status');
        $formulario->comentario = $request->input('comentario');
        $formulario->comentario_financiero = $request->input('comentario_financiero'); // Añadido
        $formulario->save();

        return redirect()->route('gestions.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function show($id)
    {
        $formulario = Formulario::findOrFail($id);

        $ligaDePagoExiste = Storage::exists('public/' . $formulario->liga_de_pago);
        $comprobanteExiste = Storage::exists('public/' . $formulario->comprobante);
        $comprobanteAlumnoExiste = Storage::exists('public/' . $formulario->comprobante_alumno);
        $comprobanteOficialExiste = Storage::exists('public/' . $formulario->comprobante_oficial); // Añadido

        return view('Control_user.show', compact('formulario', 'ligaDePagoExiste', 'comprobanteExiste', 'comprobanteAlumnoExiste', 'comprobanteOficialExiste')); // Añadido
    }

    private function revisarYActualizarEstatus($formulario)
    {
        $tieneLigaDePago = !is_null($formulario->liga_de_pago);
        $tieneComprobante = !is_null($formulario->comprobante);

        if ($tieneLigaDePago && $tieneComprobante) {
            $formulario->status = 'subir comprobante';
            $formulario->save();
        }
    }

    public function uploadComprobante(Request $request, $id)
    {
        // Validación de tipos de archivo permitidos
        $validator = Validator::make($request->all(), [
            'comprobante' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240', // Tamaño actualizado
            'comentario_financiero' => 'nullable|string', // Añadido
            'comprobante_oficial' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:10240', // Añadido
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error al subir el comprobante.');
        }

        $formulario = Formulario::findOrFail($id);
        if ($request->hasFile('comprobante')) {
            $filePath = $request->file('comprobante')->store('public/comprobantes');
            $formulario->comprobante = $filePath;

            if ($request->hasFile('comprobante_oficial')) {
                $fileOficial = $request->file('comprobante_oficial');
                $pathOficial = $fileOficial->store('public/comprobantes');
                $formulario->comprobante_oficial = $pathOficial;
            }

            $formulario->comentario_financiero = $request->input('comentario_financiero'); // Añadido
            $formulario->save();
        }

        return redirect()->route('gestions.index')->with('success', 'Comprobante subido correctamente.');
    }

    public function downloadComprobanteAlumno($id)
    {
        return $this->downloadFile($id, 'comprobante_alumno');
    }

    public function downloadComprobanteOficial($id) // Añadido
    {
        return $this->downloadFile($id, 'comprobante_oficial');
    }

    private function downloadFile($id, $fileType)
    {
        $formulario = Formulario::findOrFail($id);

        // Obtener solo el nombre del archivo
        $fileName = basename($formulario->$fileType);

        // Construir la ruta completa del archivo
        $filePath = storage_path('app/public/' . $formulario->$fileType);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }

        if (!$this->archivoValido($filePath)) {
            return redirect()->back()->with('error', 'Tipo de archivo no permitido.');
        }

        return response()->download($filePath);
    }

    private function archivoValido($filePath)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $mimeType = mime_content_type($filePath);

        return in_array($mimeType, $allowedMimeTypes);
    }
}
