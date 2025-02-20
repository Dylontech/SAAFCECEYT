<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

/**
 * Clase AlumnoController
 * @package App\Http\Controllers
 */
class AlumnoController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = Alumno::query();

    if ($request->filled('search')) {
        $search = '%' . $request->search . '%';
        $query->where('Nombre', 'like', $search)
              ->orWhere('numero_control', 'like', $search)
              ->orWhere('CURP', 'like', $search)
              ->orWhere('email', 'like', $search)
              ->orWhere('especialidad', 'like', $search)
              ->orWhere('semestre', 'like', $search)
              ->orWhere('Grupo', 'like', $search)
              ->orWhere('estatus', 'like', $search);
    }

    if ($request->filled('grupo')) {
        $query->where('Grupo', $request->grupo);
    }

    if ($request->filled('especialidad')) {
        $query->where('especialidad', $request->especialidad);
    }
    

    $alumnos = $query->paginate(10);

    // Definir los grupos y especialidades
    $grupos = Alumno::select('Grupo')->distinct()->pluck('Grupo');
    $especialidades = Alumno::select('especialidad')->distinct()->pluck('especialidad');

    return view('alumno.index', compact('alumnos', 'grupos', 'especialidades'))
        ->with('i', (request()->input('page', 1) - 1) * $alumnos->perPage());
}

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumno = new Alumno();
        return view('alumno.create', compact('alumno'));
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_control' => 'required|string|max:255',
            'CURP' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'semestre' => 'required|integer',
            'Grupo' => 'required|string|max:255',
            'Nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'estatus' => 'required|string|max:255'
        ]);

        $alumno = new Alumno([
            'numero_control' => $request->numero_control,
            'CURP' => $request->CURP,
            'especialidad' => $request->especialidad,
            'semestre' => $request->semestre,
            'Grupo' => $request->Grupo,
            'Nombre' => $request->Nombre,
            'email' => $request->email,
            'estatus' => $request->estatus
        ]);

        $alumno->save();

        if ($request->ajax()) {
            return response()->json(['success' => 'Alumno creado exitosamente.']);
        }

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno creado exitosamente.');
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);

        return view('alumno.show', compact('alumno'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);

        return view('alumno.edit', compact('alumno'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Alumno $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'numero_control' => 'required|string|max:255',
            'CURP' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'semestre' => 'required|integer',
            'Grupo' => 'required|string|max:255',
            'Nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'estatus' => 'required|string|max:255'
        ]);

        $alumno->update($request->all());

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno actualizado exitosamente.');
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
        $alumno = Alumno::find($id)->delete();

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno eliminado exitosamente');
    }
    public function editMultiple(Request $request)
{
    $ids = explode(',', $request->input('ids'));
    return view('alumno.edit_multiple', compact('ids'));
}

public function updateMultiple(Request $request)
{
    $ids = explode(',', $request->input('ids'));
    $data = $request->only(['especialidad', 'semestre', 'Grupo', 'estatus']);

    // Verificar que los IDs no estén vacíos
    if (empty($ids)) {
        return redirect()->route('alumnos.index')->with('error', 'No se seleccionaron alumnos.');
    }

    // Verificar que al menos un campo esté presente para la actualización
    if (empty(array_filter($data))) {
        return redirect()->route('alumnos.index')->with('error', 'No se proporcionaron datos para actualizar.');
    }

    // Actualizar los registros
    Alumno::whereIn('id', $ids)->update(array_filter($data));

    return redirect()->route('alumnos.index')->with('success', 'Alumnos actualizados exitosamente.');
}

}

