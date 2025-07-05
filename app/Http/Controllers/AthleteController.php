<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Http\Requests\StoreAthleteRequest;
use App\Http\Requests\UpdateAthleteRequest;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    public function index()
    {
        return response()->json(Athlete::all());
    }

    public function store(StoreAthleteRequest $request)
    {
        $athlete = Athlete::create($request->validated());
        return response()->json($athlete, 201);
    }

    public function show(Athlete $athlete)
    {
        return response()->json($athlete);
    }

    public function update(UpdateAthleteRequest $request, Athlete $athlete)
    {
        $athlete->update($request->validated());
        return response()->json($athlete);
    }

    public function destroy(Athlete $athlete)
    {
        $athlete->delete();
        return response()->json(null, 204);
    }
}
