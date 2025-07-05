<?php

namespace App\Http\Controllers;

use App\Models\Meet;
use App\Http\Requests\StoreMeetRequest;
use App\Http\Requests\UpdateMeetRequest;
use Illuminate\Http\Request;

class MeetController extends Controller
{
    public function index()
    {
        return response()->json(Meet::all());
    }

    public function store(StoreMeetRequest $request)
    {
        $meet = Meet::create($request->validated());
        return response()->json($meet, 201);
    }

    public function show($id)
    {
        $meet = Meet::where('code', $id)->first();

        if (! $meet) {
            return response()->json(['message' => 'Meet not found'], 404);
        }

        return response()->json($meet);
    }

    public function update(UpdateMeetRequest $request, Meet $meet)
    {
        $meet->update($request->validated());
        return response()->json($meet);
    }

    public function destroy(Meet $meet)
    {
        $meet->delete();
        return response()->json(null, 204);
    }

    public function showByCode($code)
    {
        $meet = Meet::where('code', $code)->first();

        if (! $meet) {
            return response()->json(['message' => 'Meet not found'], 404);
        }

        return response()->json($meet);
    }
}
