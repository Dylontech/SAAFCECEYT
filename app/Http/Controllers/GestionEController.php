<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioE;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GestionEController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los filtros de la solicitud
        $search = $request->input('search');
        $especialidad = $request->input('especialidad');
        $grupo = $request->input('grupo');
        $tipo_pago = $request->input('tipo_pago');
    
        // Construir la consulta con los filtros
        $query = FormularioE::query();
    
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('numero_control', 'LIKE', "%$search%")
                  ->orWhere('curp', 'LIKE', "%$search%");
            });
        }
    
        if ($especialidad) {
            $query->where('especialidad', $especialidad);
        }
    
        if ($grupo) {
            $query->where('grupo', $grupo);
        }
    
        if ($tipo_pago) {
            $query->where('tipo_pago', $tipo_pago);
        }
        // Ordenar por fecha de creación en orden descendente
        $query->orderBy('created_at', 'desc');
        $formularios = $query->paginate(10);
    
        // Obtener las listas para los filtros
        $especialidades = FormularioE::distinct()->pluck('especialidad');
        $grupos = FormularioE::distinct()->pluck('grupo');
        $tipo_pagos = FormularioE::distinct()->pluck('tipo_pago');
    
        return view('control_user.index', compact('formularios', 'especialidades', 'grupos', 'tipo_pagos'));
    }

    public function show($id)
    {
        $formulario = FormularioE::findOrFail($id);
        $ligaDePagoExiste = Storage::exists('public/' . $formulario->liga_de_pago);
        $comprobanteExiste = Storage::exists('public/' . $formulario->comprobante);
        $comprobanteAlumnoExiste = Storage::exists('public/' . $formulario->comprobante_alumno);
        $comprobanteOficialExiste = Storage::exists('public/' . $formulario->comprobante_oficial);

        return view('control_user.showE', compact('formulario', 'ligaDePagoExiste', 'comprobanteExiste', 'comprobanteAlumnoExiste', 'comprobanteOficialExiste'));
    }

    public function updateStatus(Request $request, $id)
    {
        $formulario = FormularioE::findOrFail($id);
        $formulario->status = $request->input('status');
        $formulario->comentario = $request->input('comentario');
        $formulario->comentario_financiero = $request->input('comentario_financiero');
        $formulario->save();

        // Redirigir a la vista de todas las solicitudes después de guardar los datos
        return redirect()->route('control_user.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function uploadComprobante(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comprobante' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error al subir el comprobante.');
        }

        $formulario = FormularioE::findOrFail($id);
        if ($request->hasFile('comprobante')) {
            $filePath = $request->file('comprobante')->store('public/comprobantes');
            $formulario->comprobante = $filePath;
            $formulario->save();
        }

        // Redirigir a la vista de todas las solicitudes después de subir el comprobante
        return redirect()->route('control_user.index')->with('success', 'Comprobante subido correctamente.');
    }

    public function downloadComprobante($id, $type)
    {
        $formulario = FormularioE::findOrFail($id);
        $filePath = $formulario->$type;

        if (!$filePath || !Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }

        return response()->download(storage_path('app/' . $filePath));
    }

    public function indexServicios(Request $request)
    {
        // Obtener los filtros de la solicitud
        $search = $request->input('buscar');
        $especialidad = $request->input('especialidad');
        $grupo = $request->input('grupo');
        $tipo_pago = $request->input('tipo_pago');
        
        // Construir la consulta con los filtros
        $query = FormularioE::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('numero_control', 'LIKE', "%$search%")
                  ->orWhere('curp', 'LIKE', "%$search%")
                  ->orWhere('especialidad', 'LIKE', "%$search%")
                  ->orWhere('grupo', 'LIKE', "%$search%")
                  ->orWhere('tipo_pago', 'LIKE', "%$search%")
                  ->orWhere('fecha_pago', 'LIKE', "%$search%")
                  ->orWhere('materias', 'LIKE', "%$search%")
                  ->orWhere('status', 'LIKE', "%$search%");
            });
        }

        if ($especialidad) {
            $query->where('especialidad', $especialidad);
        }

        if ($grupo) {
            $query->where('grupo', $grupo);
        }

        if ($tipo_pago) {
            $query->where('tipo_pago', $tipo_pago);
        }

        $formularios = $query->paginate(10);

        // Obtener las listas para los filtros
        $controles = FormularioE::distinct()->pluck('numero_control');
        $especialidades = FormularioE::distinct()->pluck('especialidad');
        $grupos = FormularioE::distinct()->pluck('grupo');
        $tipo_pagos = FormularioE::distinct()->pluck('tipo_pago');

        return view('financiero_user.SolicitudesServiciosS', compact('formularios', 'controles', 'especialidades', 'grupos', 'tipo_pagos'));
    }

    public function indexComprobantes($id)
    {
        $formulario = FormularioE::findOrFail($id);
    
        // Verificar si el archivo existe
        $ligaDePagoExiste = Storage::exists('public/' . $formulario->liga_de_pago);
        $comprobanteExiste = Storage::exists('public/' . $formulario->comprobante);
        $comprobanteAlumnoExiste = Storage::exists('public/' . $formulario->comprobante_alumno);
        $comprobanteOficialExiste = Storage::exists('public/' . $formulario->comprobante_oficial);
    
        return view('financiero_user.comprobantesE', compact('formulario', 'ligaDePagoExiste', 'comprobanteExiste', 'comprobanteAlumnoExiste', 'comprobanteOficialExiste'));
    }

    public function uploadLigaDePago(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'liga_de_pago' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error al subir la liga de pago.');
        }

        $formulario = FormularioE::findOrFail($id);
        if ($request->hasFile('liga_de_pago')) {
            $filePath = $request->file('liga_de_pago')->store('public/liga_de_pago');
            $formulario->liga_de_pago = $filePath;
            $formulario->save();
        }

        // Redirigir a la vista de todas las solicitudes después de subir la liga de pago
        return redirect()->route('solicitudes-servicios-s.index')->with('success', 'Liga de pago subida correctamente.');
    }

    public function downloadLigaDePago($id)
    {
        return $this->downloadFile($id, 'liga_de_pago', 'public/liga_de_pago');
    }

    public function uploadComprobanteAlumno(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'comprobante_alumno' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error al subir el comprobante del alumno.');
    }

    $formulario = FormularioE::findOrFail($id);
    if ($request->hasFile('comprobante_alumno')) {
        $file = $request->file('comprobante_alumno');
        $filePath = $file->store('public/comprobantes_alumno');
        $fileName = basename($filePath); // Obtener el nombre del archivo guardado

        $formulario->comprobante_alumno = $filePath;
        $formulario->save();

        // Retornar con mensaje de éxito y el nombre del archivo guardado
        return redirect()->back()->with('success', 'Comprobante del alumno subido correctamente. Nombre del archivo guardado: ' . $fileName);
    }

    return redirect()->back()->with('error', 'Error al subir el comprobante.');
}

