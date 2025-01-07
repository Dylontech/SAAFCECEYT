<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhatsappSettingsController extends Controller
{
    public function edit()
    {
        $settings = DB::table('whatsapp_settings')->first();
        if (!$settings) {
            $settings = (object) [
                'phone_number' => '',
                'message' => '',
            ];
        }
        return view('admin.whatsapp_settings', ['settings' => $settings]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|max:15',
            'message' => 'required',
        ]);

        try {
            DB::table('whatsapp_settings')
                ->updateOrInsert(
                    ['id' => 1], // Clave primaria o condición de búsqueda
                    [
                        'phone_number' => $request->input('phoneNumber'),
                        'message' => $request->input('message'),
                    ]
                );

            return redirect()->route('edit.whatsapp.settings')->with('success', 'Configuración actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->route('edit.whatsapp.settings')->with('error', 'Ocurrió un error al actualizar la configuración');
        }
    }
}

