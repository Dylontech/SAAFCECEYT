<?php

namespace App\Http\Controllers;

use App\Models\Carrusel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class CarruselController
 * @package App\Http\Controllers
 */
class CarruselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carrusels = Carrusel::paginate(10);

        return view('carrusel.index', compact('carrusels'))
            ->with('i', (request()->input('page', 1) - 1) * $carrusels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carrusel = new Carrusel();
        return view('carrusel.create', compact('carrusel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Carrusel::$rules);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carrusel', 'public');
        }

        $carrusel = Carrusel::create($data);

        return redirect()->route('carrusels.index')
            ->with('success', 'Carrusel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrusel = Carrusel::find($id);

        return view('carrusel.show', compact('carrusel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrusel = Carrusel::find($id);

        return view('carrusel.edit', compact('carrusel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Carrusel $carrusel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrusel $carrusel)
    {
        request()->validate(Carrusel::$rules);

        $data = $request->all();
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($carrusel->image) {
                Storage::disk('public')->delete($carrusel->image);
            }
            $data['image'] = $request->file('image')->store('carrusel', 'public');
        }

        $carrusel->update($data);

        return redirect()->route('carrusels.index')
            ->with('success', 'Carrusel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $carrusel = Carrusel::find($id)->delete();

        return redirect()->route('carrusels.index')
            ->with('success', 'Carrusel deleted successfully');
    }
    public function getImage($id)
    {
        $carrusel = Carrusel::findOrFail($id);
        return response()->file(storage_path('app/public/' . $carrusel->image));
    }
}