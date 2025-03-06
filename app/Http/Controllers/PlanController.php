<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json(Plan::with(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'week' => 'required|integer',
            'monday' => 'nullable|exists:recipes,id',
            'tuesday' => 'nullable|exists:recipes,id',
            'wednesday' => 'nullable|exists:recipes,id',
            'thursday' => 'nullable|exists:recipes,id',
            'friday' => 'nullable|exists:recipes,id',
            'saturday' => 'nullable|exists:recipes,id',
            'sunday' => 'nullable|exists:recipes,id',

        ]);

        $plan = Plan::create($validated);
        return response()->json($plan, 201);
    }

    public function show($id)
    {
        $plan = Plan::with(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->findOrFail($id);
        return response()->json($plan);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($request->only(['week', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']));
        return response()->json($plan);
    }

    public function destroy($id)
    {
        Plan::destroy($id);
        return response()->json(['message' => 'Plan deleted']);
    }
}
