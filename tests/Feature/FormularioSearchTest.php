<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Formulario;
use App\Models\Alumno;
use Spatie\Permission\Models\Role;

class FormularioSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_by_control_returns_record(): void
    {
        Role::create(['name' => 'alumno', 'guard_name' => 'alumno']);

        $this->withoutVite();

        $alumno = Alumno::create([
            'numero_control' => 'A001',
            'CURP' => 'TESTCURP123456789',
            'especialidad' => 'Informatica',
            'semestre' => '1',
            'Grupo' => 'A',
            'Nombre' => 'Test Alumno',
            'email' => 'alumno@example.com',
            'estatus' => 'activo',
        ]);

        $formulario = Formulario::create([
            'alumno_id' => $alumno->id,
            'nombre' => 'Test Alumno',
            'control' => 'C001',
            'especialidad' => 'Informatica',
            'grupo' => 'A',
            'semestre' => '1',
            'fecha' => now()->toDateString(),
            'curp' => 'TESTCURP123456789',
        ]);

        $this->actingAs($alumno, 'alumno');

        $response = $this->get('/formularios?search=' . $formulario->control);

        $response->assertStatus(200);
        $response->assertViewHas('formularios', function ($formularios) use ($formulario) {
            return $formularios->contains($formulario);
        });
    }
}
