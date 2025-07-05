<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return response()->json(Team::all());
    }

    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->validated());
        return response()->json($team, 201);
    }

    public function show(Team $team)
    {
        return response()->json($team);
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->validated());
        return response()->json($team);
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return response()->json(null, 204);
    }
}
