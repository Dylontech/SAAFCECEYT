<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioE;

class ControlUserController extends Controller
{
    public function index()
    {
        $formularios = FormularioE::paginate(10); // Utiliza el modelo FormularioE
        return view('Control_user.index', compact('formularios'));
    }
}
