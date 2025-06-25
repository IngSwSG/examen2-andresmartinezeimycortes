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
}
