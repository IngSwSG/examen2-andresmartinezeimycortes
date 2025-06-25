<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categoria;
use App\Models\Material;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Valida que el endpoint de inserción cree un material cuando no existe previamente.
     *
     * @return void
     */
    public function test_dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente(): void
    {
        $payload = [
            'categoria'      => 'Pruebas',
            'unidad_medida'  => 'caja',
            'descripcion'    => 'Lapiceros',
            'ubicacion'      => 'Estante Z',
        ];

        $response = $this->postJson('/api/materials', $payload);

        $response->assertCreated()
                 ->assertJsonFragment([
                     'unidad_medida' => 'caja',
                     'descripcion'   => 'Lapiceros',
                     'ubicacion'     => 'Estante Z',
                 ]);

        // Asegura que la categoría se creó o existe y el material está en BD
        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Pruebas',
        ]);

        $this->assertDatabaseHas('materials', [
            'descripcion' => 'Lapiceros',
            'unidad_medida' => 'caja',
        ]);
    }

    /**
     * Otro escenario de prueba: si falta el campo unidad_medida el endpoint debe devolver 422.
     */
    public function test_insertarMaterial_sinUnidadMedida_retornaError(): void
    {
        $payload = [
            'categoria'   => 'Pruebas',
            // 'unidad_medida' omitido deliberadamente
            'descripcion' => 'Objeto sin unidad',
        ];

        $response = $this->postJson('/api/materials', $payload);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['unidad_medida']);
    }
}
