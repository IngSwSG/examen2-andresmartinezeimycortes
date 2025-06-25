<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MaterialController extends Controller
{
    /**
     * Store a new material along with its (possibly new) category.
     *
     * Expected JSON body:
     * {
     *   "categoria": "Oficina",
     *   "unidad_medida": "caja",
     *   "descripcion": "Resmas de papel",
     *   "ubicacion": "Estante A"
     * }
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'categoria'      => 'required|string|max:255',
            'unidad_medida'  => 'required|string|max:100',
            'descripcion'    => 'nullable|string',
            'ubicacion'      => 'nullable|string|max:255',
        ]);

        // Create or fetch the category
        $categoria = Categoria::firstOrCreate(['nombre' => $validated['categoria']]);

        // Create the material
        $material = Material::create([
            'unidad_medida' => $validated['unidad_medida'],
            'descripcion'   => $validated['descripcion'] ?? null,
            'ubicacion'     => $validated['ubicacion'] ?? null,
            'categoria_id'  => $categoria->id,
        ]);

        return response()->json($material->load('categoria'), 201);
    }

    /**
     * Update an existing material.
     * URL: PUT /api/materials/{codigo}
     * Body JSON puede incluir: unidad_medida, descripcion, ubicacion, categoria.
     * Devuelve el material actualizado con su categoría.
     */
    public function update(Request $request, $codigo): JsonResponse
    {
        $material = Material::with('categoria')->findOrFail($codigo);

        $validated = $request->validate([
            'unidad_medida' => 'sometimes|string|max:100',
            'descripcion'   => 'sometimes|nullable|string',
            'ubicacion'     => 'sometimes|nullable|string|max:255',
            'categoria'     => 'sometimes|string|max:255',
        ]);

        if (array_key_exists('categoria', $validated)) {
            $categoria = Categoria::firstOrCreate(['nombre' => $validated['categoria']]);
            $material->categoria_id = $categoria->id;
        }

        foreach (['unidad_medida', 'descripcion', 'ubicacion'] as $field) {
            if (array_key_exists($field, $validated)) {
                $material->$field = $validated[$field];
            }
        }

        $material->save();

        return response()->json($material->load('categoria'));

    }

    /**
     * List all materials with their categories.
     * URL: GET /api/materials
     */
    public function index(): JsonResponse
    {
        $materials = Material::with('categoria')->get();
        return response()->json($materials);
    }
}