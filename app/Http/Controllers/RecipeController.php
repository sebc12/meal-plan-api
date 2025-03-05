<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Recipe::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'ingredients' => 'required|array',
        'ingredients.*.name' => 'required|string|max:255',
        'ingredients.*.amount' => 'required|numeric|min:0.01',
        'ingredients.*.unit' => 'required|string|max:50',
    ]);

    $recipe = Recipe::create($validated);

    return response()->json($recipe, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return response()->json($recipe);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->only(['name', 'description']));
        return response()->json($recipe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Recipe::destroy($id);
        return response()->json(['message' => 'Recipe deleted']);
    }
}
