<?php

namespace App\Http\Controllers;

use App\Models\Solicitude;
use Illuminate\Http\Request;

/**
 * Class SolicitudeController
 * @package App\Http\Controllers
 */
class SolicitudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitude::paginate(10);

        return view('solicitude.index', compact('solicitudes'))
            ->with('i', (request()->input('page', 1) - 1) * $solicitudes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitude = new Solicitude();
        return view('solicitude.create', compact('solicitude'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Solicitude::$rules);

        $solicitude = Solicitude::create($request->all());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitude = Solicitude::find($id);

        return view('solicitude.show', compact('solicitude'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitude = Solicitude::find($id);

        return view('solicitude.edit', compact('solicitude'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Solicitude $solicitude
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitude $solicitude)
    {
        request()->validate(Solicitude::$rules);

        $solicitude->update($request->all());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $solicitude = Solicitude::find($id)->delete();

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude deleted successfully');
    }
}
