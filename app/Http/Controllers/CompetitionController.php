<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Http\Requests\StoreMeetRequest;
use App\Http\Requests\UpdateMeetRequest;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        return response()->json(Competition::all());
    }

    public function store(StoreMeetRequest $request)
    {
        $competition = Competition::create($request->validated());
        return response()->json($competition, 201);
    }

    public function show($id)
    {
        $competition = Competition::where('code', $id)->first();

        if (! $competition) {
            return response()->json(['message' => 'Competition not found'], 404);
        }

        return response()->json($competition);
    }

    public function update(UpdateMeetRequest $request, Competition $competition)
    {
        $competition->update($request->validated());
        return response()->json($competition);
    }

    public function destroy(Competition $competition)
    {
        $competition->delete();
        return response()->json(null, 204);
    }

    public function showByCode($code)
    {
        $competition = Competition::where('code', $code)->first();

        if (! $competition) {
            return response()->json(['message' => 'Competition not found'], 404);
        }

        return response()->json($competition);
    }
}