public function downloadComprobanteAlumno($id)
{
    return $this->downloadFile($id, 'comprobante_alumno', 'public/comprobantes_alumno');
}


    private function downloadFile($id, $fileType, $directory)
    {
        $formulario = FormularioE::findOrFail($id);
        $filePath = $directory . '/' . basename($formulario->$fileType);

        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }

        return Storage::download($filePath);
    }
    public function uploadComprobanteOficial(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'comprobante_oficial' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error al subir el comprobante oficial.');
    }

    $formulario = FormularioE::findOrFail($id);
    if ($request->hasFile('comprobante_oficial')) {
        $filePath = $request->file('comprobante_oficial')->store('public/comprobantes_oficiales');
        $formulario->comprobante_oficial = $filePath;
        $formulario->save();
    }

    // Retornar con mensaje de éxito
    return redirect()->back()->with('success', 'Comprobante oficial subido correctamente.');
}
public function downloadComprobanteOficial($id)
{
    return $this->downloadFile($id, 'comprobante_oficial', 'public/comprobantes_oficiales');
}
public function uploadStudentReceipt(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'comprobante' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error al subir el comprobante.');
    }

    $formulario = FormularioE::findOrFail($id);
    if ($request->hasFile('comprobante')) {
        $filePath = $request->file('comprobante')->store('public/comprobantes');
        $formulario->comprobante = $filePath;
        $formulario->save();
    }

    // Retornar con mensaje de éxito
    return redirect()->back()->with('success', 'Comprobante subido correctamente.');
}
public function downloadStudentReceipt($id)
{
    $formulario = FormularioE::findOrFail($id);
    $filePath = 'public/comprobantes/' . basename($formulario->comprobante);

    if (!Storage::exists($filePath)) {
        return redirect()->back()->with('error', 'El archivo no existe.');
    }

    return Storage::download($filePath);
}
public function expedientesFinalizados()
{
    // Mostrar todas las solicitudes que tengan información en todos los campos especificados
    
    $formularios = FormularioE::whereNotNull('liga_de_pago')
        ->whereNotNull('comprobante_alumno')
        ->whereNotNull('comprobante')
        ->whereNotNull('comprobante_oficial')
        ->paginate(10);

    return view('control_user.ExpedientesEE', compact('formularios'));
}


}