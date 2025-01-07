<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth

class GestionSController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $formularios = Formulario::paginate(10);

        return view('Control_user.GestionS', compact('formularios'));
    }

    public function updateStatus(Request $request, $id)
    {
        $formulario = Formulario::findOrFail($id);
        $formulario->status = $request->input('status');
        $formulario->comentario = $request->input('comentario'); // Aquí actualizamos el comentario
        $formulario->save();

        return redirect()->route('gestions.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function show($id)
    {
        $formulario = Formulario::findOrFail($id);
        return view('Control_user.show', compact('formulario'));
    }

    // Elimina el método updateComment ya que combinamos la funcionalidad
}
