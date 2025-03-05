<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json(Plan::with(['day1', 'day2', 'day3', 'day4', 'day5', 'day6', 'day7'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'week' => 'required|integer',
            'day_1' => 'nullable|exists:recipes,id',
            'day_2' => 'nullable|exists:recipes,id',
            'day_3' => 'nullable|exists:recipes,id',
            'day_4' => 'nullable|exists:recipes,id',
            'day_5' => 'nullable|exists:recipes,id',
            'day_6' => 'nullable|exists:recipes,id',
            'day_7' => 'nullable|exists:recipes,id',
        ]);

        $plan = Plan::create($validated);
        return response()->json($plan, 201);
    }

    public function show($id)
    {
        $plan = Plan::with(['day1', 'day2', 'day3', 'day4', 'day5', 'day6', 'day7'])->findOrFail($id);
        return response()->json($plan);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($request->only(['week', 'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7']));
        return response()->json($plan);
    }

    public function destroy($id)
    {
        Plan::destroy($id);
        return response()->json(['message' => 'Plan deleted']);
    }
}
