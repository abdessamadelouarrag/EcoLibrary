<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategorieController extends Controller
{
    public function index()
    {
        $categorie = Categorie::latest()->get();

        return response()->json([
            'message' => 'Liste des catégories',
            'data' => $categorie
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
        ]);

        $categorie = Categorie::create($validated);

        return response()->json([
            'message' => 'Catégorie ajoutée avec succès',
            'data' => $categorie
        ], 201);
    }

    public function show(Categorie $categorie)
    {
        return response()->json([
            'message' => 'Détail de la catégorie',
            'data' => $categorie
        ], 200);
    }

    public function update(Request $request, Categorie $categorie)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorie', 'name')->ignore($categorie->id),
            ],
            'description' => ['nullable', 'string'],
        ]);

        $categorie->update($validated);

        return response()->json([
            'message' => 'Catégorie modifiée avec succès',
            'data' => $categorie
        ], 200);
    }

    public function destroy(Categorie $categorie)
    {
        if ($categorie->books()->exists()) {
            return response()->json([
                'message' => 'Impossible de supprimer cette catégorie car elle contient des livres.'
            ], 422);
        }

        $categorie->delete();

        return response()->json([
            'message' => 'Catégorie supprimée avec succès'
        ], 200);
    }
}