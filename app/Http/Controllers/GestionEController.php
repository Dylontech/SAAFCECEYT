<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioE;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        return view('Control_user.GestionE', compact('formulario', 'ligaDePagoExiste', 'comprobanteExiste', 'comprobanteAlumnoExiste', 'comprobanteOficialExiste'));
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
    
}
