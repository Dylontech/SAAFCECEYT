<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioE;

class FormularioEConsultaController extends Controller
{
    public function index()
    {
        $formularios = FormularioE::paginate(10); // Paginación añadida
        return view('Control_user.index', compact('formularios'));
    }
    
}
