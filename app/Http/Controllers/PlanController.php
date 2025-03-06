<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Meal;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json(Plan::with('meals.recipe')->get());
    }

    public function store(Request $request)
    {
        // Valider plan-data
        $validated = $request->validate([
            'week' => 'required|integer',
            'meals' => 'required|array',
            'meals.*.day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'meals.*.type' => 'required|in:Breakfast,Lunch,Dinner',
            'meals.*.recipe_id' => 'nullable|exists:recipes,id',
        ]);

        // Opret planen
        $plan = Plan::create(['week' => $validated['week']]);

        // Opret måltiderne til planen
        foreach ($validated['meals'] as $meal) {
            Meal::create([
                'plan_id' => $plan->id,
                'day' => $meal['day'],
                'type' => $meal['type'],
                'recipe_id' => $meal['recipe_id'] ?? null,
            ]);
        }

        return response()->json($plan->load('meals.recipe'), 201);
    }

    public function show($id)
    {
        $plan = Plan::with('meals.recipe')->findOrFail($id);
        return response()->json($plan);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $validated = $request->validate([
            'week' => 'required|integer',
            'meals' => 'required|array',
            'meals.*.day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'meals.*.type' => 'required|in:Breakfast,Lunch,Dinner',
            'meals.*.recipe_id' => 'nullable|exists:recipes,id',
        ]);

        // Opdater uge
        $plan->update(['week' => $validated['week']]);

        // Opdater måltider
        $plan->meals()->delete(); // Slet gamle måltider
        foreach ($validated['meals'] as $meal) {
            Meal::create([
                'plan_id' => $plan->id,
                'day' => $meal['day'],
                'type' => $meal['type'],
                'recipe_id' => $meal['recipe_id'] ?? null,
            ]);
        }

        return response()->json($plan->load('meals.recipe'));
    }

    public function destroy($id)
    {
        Plan::destroy($id);
        return response()->json(['message' => 'Plan deleted']);
    }
}
