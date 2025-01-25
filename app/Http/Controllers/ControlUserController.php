<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioE;
use App\Models\Alumno;

class ControlUserController extends Controller

{

    public function index(Request $request)
    {
        $query = FormularioE::query();

        if ($request->filled('especialidad')) {
            $query->where('especialidad', $request->especialidad);
        }

        if ($request->filled('grupo')) {
            $query->where('grupo', $request->grupo);
        }

        if ($request->filled('tipo_pago')) {
            $query->where('tipo_pago', $request->tipo_pago);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%')
                  ->orWhere('numero_control', 'like', '%' . $request->search . '%');
            });
        }

        $formularios = $query->paginate(10);

        $grupos = FormularioE::select('grupo')->distinct()->pluck('grupo');
        $especialidades = FormularioE::select('especialidad')->distinct()->pluck('especialidad');
        $tipo_pagos = FormularioE::select('tipo_pago')->distinct()->pluck('tipo_pago');

        return view('Control_user.index', compact('formularios', 'grupos', 'especialidades', 'tipo_pagos'));
    }
}