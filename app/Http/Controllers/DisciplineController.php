<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        return response()->json(Discipline::all());
    }

    public function store(StoreEventRequest $request)
    {
        $discipline = Discipline::create($request->validated());
        return response()->json($discipline, 201);
    }

    public function show(Discipline $discipline)
    {
        return response()->json($discipline);
    }

    public function update(UpdateEventRequest $request, Discipline $discipline)
    {
        $discipline->update($request->validated());
        return response()->json($discipline);
    }

    public function destroy(Discipline $discipline)
    {
        $discipline->delete();
        return response()->json(null, 204);
    }
}
