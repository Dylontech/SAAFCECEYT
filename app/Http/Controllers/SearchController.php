<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Materia;
use App\Models\Especialidade;
use App\Models\Solicitude;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Búsqueda en la tabla Alumnos
        $alumnos = Alumno::where('Matricula', 'LIKE', "%$query%")
                         ->orWhere('CURP', 'LIKE', "%$query%")
                         ->orWhere('Carrera', 'LIKE', "%$query%")
                         ->orWhere('Grupo', 'LIKE', "%$query%")
                         ->orWhere('Nombre', 'LIKE', "%$query%")
                         ->orWhere('email', 'LIKE', "%$query%")
                         ->orWhere('estatus', 'LIKE', "%$query%")
                         ->get();

        // Búsqueda en la tabla Materias
        $materias = Materia::where('Profesor', 'LIKE', "%$query%")
                           ->orWhere('Nombre', 'LIKE', "%$query%")
                           ->orWhere('Tipo', 'LIKE', "%$query%")
                           ->get();

        // Búsqueda en la tabla Especialidades
        $especialidades = Especialidade::where('Nombre', 'LIKE', "%$query%")
                                       ->orWhere('Tipo', 'LIKE', "%$query%")
                                       ->get();

        // Búsqueda en la tabla Solicitudes
        $solicitudes = Solicitude::where('Nombre', 'LIKE', "%$query%")
                                 ->orWhere('Tipo', 'LIKE', "%$query%")
                                 ->get();

        $results = [
            'alumnos' => $alumnos,
            'materias' => $materias,
            'especialidades' => $especialidades,
            'solicitudes' => $solicitudes,
        ];

        return response()->json($results);
    }
}
