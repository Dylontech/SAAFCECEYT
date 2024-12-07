<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

/**
 * Clase EspecialidadeController
 * @package App\Http\Controllers
 */
class EspecialidadeController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = Especialidade::paginate(10);

        return view('especialidade.index', compact('especialidades'))
            ->with('i', (request()->input('page', 1) - 1) * $especialidades->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidade = new Especialidade();
        return view('especialidade.create', compact('especialidade'));
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Especialidade::$rules);

        $especialidade = Especialidade::create($request->all());

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad creada exitosamente.');
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialidade = Especialidade::find($id);

        return view('especialidade.show', compact('especialidade'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especialidade = Especialidade::find($id);

        return view('especialidade.edit', compact('especialidade'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Especialidade $especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidade $especialidade)
    {
        request()->validate(Especialidade::$rules);

        $especialidade->update($request->all());

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad actualizada exitosamente');
    }

    /**
     * Elimina el recurso especificado.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $especialidade = Especialidade::find($id)->delete();

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad eliminada exitosamente');
    }
}

